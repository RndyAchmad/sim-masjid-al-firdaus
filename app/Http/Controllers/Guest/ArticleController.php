<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(private readonly ArticleService $articleService)
    {
    }

    public function index(): View
    {
        return view('guest.articles.index', [
            'articles' => $this->articleService->all(),
            'metaTitle' => 'Artikel Keislaman - Masjid Al-Firdaus',
            'metaDescription' => 'Kumpulan artikel keislaman tentang ibadah, adab, sedekah, keluarga, dan akhlak untuk jamaah Masjid Al-Firdaus.',
        ]);
    }

    public function show(string $slug): View
    {
        $article = $this->articleService->findBySlug($slug);

        abort_if($article === null, 404);

        return view('guest.articles.show', [
            'article' => $article,
            'relatedArticles' => $this->articleService->related($slug),
            'metaTitle' => $article['title'] . ' - Masjid Al-Firdaus',
            'metaDescription' => $article['excerpt'],
        ]);
    }
}
