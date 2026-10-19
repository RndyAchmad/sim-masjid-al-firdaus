<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Logika simpan pengguna nantinya di sini
    }

    public function show(string $id)
    {
        return view('admin.users.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.users.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update pengguna
    }

    public function destroy(string $id)
    {
        // Logika hapus pengguna
    }
}
