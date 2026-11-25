<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $rawRole = match (true) {
            $user?->role instanceof UserRole => $user->role->value,
            is_string($user?->role) || is_int($user?->role) => (string) $user->role,
            default => 'admin',
        };

        $role = strtolower(trim($rawRole));

        $isSuperadmin = $role === 'superadmin';
        $isAdmin = in_array($role, ['superadmin', 'admin'], true);
        $isSekretaris = in_array($role, ['superadmin', 'sekretaris'], true);
        $isBendahara = in_array($role, ['superadmin', 'bendahara'], true);

        // Card statistik (1 card = 1 data, tanpa zakat/infaq)
        $cards = [
            'cash_balance' => ($isBendahara && Schema::hasTable('financial_reports'))
                ? (float) DB::table('financial_reports')->where('type', 'income')->sum('amount')
                    - (float) DB::table('financial_reports')->where('type', 'expense')->sum('amount')
                : 0.0,
            'ongoing_projects_count' => ($isBendahara && Schema::hasTable('development_projects'))
                ? (int) DB::table('development_projects')->where('status', 'ongoing')->count()
                : 0,
            'inventories_count' => ($isSekretaris && Schema::hasTable('inventories'))
                ? (int) DB::table('inventories')->count()
                : 0,
            'activities_count' => ($isAdmin && Schema::hasTable('activity_schedules'))
                ? (int) DB::table('activity_schedules')->count()
                : 0,
            'articles_count' => ($isAdmin && Schema::hasTable('articles'))
                ? (int) DB::table('articles')->count()
                : 0,
            'news_count' => ($isAdmin && Schema::hasTable('news_and_announcements'))
                ? (int) DB::table('news_and_announcements')->count()
                : 0,
            'users_count' => ($isSuperadmin && Schema::hasTable('users'))
                ? (int) DB::table('users')->count()
                : 0,
        ];

        // Tabel Jadwal Shalat Jumat Terdekat
        $upcomingFridaySchedules = Schema::hasTable('friday_schedules')
            ? DB::table('friday_schedules')
                ->whereDate('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->limit(5)
                ->get()
            : collect();

        // Tabel Transaksi Keuangan Terbaru (Bendahara / Superadmin)
        $recentFinancialReports = ($isBendahara && Schema::hasTable('financial_reports'))
            ? DB::table('financial_reports')
                ->orderByDesc('transaction_date')
                ->orderByDesc('id')
                ->limit(5)
                ->get()
            : collect();

        // Tabel Kegiatan Terbaru (Admin / Superadmin)
        $recentActivities = ($isAdmin && Schema::hasTable('activity_schedules'))
            ? DB::table('activity_schedules')
                ->orderByDesc('id')
                ->limit(5)
                ->get()
            : collect();

        // Tabel Inventaris Terbaru (Sekretaris / Superadmin)
        $recentInventories = ($isSekretaris && Schema::hasTable('inventories'))
            ? DB::table('inventories')
                ->orderByDesc('id')
                ->limit(5)
                ->get()
            : collect();

        return view('admin.dashboard', compact(
            'user',
            'role',
            'isSuperadmin',
            'isAdmin',
            'isSekretaris',
            'isBendahara',
            'cards',
            'upcomingFridaySchedules',
            'recentFinancialReports',
            'recentActivities',
            'recentInventories'
        ));
    }
}
