<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\MyQuranPrayerService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class HomeController extends Controller
{
    public function index(MyQuranPrayerService $prayerService)
    {
        $now = Carbon::now('Asia/Jakarta');

        $jadwal = [
            'Imsak' => '--:--',
            'Subuh' => '--:--',
            'Dzuhur' => '--:--',
            'Ashar' => '--:--',
            'Maghrib' => '--:--',
            'Isya' => '--:--',
        ];

        $tanggal = $now->translatedFormat('l, d F Y');
        $lokasi = 'Kab. Sidoarjo';
        $apiAvailable = false;

        try {
            $result = $prayerService->getDaily($now);

            if ($result && isset($result['jadwal'])) {
                $data = $result['jadwal'];

                $jadwal = [
                    'Imsak' => $data['imsak'] ?? '--:--',
                    'Subuh' => $data['subuh'] ?? '--:--',
                    'Dzuhur' => $data['dzuhur'] ?? '--:--',
                    'Ashar' => $data['ashar'] ?? '--:--',
                    'Maghrib' => $data['maghrib'] ?? '--:--',
                    'Isya' => $data['isya'] ?? '--:--',
                ];

                $tanggal = $data['tanggal'] ?? $tanggal;
                $lokasi = $result['lokasi'] ?? $lokasi;
                $apiAvailable = true;
            }
        } catch (Throwable $e) {
            Log::error('Gagal menampilkan jadwal di beranda', [
                'error' => $e->getMessage(),
            ]);
        }

        return view('welcome', compact(
            'jadwal',
            'tanggal',
            'lokasi',
            'apiAvailable'
        ));
    }
}
