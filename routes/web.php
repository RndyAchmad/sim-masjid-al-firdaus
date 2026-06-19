<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
