<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ArticleController;
use App\Http\Controllers\Guest\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});