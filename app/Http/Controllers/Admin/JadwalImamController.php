<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalImamController extends Controller
{
    public function index()
    {       
        return view('admin.jadwal-imam.index');
    }

    public function show($id)
    {
        return view('admin.jadwal-imam.show', compact('id'));
    }

    public function create()
    {
        return view('admin.jadwal-imam.create');
    }

    public function store(Request $request)
    {
        // / Simpan data baru ke database
    }

    public function edit($id)
    {
        return view('admin.jadwal-imam.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update data berdasarkan ID
    }

    public function destroy($id)
    {
        // Hapus data dari database berdasarkan ID
    }

    public function exportToExcel()
    {
        // Logic to export data to Excel
    }

    public function importFromExcel(Request $request)
    {
        // Logic to import data from Excel
    }
}