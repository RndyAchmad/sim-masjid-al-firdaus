<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return view('guest.kegiatan.index');
    }

    public function show($slug)
    {
        return view('guest.kegiatan.show');
    }
}
