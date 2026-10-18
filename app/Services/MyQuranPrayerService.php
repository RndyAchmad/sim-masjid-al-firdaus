<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class MyQuranPrayerService
{
    private const BASE_URL = 'https://api.myquran.com/v2/sholat/jadwal';

    private const CITY_ID = '1624';

    private const TIMEZONE = 'Asia/Jakarta';

    // Cache normal dan cache cadangan.
    private const CACHE_TTL = 3600;       // 1 jam
    private const STALE_TTL = 604800;     // 7 hari

    public function getDaily(Carbon $date): ?array
    {
        $dateKey = $date->copy()
            ->timezone(self::TIMEZONE)
            ->format('Y-m-d');

        $key = "myquran:daily:" . self::CITY_ID . ":{$dateKey}";

        return $this->rememberSchedule(
            $key,
            function () use ($dateKey) {
                $date = Carbon::createFromFormat(
                    '!Y-m-d',
                    $dateKey,
                    self::TIMEZONE
                );

                $url = self::BASE_URL . '/' . self::CITY_ID . '/'
                    . $date->format('Y/m/d');

                $json = $this->request($url);

                if (!$json) {
                    return null;
                }

                $data = $json['data'] ?? null;
                $jadwal = $data['jadwal'] ?? null;

                if (!is_array($jadwal) || !$this->hasPrayerTimes($jadwal)) {
                    return null;
                }

                return [
                    'lokasi' => $data['lokasi'] ?? 'Kab. Sidoarjo',
                    'tanggal' => $jadwal['tanggal'] ?? $dateKey,
                    'jadwal' => $jadwal,
                ];
            }
        );
    }

    public function getMonthly(int $year, int $month): ?array
    {
        $period = sprintf('%04d-%02d', $year, $month);

        $key = "myquran:monthly:" . self::CITY_ID . ":{$period}";

        return $this->rememberSchedule(
            $key,
            function () use ($year, $month) {
                $url = self::BASE_URL . '/' . self::CITY_ID
                    . '/' . $year . '/' . sprintf('%02d', $month);

                $json = $this->request($url);

                if (!$json) {
                    return null;
                }

                $data = $json['data'] ?? null;
                $jadwal = $data['jadwal'] ?? null;

                if (!is_array($jadwal) || empty($jadwal)) {
                    return null;
                }

                // Jangan simpan respons yang tidak memiliki waktu salat.
                $validRows = array_filter(
                    $jadwal,
                    fn($row) => is_array($row)
                        && $this->hasPrayerTimes($row)
                );

                if (empty($validRows)) {
                    return null;
                }

                return [
                    'lokasi' => $data['lokasi'] ?? 'Kab. Sidoarjo',
                    'jadwal' => array_values($validRows),
                ];
            }
        );
    }

    private function rememberSchedule(
        string $key,
        callable $fetch
    ): ?array {
        $cached = Cache::get($key);

        if (is_array($cached)) {
            return $cached;
        }

        try {
            $result = $fetch();

            // Cache hanya respons yang sudah lolos validasi.
            if (is_array($result)) {
                Cache::put($key, $result, self::CACHE_TTL);
                Cache::put(
                    $key . ':stale',
                    $result,
                    self::STALE_TTL
                );

                return $result;
            }
        } catch (Throwable $e) {
            Log::warning('Gagal mengambil jadwal MyQuran', [
                'cache_key' => $key,
                'error' => $e->getMessage(),
            ]);
        }

        // Jika API gagal, gunakan data sukses terakhir.
        $stale = Cache::get($key . ':stale');

        return is_array($stale) ? $stale : null;
    }

    private function request(string $url): ?array
    {
        try {
            $response = Http::acceptJson()
                ->connectTimeout(2)
                ->timeout(4)
                ->retry(2, 200, throw: false)
                ->get($url);

            if (!$response->successful()) {
                Log::warning('MyQuran mengembalikan HTTP error', [
                    'status' => $response->status(),
                ]);

                return null;
            }

            $json = $response->json();

            if (
                !is_array($json)
                || ($json['status'] ?? false) !== true
            ) {
                return null;
            }

            return $json;
        } catch (Throwable $e) {
            Log::warning('Request MyQuran gagal', [
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function hasPrayerTimes(array $jadwal): bool
    {
        foreach (['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'] as $key) {
            if (
                !isset($jadwal[$key])
                || !is_string($jadwal[$key])
                || !preg_match('/^\d{2}:\d{2}$/', $jadwal[$key])
            ) {
                return false;
            }
        }

        return true;
    }
}
