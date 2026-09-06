<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        return view('admin.laporan_keuangan.index');
    }

    public function create()
    {
        return view('admin.laporan_keuangan.create');
    }

    public function store(Request $request)
    {
        // Logika simpan transaksi
    }

    public function show(string $id)
    {
        return view('admin.laporan_keuangan.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.laporan_keuangan.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update transaksi
    }

    public function destroy(string $id)
    {
        // Logika hapus transaksi
    }
}
