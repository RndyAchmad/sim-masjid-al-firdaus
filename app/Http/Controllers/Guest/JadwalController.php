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
        ]);

        // Periode untuk tabel jadwal bulanan.
        $year = (int) ($validated['year'] ?? $now->year);
        $month = (int) ($validated['month'] ?? $now->month);

        $formattedMonth = sprintf('%02d', $month);

        $jadwalBulanan = [];
        $jadwalHariIni = null;
        $lokasi = 'Kab. Sidoarjo';
        $dataAvailable = false;

        /*
        |--------------------------------------------------------------------------
        | 1. Ambil jadwal bulanan sesuai filter
        |--------------------------------------------------------------------------
        */
        try {
            $apiData = $prayerService->getMonthly($year, $month);

            if ($apiData) {
                $jadwalBulanan = $apiData['jadwal'] ?? [];
                $lokasi = $apiData['lokasi'] ?? $lokasi;
                $dataAvailable = !empty($jadwalBulanan);
            }
        } catch (Throwable $e) {
            Log::error('Gagal memuat jadwal sholat bulanan', [
                'year' => $year,
                'month' => $month,
                'error' => $e->getMessage(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Ambil jadwal hari ini secara terpisah dari filter
        |--------------------------------------------------------------------------
        */
        try {
            $todayData = $prayerService->getDaily($now);

            if ($todayData) {
                $dailySchedule = $todayData['jadwal'] ?? null;
                $todayDate = $now->toDateString();

                if (
                    is_array($dailySchedule) &&
                    $this->extractDate($dailySchedule) === $todayDate
                ) {
                    $jadwalHariIni = $dailySchedule;
                    $lokasi = $todayData['lokasi'] ?? $lokasi;
                }
            }
        } catch (Throwable $e) {
            Log::error('Gagal memuat jadwal sholat hari ini', [
                'date' => $now->toDateString(),
                'error' => $e->getMessage(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Tentukan waktu sholat aktif hanya untuk hari ini
        |--------------------------------------------------------------------------
        */
        $activePrayer = $jadwalHariIni
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
            'day' => $now->day,
            'dataAvailable' => $dataAvailable,
            'selectedDate' => $now->toDateString(),
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
