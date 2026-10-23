<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('guest.articles.index', compact('articles'));
    }

    public function show(string $slug): View
    {
        $article = Article::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $articlesLainnya = Article::query()
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(4)
            ->get();

        return view('guest.articles.show', compact(
            'article',
            'articlesLainnya'
        ));
    }
}
