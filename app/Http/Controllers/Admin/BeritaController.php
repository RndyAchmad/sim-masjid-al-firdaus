<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    public function index()
    {
        return view('admin.berita.index');
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store()
    {
        // Logic to store the berita data
    }

    public function edit($id)
    {
        return view('admin.berita.edit', compact('id'));
    }

    public function update($id)
    {
        // Logic to update the berita data
    }

    public function show($id)
    {
        return view('admin.berita.show', compact('id'));
    }
}
