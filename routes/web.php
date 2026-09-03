<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ArticleController;
use App\Http\Controllers\Guest\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');

    Route::prefix('artikel')->name('articles.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Admin\ArticleController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('destroy');
    });
});