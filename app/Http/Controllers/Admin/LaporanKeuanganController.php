<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialReport;
use App\Enums\TransactionType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            ->orderBy('transaction_date')
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
        $validated = $request->validate([
            'type' => ['required', Rule::in(['income', 'expense'])],
            'transaction_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:1', 'max:9999999999999.99'],
            'description' => ['required', 'string', 'max:5000'],
            'proof_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'type.required' => 'Tipe transaksi wajib dipilih.',
            'type.in' => 'Tipe transaksi tidak valid.',
            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'transaction_date.date' => 'Tanggal transaksi tidak valid.',
            'amount.required' => 'Nominal transaksi wajib diisi.',
            'amount.numeric' => 'Nominal harus berupa angka.',
            'amount.min' => 'Nominal transaksi minimal Rp1.',
            'description.required' => 'Keterangan transaksi wajib diisi.',
            'proof_file.mimes' => 'Bukti transaksi harus berupa JPG, JPEG, PNG, atau PDF.',
            'proof_file.max' => 'Ukuran bukti transaksi maksimal 2 MB.',
        ]);

        if ($request->hasFile('proof_file')) {
            $validated['proof_file'] = $request->file('proof_file')
                ->store('bukti-transaksi', 'public');
        }

        FinancialReport::create($validated);

        return redirect()
            ->route('admin.laporan-keuangan.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    public function show(string $id)
    {
        $laporan = FinancialReport::findOrFail($id);

        return view('admin.laporan-keuangan.show', compact('laporan'));
    }

    public function edit(string $id)
    {
        $laporan = FinancialReport::findOrFail($id);

        return view('admin.laporan-keuangan.edit', compact('laporan'));
    }

    public function update(Request $request, string $id)
    {
        $laporan = FinancialReport::findOrFail($id);

        $validated = $request->validate([
            'type' => ['required', Rule::in(['income', 'expense'])],
            'transaction_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:1', 'max:9999999999999.99'],
            'description' => ['required', 'string', 'max:5000'],
            'proof_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'type.required' => 'Tipe transaksi wajib dipilih.',
            'type.in' => 'Tipe transaksi tidak valid.',
            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'transaction_date.date' => 'Tanggal transaksi tidak valid.',
            'amount.required' => 'Nominal transaksi wajib diisi.',
            'amount.numeric' => 'Nominal harus berupa angka.',
            'amount.min' => 'Nominal transaksi minimal Rp1.',
            'description.required' => 'Keterangan transaksi wajib diisi.',
            'proof_file.mimes' => 'Bukti harus berupa JPG, JPEG, PNG, atau PDF.',
            'proof_file.max' => 'Ukuran bukti maksimal 2 MB.',
        ]);

        if ($request->hasFile('proof_file')) {
            $fileLama = $laporan->proof_file;

            $validated['proof_file'] = $request->file('proof_file')
                ->store('bukti-transaksi', 'public');

            $laporan->update($validated);

            if ($fileLama) {
                Storage::disk('public')->delete($fileLama);
            }
        } else {
            $laporan->update($validated);
        }

        return redirect()
            ->route('admin.laporan-keuangan.edit', $laporan->id)
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $laporan = FinancialReport::findOrFail($id);

        if ($laporan->proof_file) {
            Storage::disk('public')->delete($laporan->proof_file);
        }

        $laporan->delete();

        return redirect()
            ->route('admin.laporan-keuangan.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
