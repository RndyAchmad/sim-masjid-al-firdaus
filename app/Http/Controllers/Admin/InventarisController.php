<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        return view('admin.inventaris.index');
    }

    public function create()
    {
        return view('admin.inventaris.create');
    }

    public function store(Request $request)
    {
        // Logika simpan inventaris
    }

    public function show(string $id)
    {
        return view('admin.inventaris.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.inventaris.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update inventaris
    }

    public function destroy(string $id)
    {
        // Logika hapus inventaris
    }
}
