<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.articles.index');
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        // Logika simpan artikel nantinya di sini
    }

    public function show(string $id)
    {
        return view('admin.articles.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.articles.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update artikel
    }

    public function destroy(string $id)
    {
        // Logika hapus artikel
    }
}
