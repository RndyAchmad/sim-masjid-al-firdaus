<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\MyQuranPrayerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class JadwalController extends Controller
{
    public function indexJadwalImam()
    {
        return view('guest.jadwal.imam-jumat');
    }

    public function indexJadwalSholat(
        Request $request,
        MyQuranPrayerService $prayerService
    ) {
        $now = Carbon::now('Asia/Jakarta');

        $validated = $request->validate([
            'year' => [
                'sometimes',
                'required',
                'integer',
                'min:' . ($now->year - 1),
                'max:' . ($now->year + 1),
            ],
            'month' => [
                'sometimes',
                'required',
                'integer',
                'between:1,12',
            ],
            'day' => [
                'sometimes',
                'required',
                'integer',
                'between:1,31',
            ],
        ]);

        $year = (int) ($validated['year'] ?? $now->year);
        $month = (int) ($validated['month'] ?? $now->month);
        $day = (int) ($validated['day'] ?? $now->day);

        // Tolak tanggal tidak valid, misalnya 31 Februari.
        try {
            $selectedDate = Carbon::createSafe(
                $year,
                $month,
                $day,
                0,
                0,
                0,
                'Asia/Jakarta'
            );
        } catch (Throwable $e) {
            abort(422, 'Tanggal jadwal sholat tidak valid.');
        }

        $targetDate = $selectedDate->format('Y-m-d');
        $formattedMonth = sprintf('%02d', $month);

        $jadwalBulanan = [];
        $jadwalHariIni = null;
        $lokasi = 'Kab. Sidoarjo';
        $dataAvailable = false;

        try {
            // Data bulanan memakai cache yang sama untuk semua halaman.
            $apiData = $prayerService->getMonthly($year, $month);

            if ($apiData) {
                $jadwalBulanan = $apiData['jadwal'] ?? [];
                $lokasi = $apiData['lokasi'] ?? $lokasi;
                $dataAvailable = !empty($jadwalBulanan);

                foreach ($jadwalBulanan as $item) {
                    $itemDate = $this->extractDate($item);

                    if ($itemDate === $targetDate) {
                        $jadwalHariIni = $item;
                        break;
                    }
                }
            }

            // Jangan pernah memakai baris pertama sebagai pengganti
            // tanggal yang tidak ditemukan.
            if (!$jadwalHariIni) {
                $dailyData = $prayerService->getDaily($selectedDate);

                if ($dailyData) {
                    $dailySchedule = $dailyData['jadwal'] ?? [];

                    if ($this->extractDate($dailySchedule) === $targetDate) {
                        $jadwalHariIni = $dailySchedule;
                        $lokasi = $dailyData['lokasi'] ?? $lokasi;
                    }
                }
            }
        } catch (Throwable $e) {
            Log::error('Gagal memuat halaman jadwal sholat', [
                'date' => $targetDate,
                'error' => $e->getMessage(),
            ]);
        }

        $isToday = $targetDate === $now->toDateString();

        $activePrayer = (
            $isToday && $jadwalHariIni
        )
            ? $this->determineActivePrayer(
                $jadwalHariIni,
                $now->format('H:i')
            )
            : null;

        return view('guest.jadwal.jadwal-sholat', [
            'jadwalBulanan' => $jadwalBulanan,
            'jadwalHariIni' => $jadwalHariIni,
            'activePrayer' => $activePrayer,
            'lokasi' => $lokasi,
            'year' => $year,
            'month' => $formattedMonth,
            'day' => $day,
            'dataAvailable' => $dataAvailable,
            'selectedDate' => $targetDate,
        ]);
    }

    /**
     * Mendapatkan tanggal ISO dari baris jadwal API.
     */
    private function extractDate(array $item): ?string
    {
        // Format tanggal ISO yang ideal.
        $date = $item['date'] ?? null;

        if (
            is_string($date)
            && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)
        ) {
            return $date;
        }

        // Beberapa respons API hanya menyediakan tanggal berformat
        // "Minggu, 18/10/2026".
        $tanggal = $item['tanggal'] ?? null;

        if (
            is_string($tanggal)
            && preg_match(
                '/(\d{2})\/(\d{2})\/(\d{4})/',
                $tanggal,
                $matches
            )
        ) {
            return "{$matches[3]}-{$matches[2]}-{$matches[1]}";
        }

        return null;
    }

    /**
     * Mengembalikan waktu salat berikutnya, bukan salat yang sedang
     * berlangsung. Setelah Isya, salat berikutnya adalah Subuh.
     */
    private function determineActivePrayer(
        ?array $jadwal,
        string $currentTime
    ): ?string {
        if (!$jadwal) {
            return null;
        }

        $prayers = [
            'subuh' => $jadwal['subuh'] ?? null,
            'dzuhur' => $jadwal['dzuhur'] ?? null,
            'ashar' => $jadwal['ashar'] ?? null,
            'maghrib' => $jadwal['maghrib'] ?? null,
            'isya' => $jadwal['isya'] ?? null,
        ];

        foreach ($prayers as $name => $time) {
            if (
                !is_string($time)
                || !preg_match('/^\d{2}:\d{2}$/', $time)
            ) {
                return null;
            }
        }

        foreach ($prayers as $name => $time) {
            if ($currentTime < $time) {
                return $name;
            }
        }

        // Semua waktu salat hari ini sudah lewat.
        return 'subuh';
    }
}
