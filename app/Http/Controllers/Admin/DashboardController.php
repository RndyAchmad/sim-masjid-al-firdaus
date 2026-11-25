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

        // Statistik Utama
        $stats = [
            'users_count' => ($isSuperadmin && Schema::hasTable('users'))
                ? (int) DB::table('users')->count()
                : 0,
            'inventories_count' => ($isSekretaris && Schema::hasTable('inventories'))
                ? (int) DB::table('inventories')->count()
                : 0,
            'income_total' => ($isBendahara && Schema::hasTable('financial_reports'))
                ? (float) DB::table('financial_reports')->where('type', 'income')->sum('amount')
                : 0.0,
            'expense_total' => ($isBendahara && Schema::hasTable('financial_reports'))
                ? (float) DB::table('financial_reports')->where('type', 'expense')->sum('amount')
                : 0.0,
            'ongoing_projects_count' => ($isBendahara && Schema::hasTable('development_projects'))
                ? (int) DB::table('development_projects')->where('status', 'ongoing')->count()
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
        ];

        $stats['cash_balance'] = $stats['income_total'] - $stats['expense_total'];

        // Ringkasan Zakat (jika tabel tersedia)
        $zakatSummary = [
            'fitrah_rice_kg' => 0.0,
            'mal_cash_amount' => 0,
            'infaq_cash_amount' => 0,
            'total_persons' => 0,
        ];

        if ($isAdmin && Schema::hasTable('zakat_transactions')) {
            $zakatSummary['fitrah_rice_kg'] = (float) DB::table('zakat_transactions')->sum('fitrah_rice_kg');
            $zakatSummary['mal_cash_amount'] = (int) DB::table('zakat_transactions')->sum('mal_cash_amount');
            $zakatSummary['infaq_cash_amount'] = (int) DB::table('zakat_transactions')->sum('infaq_cash_amount');
            $zakatSummary['total_persons'] = (int) DB::table('zakat_transactions')->count();
        }

        // Jadwal Shalat Jumat Terdekat (dari tabel friday_schedules)
        $upcomingFridaySchedules = collect();
        if (Schema::hasTable('friday_schedules')) {
            $upcomingFridaySchedules = DB::table('friday_schedules')
                ->whereDate('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->limit(3)
                ->get();
        }

        // Transaksi Keuangan Terbaru (dari tabel financial_reports)
        $recentFinancialReports = collect();
        if ($isBendahara && Schema::hasTable('financial_reports')) {
            $recentFinancialReports = DB::table('financial_reports')
                ->orderByDesc('transaction_date')
                ->orderByDesc('id')
                ->limit(5)
                ->get();
        }

        // Agenda Kegiatan Terbaru (dari tabel activity_schedules)
        $recentActivities = collect();
        if ($isAdmin && Schema::hasTable('activity_schedules')) {
            $recentActivities = DB::table('activity_schedules')
                ->orderByDesc('id')
                ->limit(4)
                ->get();
        }

        return view('admin.dashboard', compact(
            'user',
            'role',
            'isSuperadmin',
            'isAdmin',
            'isSekretaris',
            'isBendahara',
            'stats',
            'zakatSummary',
            'upcomingFridaySchedules',
            'recentFinancialReports',
            'recentActivities'
        ));
    }
}
