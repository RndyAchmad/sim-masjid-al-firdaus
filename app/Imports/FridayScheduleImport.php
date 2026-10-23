<?php

namespace App\Imports;

use App\Models\FridaySchedule;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class FridayScheduleImport implements ToCollection, WithHeadingRow, SkipsEmptyRows, WithCustomCsvSettings
{
    private bool $overwriteExisting;

    public function __construct(bool $overwriteExisting = false)
    {
        $this->overwriteExisting = $overwriteExisting;
    }

    public function collection(Collection $rows): void
    {
        $data = [];
        $errors = [];
        $seenDates = [];

        if ($rows->isEmpty()) {
            throw ValidationException::withMessages([
                'file' => 'File tidak memiliki data untuk diimpor.',
            ]);
        }

        $firstRow = $rows->first()->toArray();

        if (
            !array_key_exists('tanggal_jumat', $firstRow) ||
            !array_key_exists('imam_sholat', $firstRow)
        ) {
            throw ValidationException::withMessages([
                'file' => 'Format kolom tidak sesuai. Gunakan kolom Tanggal Jumat dan Imam Sholat.',
            ]);
        }

        foreach ($rows as $index => $row) {
            $row = $row->toArray();
            $nomorBaris = $index + 2;

            $tanggal = $this->parseDate($row['tanggal_jumat'] ?? null);
            $imam = trim((string) ($row['imam_sholat'] ?? ''));
            $muadzin = trim((string) ($row['muadzin'] ?? ''));
            // $khatib = trim((string) ($row['khatib'] ?? ''));

            if (!$tanggal) {
                $errors[] = "Baris {$nomorBaris}: tanggal tidak valid atau belum diisi.";
                continue;
            }

            if (!Carbon::createFromFormat('!Y-m-d', $tanggal)->isFriday()) {
                $errors[] = "Baris {$nomorBaris}: tanggal {$tanggal} bukan hari Jumat.";
                continue;
            }

            if ($imam === '') {
                $errors[] = "Baris {$nomorBaris}: nama imam wajib diisi.";
                continue;
            }

            if (
                mb_strlen($imam) > 255 ||
                mb_strlen($muadzin) > 255
                // mb_strlen($khatib) > 255
            ) {
                $errors[] = "Baris {$nomorBaris}: nama petugas maksimal 255 karakter.";
                continue;
            }

            if (isset($seenDates[$tanggal])) {
                $errors[] = "Baris {$nomorBaris}: tanggal {$tanggal} duplikat di dalam file.";
                continue;
            }

            if (
                !$this->overwriteExisting &&
                FridaySchedule::whereDate('date', $tanggal)->exists()
            ) {
                $errors[] = "Baris {$nomorBaris}: jadwal tanggal {$tanggal} sudah ada di database.";
                continue;
            }

            $seenDates[$tanggal] = true;

            $data[] = [
                'date' => $tanggal,
                'imam' => $imam,
                'muadzin' => $muadzin !== '' ? $muadzin : null,
                // 'khatib' => $khatib !== '' ? $khatib : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages([
                'file' => implode("\n", $errors),
            ]);
        }

        if (empty($data)) {
            throw ValidationException::withMessages([
                'file' => 'Tidak ada data jadwal yang dapat diimpor.',
            ]);
        }


        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                if ($this->overwriteExisting) {
                    FridaySchedule::updateOrCreate(
                        ['date' => $item['date']],
                        [
                            'imam' => $item['imam'],
                            'muadzin' => $item['muadzin'],
                        ]
                    );
                } else {
                    FridaySchedule::create([
                        'date' => $item['date'],
                        'imam' => $item['imam'],
                        'muadzin' => $item['muadzin'],
                    ]);
                }
            }
        });

        session()->flash('imported_count', count($data));
    }

    private function parseDate(mixed $value): ?string
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        try {
            if ($value instanceof \DateTimeInterface) {
                return Carbon::instance($value)->format('Y-m-d');
            }

            if (is_numeric($value)) {
                return ExcelDate::excelToDateTimeObject((float) $value)
                    ->format('Y-m-d');
            }

            $value = trim((string) $value);

            foreach (['Y-m-d', 'd/m/Y', 'd-m-Y', 'd.m.Y'] as $format) {
                try {
                    $date = Carbon::createFromFormat('!' . $format, $value);

                    if ($date && $date->format($format) === $value) {
                        return $date->format('Y-m-d');
                    }
                } catch (\Throwable $e) {
                    // Coba format tanggal berikutnya.
                }
            }
        } catch (\Throwable $e) {
            return null;
        }

        return null;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'input_encoding' => 'UTF-8',
        ];
    }
}
