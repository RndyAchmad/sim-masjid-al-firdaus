<?php

// Guest Controllers
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ArticleController as GuestArticleController;
use App\Http\Controllers\Guest\ProfileController as GuestProfileController;
use App\Http\Controllers\Guest\ActivityController as GuestActivityController;
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilMasjidController as AdminProfilMasjidController;
use App\Http\Controllers\Admin\LaporanKeuanganController as AdminLaporanKeuanganController;
use App\Http\Controllers\Admin\InventarisController as AdminInventarisController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\JadwalImamController as AdminJadwalImamController;
use App\Http\Controllers\Admin\PembangunanController as AdminPembangunanController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/profile', [GuestProfileController::class, 'index'])->name('profile');
Route::get('/artikel', [GuestArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [GuestArticleController::class, 'show'])->name('articles.show');
Route::get('/kegiatan', [GuestActivityController::class, 'index'])->name('activities.index');
Route::get('/kegiatan/{slug}', [GuestActivityController::class, 'show'])->name('activities.show');

// Admin Routes
Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Masjid Routes
    Route::get('/profile', [AdminProfilMasjidController::class, 'index'])->name('profile');

    // Artikel Routes
    Route::prefix('artikel')->name('articles.')->group(function () {
        Route::get('/', [AdminArticleController::class, 'index'])->name('index');
        Route::get('/create', [AdminArticleController::class, 'create'])->name('create');
        Route::post('/', [AdminArticleController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminArticleController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminArticleController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminArticleController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminArticleController::class, 'destroy'])->name('destroy');
    });

    // Inventaris Routes
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::get('/', [AdminInventarisController::class, 'index'])->name('index');
        Route::get('/create', [AdminInventarisController::class, 'create'])->name('create');
        Route::post('/', [AdminInventarisController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminInventarisController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminInventarisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminInventarisController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminInventarisController::class, 'destroy'])->name('destroy');
    });

    // Laporan Keuangan Routes
    Route::prefix('laporan-keuangan')->name('laporan-keuangan.')->group(function () {
        Route::get('/', [AdminLaporanKeuanganController::class, 'index'])->name('index');
        Route::get('/create', [AdminLaporanKeuanganController::class, 'create'])->name('create');
        Route::post('/', [AdminLaporanKeuanganController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminLaporanKeuanganController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminLaporanKeuanganController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminLaporanKeuanganController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminLaporanKeuanganController::class, 'destroy'])->name('destroy');
    });

    // Jadwal Imam Jumat Routes
    Route::prefix('jadwal-imam')->name('jadwal-imam.')->group(function () {
        Route::get('/', [AdminJadwalImamController::class, 'index'])->name('index');
        Route::get('/create', [AdminJadwalImamController::class, 'create'])->name('create');
        Route::get('/{id}', [AdminJadwalImamController::class, 'show'])->name('show');
        Route::post('/', [AdminJadwalImamController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminJadwalImamController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminJadwalImamController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminJadwalImamController::class, 'destroy'])->name('destroy');
        Route::get('/export', [AdminJadwalImamController::class, 'exportToExcel'])->name('export');
        Route::post('/import', [AdminJadwalImamController::class, 'importFromExcel'])->name('import');
    });

    // Pembangunan Routes
    Route::prefix('pembangunan')->name('pembangunan.')->group(function () {
        Route::get('/', [AdminPembangunanController::class, 'index'])->name('index');
        Route::get('/create', [AdminPembangunanController::class, 'create'])->name('create');
        Route::post('/', [AdminPembangunanController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminPembangunanController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminPembangunanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminPembangunanController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminPembangunanController::class, 'destroy'])->name('destroy');
    });

    // Berita & Pengumuman Routes
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [AdminBeritaController::class, 'index'])->name('index');
        Route::get('/create', [AdminBeritaController::class, 'create'])->name('create');
        Route::post('/', [AdminBeritaController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminBeritaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminBeritaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminBeritaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminBeritaController::class, 'destroy'])->name('destroy');
    });
});
