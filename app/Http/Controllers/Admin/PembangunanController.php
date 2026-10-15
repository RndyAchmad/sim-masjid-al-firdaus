<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembangunanController extends Controller
{
    public function index()
    {
        return view('admin.pembangunan.index');
    }

    public function create()
    {
        return view('admin.pembangunan.create');
    }

    public function store(Request $request)
    {
        // Logika simpan data pembangunan
    }

    public function show(string $id)
    {
        return view('admin.pembangunan.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.pembangunan.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update data pembangunan
    }

    public function destroy(string $id)
    {
        // Logika hapus data pembangunan
    }
}
