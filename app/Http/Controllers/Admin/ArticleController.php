<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.articles.index', compact('articles'));
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
