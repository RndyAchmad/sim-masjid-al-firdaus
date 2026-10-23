<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(\App\Enums\PublicationStatus::class)],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    private function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function show(string $id)
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.show', compact('article'));
    }

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);

        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(\App\Enums\PublicationStatus::class)],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Perbarui slug hanya jika judul berubah
        if ($article->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $counter = 1;

            while (
                Article::where('slug', $slug)
                    ->where('id', '!=', $article->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $validated['slug'] = $slug;
        }

        // Ganti thumbnail jika pengguna mengunggah gambar baru
        if ($request->hasFile('thumbnail')) {
            $newThumbnail = $request->file('thumbnail')->store('articles', 'public');

            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $validated['thumbnail'] = $newThumbnail;
        }

        $article->update($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        // Hapus thumbnail jika tersedia
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        // Hapus artikel dari database
        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
