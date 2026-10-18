<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexOperasional()
    {
        return view('guest.laporan.operasional');
    }

    public function indexPembangunan()
    {
        return view('guest.laporan.pembangunan');
    }

    public function indexInventaris()
    {
        return view('guest.laporan.inventaris');
    }
}
