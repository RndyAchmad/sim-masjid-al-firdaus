<?php

namespace App\Imports;

use App\Models\FridaySchedule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class FridaySchedulePreviewImport implements
    ToCollection,
    WithHeadingRow,
    WithCustomCsvSettings,
    SkipsEmptyRows
{
    public array $existingDates = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $row = $row->toArray();
            $value = $row['tanggal_jumat'] ?? null;

            if (!$value) {
                continue;
            }

            try {
                if ($value instanceof \DateTimeInterface) {
                    $date = $value->format('Y-m-d');
                } elseif (is_numeric($value)) {
                    $date = \Carbon\Carbon::instance(
                        \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                            (float) $value
                        )
                    )->format('Y-m-d');
                } else {
                    $date = \Carbon\Carbon::createFromFormat(
                        '!d-m-Y',
                        trim((string) $value)
                    )?->format('Y-m-d');

                    if (!$date) {
                        $date = \Carbon\Carbon::createFromFormat(
                            '!Y-m-d',
                            trim((string) $value)
                        )?->format('Y-m-d');
                    }
                }

                if (
                    $date &&
                    FridaySchedule::whereDate('date', $date)->exists()
                ) {
                    $this->existingDates[] = $date;
                }
            } catch (\Throwable $e) {
                // Validasi format lengkap tetap dilakukan saat import.
            }
        }

        $this->existingDates = array_values(
            array_unique($this->existingDates)
        );
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'input_encoding' => 'UTF-8',
        ];
    }
}
