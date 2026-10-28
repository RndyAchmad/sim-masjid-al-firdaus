<?php

namespace App\Http\Controllers\Guest;

use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Models\DevelopmentTransaction;
use App\Models\FinancialReport;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexOperasional(Request $request)
    {
        $validated = $request->validate([
            'bulan' => ['nullable', 'integer', 'between:1,12'],
            'tahun' => ['nullable', 'integer', 'between:2000,2100'],
        ]);

        $sekarang = Carbon::today();

        $bulan = (int) ($validated['bulan'] ?? $sekarang->month);
        $tahun = (int) ($validated['tahun'] ?? $sekarang->year);

        $awalBulan = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $akhirBulan = $awalBulan->copy()->endOfMonth();

        $tanggalHariIni = $sekarang->toDateString();

        // Periksa apakah periode yang dipilih belum dimulai.
        $periodeBelumBerjalan = $awalBulan->greaterThan(
            $sekarang->copy()->startOfMonth()
        );

        // Batasi perhitungan sampai hari ini untuk bulan berjalan.
        $batasTanggal = $akhirBulan->greaterThan($sekarang)
            ? $sekarang->copy()
            : $akhirBulan->copy();

        // Saldo awal periode dari seluruh transaksi sebelum bulan terpilih.
        $pemasukanSebelumnya = FinancialReport::query()
            ->where('type', 'income')
            ->whereDate('transaction_date', '<', $awalBulan->toDateString())
            ->sum('amount');

        $pengeluaranSebelumnya = FinancialReport::query()
            ->where('type', 'expense')
            ->whereDate('transaction_date', '<', $awalBulan->toDateString())
            ->sum('amount');

        $saldoAwalPeriode = $pemasukanSebelumnya - $pengeluaranSebelumnya;

        // Total pemasukan pada periode terpilih, maksimal sampai hari ini.
        $totalPemasukan = FinancialReport::query()
            ->where('type', 'income')
            ->whereBetween('transaction_date', [
                $awalBulan->toDateString(),
                $batasTanggal->toDateString(),
            ])
            ->sum('amount');

        // Total pengeluaran pada periode terpilih, maksimal sampai hari ini.
        $totalPengeluaran = FinancialReport::query()
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [
                $awalBulan->toDateString(),
                $batasTanggal->toDateString(),
            ])
            ->sum('amount');

        // Selisih pemasukan dan pengeluaran pada periode terpilih.
        $selisihPeriode = $totalPemasukan - $totalPengeluaran;

        // Saldo akhir berdasarkan transaksi yang tercatat sampai batas periode.
        $saldoAkhirPeriode = $saldoAwalPeriode + $selisihPeriode;

        // Saldo kas keseluruhan sampai hari ini.
        $pemasukanKumulatif = FinancialReport::query()
            ->where('type', 'income')
            ->whereDate('transaction_date', '<=', $tanggalHariIni)
            ->sum('amount');

        $pengeluaranKumulatif = FinancialReport::query()
            ->where('type', 'expense')
            ->whereDate('transaction_date', '<=', $tanggalHariIni)
            ->sum('amount');

        $saldoKas = $pemasukanKumulatif - $pengeluaranKumulatif;

        // Daftar tahun yang tersedia untuk filter.
        $daftarTahun = FinancialReport::query()
            ->selectRaw('YEAR(transaction_date) as tahun')
            ->whereNotNull('transaction_date')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->map(fn ($item) => (int) $item)
            ->push((int) $sekarang->year)
            ->push($tahun)
            ->unique()
            ->sortDesc()
            ->values();

        // Ambil transaksi yang sudah terjadi pada periode terpilih.
        $transaksi = FinancialReport::query()
            ->whereBetween('transaction_date', [
                $awalBulan->toDateString(),
                $batasTanggal->toDateString(),
            ])
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('guest.laporan.operasional', compact(
            'bulan',
            'tahun',
            'daftarTahun',
            'totalPemasukan',
            'totalPengeluaran',
            'selisihPeriode',
            'saldoKas',
            'saldoAwalPeriode',
            'saldoAkhirPeriode',
            'periodeBelumBerjalan',
            'transaksi'
        ));
    }

    public function indexPembangunan(Request $request)
    {
        $validated = $request->validate([
            'bulan' => ['nullable', 'date_format:Y-m'],
        ]);

        $bulan = $validated['bulan'] ?? now()->format('Y-m');
        $tanggalBulan = Carbon::createFromFormat('!Y-m', $bulan);
        $tanggalAwal = $tanggalBulan->copy()->startOfMonth()->toDateString();
        $tanggalAkhir = $tanggalBulan->copy()->endOfMonth()->toDateString();
        $namaBulan = $tanggalBulan->copy()->locale('id')->translatedFormat('F Y');

        $ringkasanKas = DevelopmentTransaction::query()
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pemasukan, '
                .'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pengeluaran',
                [TransactionType::INCOME->value, TransactionType::EXPENSE->value]
            )
            ->first();

        $ringkasanBulan = DevelopmentTransaction::query()
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir])
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pemasukan, '
                .'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pengeluaran',
                [TransactionType::INCOME->value, TransactionType::EXPENSE->value]
            )
            ->first();

        $pemasukanBulan = (float) ($ringkasanBulan->total_pemasukan ?? 0);
        $pengeluaranBulan = (float) ($ringkasanBulan->total_pengeluaran ?? 0);
        $saldoKas = (float) ($ringkasanKas->total_pemasukan ?? 0)
            - (float) ($ringkasanKas->total_pengeluaran ?? 0);

        $transaksi = DevelopmentTransaction::query()
            ->with('project:id,name')
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir])
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('guest.laporan.pembangunan', compact(
            'bulan',
            'namaBulan',
            'pemasukanBulan',
            'pengeluaranBulan',
            'saldoKas',
            'transaksi'
        ));
    }

    public function indexInventaris(Request $request)
    {
        $inventories = Inventory::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('condition'), function ($query) use ($request) {
                $query->where('condition', $request->input('condition'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalInventaris = Inventory::count();

        $totalBaik = Inventory::where('condition', 'Baik')->count();

        $totalPerbaikan = Inventory::where('condition', 'Repair')->count();

        $totalRusakHilang = Inventory::whereIn('condition', [
            'Rusak',
            'Hilang',
        ])->count();

        return view('guest.laporan.inventaris', compact(
            'inventories',
            'totalInventaris',
            'totalBaik',
            'totalPerbaikan',
            'totalRusakHilang'
        ));
    }
}
