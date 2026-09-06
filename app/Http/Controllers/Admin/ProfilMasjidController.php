<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilMasjidController extends Controller
{
    public function index()
    {
        return view('admin.profil-masjid.index');
    }
}
