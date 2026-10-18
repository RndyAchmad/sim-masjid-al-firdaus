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
        return view('guest.articles.index');
    }

    public function show(string $slug): View
    {
        return view('guest.articles.show');
    }
}
