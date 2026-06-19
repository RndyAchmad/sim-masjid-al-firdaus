<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Default data jika API gagal/lambat diakses
        $jadwal = [
            'Imsak'   => '--:--',
            'Subuh'   => '--:--',
            'Dzuhur'  => '--:--',
            'Ashar'   => '--:--',
            'Maghrib' => '--:--',
            'Isya'    => '--:--'
        ];
        $tanggal = 'Gagal memuat jadwal';
        $lokasi = 'Kab. Sidoarjo';

        try {
            $year = now()->year;
            $month = now()->format('m');
            $day = now()->format('d');
            
            // ID 1628 adalah kode untuk Kab. Sidoarjo di API MyQuran Kemenag
            // Timeout 5 detik agar halaman tidak loading selamanya jika API Kemenag down
            $response = Http::timeout(5)->get("https://api.myquran.com/v2/sholat/jadwal/1628/{$year}/{$month}/{$day}");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status']) {
                    $tanggal = $data['data']['jadwal']['tanggal'];
                    $jadwal = [
                        'Imsak'   => $data['data']['jadwal']['imsak'],
                        'Subuh'   => $data['data']['jadwal']['subuh'],
                        'Dzuhur'  => $data['data']['jadwal']['dzuhur'],
                        'Ashar'   => $data['data']['jadwal']['ashar'],
                        'Maghrib' => $data['data']['jadwal']['maghrib'],
                        'Isya'    => $data['data']['jadwal']['isya'],
                    ];
                }
            }
        } catch (\Exception $e) {
            // Catat error di storage/logs/laravel.log tanpa merusak tampilan web
            Log::error('API Jadwal Sholat Error: ' . $e->getMessage());
        }

        // Kirim variabel ke view 'beranda'
        return view('welcome', compact('jadwal', 'tanggal', 'lokasi'));
    }
}