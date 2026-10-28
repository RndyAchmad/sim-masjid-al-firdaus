<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\MosqueProfile;

class KontakController extends Controller
{
    public function index()
    {
        $profile = MosqueProfile::first();

        return view('guest.kontak.index', compact('profile'));
    }
}
