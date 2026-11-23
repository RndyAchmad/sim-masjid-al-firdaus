<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    public function index()
    {
        return view('admin.zakat.index');
    }

    public function create()
    {
        return view('admin.zakat.create');
    }

    public function store(Request $request)
    {
        // Logika simpan data pendaftaran zakat keluarga, rincian jiwa (beras kg), zakat mal & infaq (Rp)
    }

    public function show(string $id)
    {
        return view('admin.zakat.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.zakat.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update data zakat
    }

    public function destroy(string $id)
    {
        // Logika hapus data zakat
    }
}
