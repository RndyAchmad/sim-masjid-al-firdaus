
<x-layouts.admin>
    <x-slot name="title">Laporan Keuangan Masjid</x-slot>

    <div class="space-y-6">

        {{-- RINGKASAN SALDO KAS KESELURUHAN --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs sm:p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Saldo Kas Saat Ini
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl">
                        Rp {{ number_format($saldoKas, 0, ',', '.') }}
                    </h2>

                    <p class="mt-2 text-xs text-gray-500">
                        Total pemasukan dikurangi total pengeluaran dari seluruh transaksi tercatat.
                    </p>
                </div>

                <span class="shrink-0 rounded-xl bg-gray-100 p-3 text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
        </div>

        {{-- RINGKASAN PEMASUKAN DAN PENGELUARAN --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            {{-- Pemasukan --}}
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-xs">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                            Total Pemasukan
                        </p>

                        <p class="mt-1 text-xs text-emerald-600/80">
                            {{ $namaBulan }}
                        </p>
                    </div>

                    <span class="rounded-full bg-emerald-100 p-2 text-emerald-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 11l5-5m0 0l5 5m-5-5v12" />
                        </svg>
                    </span>
                </div>

                <h3 class="mt-3 text-2xl font-bold text-emerald-700">
                    + Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                </h3>

                <p class="mt-1 text-xs text-emerald-600/80">
                    Infaq, kotak amal, dan donasi.
                </p>
            </div>

            {{-- Pengeluaran --}}
            <div class="rounded-2xl border border-rose-200 bg-rose-50/50 p-5 shadow-xs">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-rose-600">
                            Total Pengeluaran
                        </p>

                        <p class="mt-1 text-xs text-rose-600/80">
                            {{ $namaBulan }}
                        </p>
                    </div>

                    <span class="rounded-full bg-rose-100 p-2 text-rose-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                        </svg>
                    </span>
                </div>

                <h3 class="mt-3 text-2xl font-bold text-rose-700">
                    - Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                </h3>

                <p class="mt-1 text-xs text-rose-600/80">
                    Biaya operasional dan pemeliharaan masjid.
                </p>
            </div>
        </div>

        {{-- RINGKASAN SALDO PERIODE --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">

            <div class="border-b border-gray-100 px-5 py-4 sm:px-6">
                <h3 class="font-semibold text-gray-900">
                    Ringkasan Saldo Periode
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Perhitungan saldo untuk {{ $namaBulan }}.
                </p>
            </div>

            <div class="space-y-4 p-5 sm:p-6">

                {{-- Saldo Awal --}}
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700">
                            Saldo Awal Periode
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Saldo yang terbawa dari bulan sebelumnya.
                        </p>
                    </div>

                    <p class="whitespace-nowrap text-right text-sm font-semibold text-gray-900">
                        Rp {{ number_format($saldoAwalPeriode, 0, ',', '.') }}
                    </p>
                </div>

                <div class="border-t border-gray-100"></div>

                {{-- Pemasukan --}}
                <div class="flex items-start justify-between gap-4">
                    <p class="text-sm text-gray-600">
                        Pemasukan periode
                    </p>

                    <p class="whitespace-nowrap text-right text-sm font-semibold text-emerald-600">
                        + Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Pengeluaran --}}
                <div class="flex items-start justify-between gap-4">
                    <p class="text-sm text-gray-600">
                        Pengeluaran periode
                    </p>

                    <p class="whitespace-nowrap text-right text-sm font-semibold text-rose-600">
                        - Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                    </p>
                </div>

                <div class="border-t border-gray-200"></div>

                {{-- Saldo Akhir --}}
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-semibold text-gray-900">
                            {{ $periodeBelumBerjalan
                                ? 'Perkiraan Saldo Awal Periode'
                                : ($bulan === now()->format('Y-m')
                                    ? 'Saldo hingga Saat Ini'
                                    : 'Saldo Akhir Periode') }}
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Saldo awal + pemasukan - pengeluaran.
                        </p>
                    </div>

                    <p class="text-xl font-bold {{ $saldoAkhirPeriode < 0 ? 'text-rose-600' : 'text-gray-900' }}">
                        Rp {{ number_format($saldoAkhirPeriode, 0, ',', '.') }}
                    </p>
                </div>

                @if ($periodeBelumBerjalan)
                    <p class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs text-amber-800">
                        Periode {{ $namaBulan }} belum dimulai. Angka di atas menunjukkan saldo awal yang terbawa, bukan saldo akhir aktual bulan tersebut.
                    </p>
                @endif
            </div>
        </div>

        {{-- FILTER DAN AKSI --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <form
                action="{{ route('admin.laporan-keuangan.index') }}"
                method="GET"
                class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center"
            >
                {{-- Pencarian --}}
                <div class="relative w-full sm:max-w-xs">
                    <label for="search" class="sr-only">
                        Cari keterangan transaksi
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ $search }}"
                        maxlength="100"
                        placeholder="Cari keterangan transaksi..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Filter Bulan --}}
                <div class="w-full sm:w-auto">
                    <label for="bulan" class="sr-only">
                        Pilih bulan laporan
                    </label>

                    <input
                        type="month"
                        id="bulan"
                        name="bulan"
                        value="{{ $bulan }}"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto"
                    >
                </div>

                {{-- Filter --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4h18M6 10h12m-9 6h6m-4 4h2" />
                    </svg>
                    Filter
                </button>

                {{-- Reset --}}
                @if (request()->filled('search') || request()->filled('bulan'))
                    <a
                        href="{{ route('admin.laporan-keuangan.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50"
                    >
                        Reset
                    </a>
                @endif
            </form>

            {{-- Catat Transaksi --}}
            <a
                href="{{ route('admin.laporan-keuangan.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e] sm:w-auto"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Catat Transaksi
            </a>
        </div>

        {{-- TABEL BUKU KAS --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">

            {{-- Header Tabel --}}
            <div class="flex flex-col gap-1 border-b border-gray-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">
                        Buku Kas Operasional
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Periode {{ $namaBulan }}

                        @if (!$periodeBelumBerjalan && $bulan === now()->format('Y-m'))
                            · Transaksi hingga hari ini
                        @endif
                    </p>
                </div>

                <p class="text-xs text-gray-500">
                    {{ $laporanKeuangan->total() }} transaksi ditemukan
                </p>
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-225 text-left text-sm text-gray-600">

                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-right">Nominal (Rp)</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        {{-- Saldo Awal di Buku Kas --}}
                        @if (!$periodeBelumBerjalan)
                            <tr class="bg-amber-50/60">
                                <td colspan="3" class="px-6 py-4">
                                    <p class="font-semibold text-gray-800">
                                        Saldo Awal Periode
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        Saldo sebelum {{ $namaBulan }}.
                                    </p>
                                </td>

                                <td colspan="2" class="px-6 py-4 text-right font-bold text-gray-900">
                                    Rp {{ number_format($saldoAwalPeriode, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif

                        {{-- Daftar Transaksi --}}
                        @forelse ($laporanKeuangan as $laporan)
                            @php
                                $jenis = $laporan->type instanceof \App\Enums\TransactionType
                                    ? $laporan->type
                                    : \App\Enums\TransactionType::tryFrom($laporan->type);

                                $pemasukan = $jenis === \App\Enums\TransactionType::INCOME;
                            @endphp

                            <tr class="transition hover:bg-gray-50/50">

                                {{-- Tanggal --}}
                                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                    {{ \Illuminate\Support\Carbon::parse($laporan->transaction_date)->format('d-m-Y') }}
                                </td>

                                {{-- Keterangan --}}
                                <td class="px-6 py-4">
                                    <div class="min-w-48">
                                        <p class="font-semibold text-gray-900">
                                            {{ $laporan->description }}
                                        </p>
                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-semibold {{ $pemasukan
                                        ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
                                        : 'border-rose-200 bg-rose-50 text-rose-700' }}">
                                        {{ $jenis?->label() ?? ucfirst($laporan->type) }}
                                    </span>
                                </td>

                                {{-- Nominal --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right font-bold {{ $pemasukan ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $pemasukan ? '+' : '-' }}
                                    Rp {{ number_format($laporan->amount, 0, ',', '.') }}
                                </td>

                                {{-- Aksi --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Detail --}}
                                        <a
                                            href="{{ route('admin.laporan-keuangan.show', $laporan->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail"
                                            aria-label="Detail transaksi"
                                        >
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.laporan-keuangan.edit', $laporan->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit"
                                            aria-label="Edit transaksi"
                                        >
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form
                                            action="{{ route('admin.laporan-keuangan.destroy', $laporan->id) }}"
                                            method="POST"
                                            data-confirm="Transaksi {{ $laporan->description }} akan dihapus. Tindakan ini tidak dapat dibatalkan."
                                            data-confirm-title="Hapus transaksi?"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus"
                                                aria-label="Hapus transaksi"
                                            >
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="mb-3 h-10 w-10 text-gray-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z" />
                                        </svg>

                                        <p class="font-medium text-gray-700">
                                            @if ($periodeBelumBerjalan)
                                                Periode belum dimulai.
                                            @elseif ($search !== '')
                                                Transaksi tidak ditemukan.
                                            @else
                                                Belum ada transaksi pada periode ini.
                                            @endif
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            @if ($periodeBelumBerjalan)
                                                Transaksi bulan {{ $namaBulan }} belum dapat ditampilkan.
                                            @elseif ($search !== '')
                                                Coba gunakan kata kunci lain atau reset pencarian.
                                            @else
                                                Silakan pilih bulan lain atau catat transaksi baru.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="flex flex-col gap-3 border-t border-gray-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-gray-500">
                    Menampilkan
                    <span class="font-semibold text-gray-700">
                        {{ $laporanKeuangan->firstItem() ?? 0 }}–{{ $laporanKeuangan->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-semibold text-gray-700">
                        {{ $laporanKeuangan->total() }}
                    </span>
                    transaksi
                </p>

                <div>
                    {{ $laporanKeuangan->links() }}
                </div>
            </div>

        </div>
    </div>
</x-layouts.admin>
