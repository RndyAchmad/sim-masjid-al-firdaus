<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\MosqueProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $profil = MosqueProfile::first();

        return view('guest.profile', compact('profil'));
    }
}
