<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialReport;
use App\Enums\TransactionType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));

        // Validasi format bulan agar aman digunakan dalam query.
        try {
            $tanggalBulan = Carbon::createFromFormat('!Y-m', $bulan);

            if (!$tanggalBulan || $tanggalBulan->format('Y-m') !== $bulan) {
                $bulan = now()->format('Y-m');
                $tanggalBulan = now()->startOfMonth();
            }
        } catch (\Throwable $e) {
            $bulan = now()->format('Y-m');
            $tanggalBulan = now()->startOfMonth();
        }

        $tanggalAwal = $tanggalBulan->copy()->startOfMonth()->toDateString();
        $tanggalAkhir = $tanggalBulan->copy()->endOfMonth()->toDateString();

        // Total seluruh pemasukan dan pengeluaran.
        $totalPemasukan = FinancialReport::where('type', TransactionType::INCOME->value)
            ->sum('amount');

        $totalPengeluaran = FinancialReport::where('type', TransactionType::EXPENSE->value)
            ->sum('amount');

        $saldoKas = $totalPemasukan - $totalPengeluaran;

        // Total pemasukan bulan yang dipilih.
        $pemasukanBulanIni = FinancialReport::where(
            'type',
            TransactionType::INCOME->value
        )
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir])
            ->sum('amount');

        // Total pengeluaran bulan yang dipilih.
        $pengeluaranBulanIni = FinancialReport::where(
            'type',
            TransactionType::EXPENSE->value
        )
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir])
            ->sum('amount');

        // Query daftar transaksi.
        $query = FinancialReport::query()
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir]);

        // Pencarian berdasarkan keterangan transaksi.
        if ($request->filled('search')) {
            $query->where(
                'description',
                'like',
                '%' . $request->search . '%'
            );
        }

        $laporanKeuangan = $query
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.laporan-keuangan.index', compact(
            'laporanKeuangan',
            'saldoKas',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'bulan'
        ));
    }

    public function create()
    {
        return view('admin.laporan-keuangan.create');
    }

    public function store(Request $request)
    {
        // Logika simpan transaksi
    }

    public function show(string $id)
    {
        return view('admin.laporan-keuangan.show', compact('id'));
    }

    public function edit(string $id)
    {
        return view('admin.laporan-keuangan.edit', compact('id'));
    }

    public function update(Request $request, string $id)
    {
        // Logika update transaksi
    }

    public function destroy(string $id)
    {
        // Logika hapus transaksi
    }
}
