<?php

// Guest Controllers
use App\Http\Controllers\Admin\AccountProfileController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventarisController as AdminInventarisController;
use App\Http\Controllers\Admin\JadwalImamController as AdminJadwalImamController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\LaporanKeuanganController as AdminLaporanKeuanganController;
use App\Http\Controllers\Admin\PembangunanController as AdminPembangunanController;
// Admin Controllers
use App\Http\Controllers\Admin\ProfilMasjidController as AdminProfilMasjidController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\ActivityController as GuestActivityController;
use App\Http\Controllers\Guest\ArticleController as GuestArticleController;
use App\Http\Controllers\Guest\BeritaController as GuestBeritaController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\JadwalController as GuestJadwalController;
use App\Http\Controllers\Guest\KontakController as GuestKontakController;
use App\Http\Controllers\Guest\LaporanController as GuestLaporanController;
use App\Http\Controllers\Guest\ProfileController as GuestProfileController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/profile', [GuestProfileController::class, 'index'])->name('profile');
Route::get('/berita', [GuestBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [GuestBeritaController::class, 'show'])->name('berita.show');
Route::get('/artikel', [GuestArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [GuestArticleController::class, 'show'])->name('articles.show');
Route::get('/kegiatan', [GuestActivityController::class, 'index'])->name('activities.index');
Route::get('/kegiatan/{slug}', [GuestActivityController::class, 'show'])->name('activities.show');
Route::get('/jadwal-imam-jumat', [GuestJadwalController::class, 'indexJadwalImam'])->name('jadwal.imam');
Route::get('/jadwal-sholat', [GuestJadwalController::class, 'indexJadwalSholat'])->name('jadwal.sholat');
Route::get('/laporan/keuangan-operasional', [GuestLaporanController::class, 'indexOperasional'])->name('laporan.operasional');
Route::get('/laporan/keuangan-pembangunan', [GuestLaporanController::class, 'indexPembangunan'])->name('laporan.pembangunan');
Route::get('/laporan/inventaris', [GuestLaporanController::class, 'indexInventaris'])->name('laporan.inventaris');
Route::get('/kontak', [GuestKontakController::class, 'index'])->name('kontak');

// AUTHENTICATION ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->middleware('throttle:5,1')
        ->name('login.authenticate');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // EDIT ACCOUNT
    Route::get('/account/profile', [AccountProfileController::class, 'edit'])->name('account.edit');
    Route::put('/account/profile', [AccountProfileController::class, 'update'])->name('account.update');

    // DASHBOARD: SEMUA ROLE
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PROFIL MASJID: SUPERADMIN, ADMIN, SEKRETARIS
    Route::middleware('role:superadmin,admin,sekretaris')->group(function () {
        Route::get('/profile', [AdminProfilMasjidController::class, 'index'])->name('profile');
        Route::put('/profile', [AdminProfilMasjidController::class, 'update'])->name('profile.update');
    });

    // KEGIATAN: SUPERADMIN, ADMIN
    Route::middleware('role:superadmin,admin')->group(function () {
        Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
            Route::get('/', [AdminKegiatanController::class, 'index'])->name('index');
            Route::get('/create', [AdminKegiatanController::class, 'create'])->name('create');
            Route::post('/', [AdminKegiatanController::class, 'store'])->name('store');
            Route::get('/{id}', [AdminKegiatanController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AdminKegiatanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminKegiatanController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminKegiatanController::class, 'destroy'])->name('destroy');
        });

        // ARTIKEL: SUPERADMIN, ADMIN
        Route::prefix('artikel')->name('articles.')->group(function () {
            Route::get('/', [AdminArticleController::class, 'index'])->name('index');
            Route::get('/create', [AdminArticleController::class, 'create'])->name('create');
            Route::post('/', [AdminArticleController::class, 'store'])->name('store');
            Route::get('/{id}', [AdminArticleController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AdminArticleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminArticleController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminArticleController::class, 'destroy'])->name('destroy');
        });

        // JADWAL IMAM: SUPERADMIN, ADMIN
        Route::prefix('jadwal-imam')->name('jadwal-imam.')->group(function () {
            Route::get('/', [AdminJadwalImamController::class, 'index'])->name('index');
            Route::get('/create', [AdminJadwalImamController::class, 'create'])->name('create');
            Route::get('/export', [AdminJadwalImamController::class, 'exportToExcel'])->name('export');
            Route::post('/import', [AdminJadwalImamController::class, 'importFromExcel'])->name('import');
            Route::post('/', [AdminJadwalImamController::class, 'store'])->name('store');
            Route::get('/{id}', [AdminJadwalImamController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AdminJadwalImamController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminJadwalImamController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminJadwalImamController::class, 'destroy'])->name('destroy');
        });

        // BERITA & PENGUMUMAN: SUPERADMIN, ADMIN
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

    // INVENTARIS: SUPERADMIN, SEKRETARIS
    Route::middleware('role:superadmin,sekretaris')->prefix('inventaris')->name('inventaris.')->group(function () {
        Route::get('/', [AdminInventarisController::class, 'index'])->name('index');
        Route::get('/create', [AdminInventarisController::class, 'create'])->name('create');
        Route::post('/', [AdminInventarisController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminInventarisController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminInventarisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminInventarisController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminInventarisController::class, 'destroy'])->name('destroy');
    });

    // LAPORAN KEUANGAN: SUPERADMIN, BENDAHARA
    Route::middleware('role:superadmin,bendahara')->prefix('laporan-keuangan')->name('laporan-keuangan.')->group(function () {
        Route::get('/', [AdminLaporanKeuanganController::class, 'index'])->name('index');
        Route::get('/create', [AdminLaporanKeuanganController::class, 'create'])->name('create');
        Route::post('/', [AdminLaporanKeuanganController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminLaporanKeuanganController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminLaporanKeuanganController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminLaporanKeuanganController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminLaporanKeuanganController::class, 'destroy'])->name('destroy');
    });

    // PEMBANGUNAN: SUPERADMIN, BENDAHARA
    Route::middleware('role:superadmin,bendahara')->prefix('pembangunan')->name('pembangunan.')->group(function () {
        Route::get('/', [AdminPembangunanController::class, 'index'])->name('index');

        // Transaksi dan proyek adalah data yang berbeda. Pemisahan URL serta
        // nama rute mencegah ID transaksi digunakan sebagai ID proyek (atau sebaliknya).
        Route::prefix('transaksi')->name('transactions.')->group(function () {
            Route::get('/create', [AdminPembangunanController::class, 'createTransaction'])->name('create');
            Route::post('/', [AdminPembangunanController::class, 'storeTransaction'])->name('store');
            Route::get('/{transaction}', [AdminPembangunanController::class, 'showTransaction'])->name('show');
            Route::get('/{transaction}/edit', [AdminPembangunanController::class, 'editTransaction'])->name('edit');
            Route::put('/{transaction}', [AdminPembangunanController::class, 'updateTransaction'])->name('update');
            Route::delete('/{transaction}', [AdminPembangunanController::class, 'destroyTransaction'])->name('destroy');
        });

        Route::prefix('proyek')->name('projects.')->group(function () {
            Route::get('/create', [AdminPembangunanController::class, 'createProject'])->name('create');
            Route::post('/', [AdminPembangunanController::class, 'storeProject'])->name('store');
            Route::get('/{project}', [AdminPembangunanController::class, 'showProject'])->name('show');
            Route::get('/{project}/edit', [AdminPembangunanController::class, 'editProject'])->name('edit');
            Route::put('/{project}', [AdminPembangunanController::class, 'updateProject'])->name('update');
            Route::delete('/{project}', [AdminPembangunanController::class, 'destroyProject'])->name('destroy');
        });
    });

    // MANAJEMEN PENGGUNA: SUPERADMIN SAJA
    Route::middleware('role:superadmin')->prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUsersController::class, 'index'])->name('index');
        Route::get('/create', [AdminUsersController::class, 'create'])->name('create');
        Route::post('/', [AdminUsersController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminUsersController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminUsersController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminUsersController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminUsersController::class, 'destroy'])->name('destroy');
    });
});
