<x-layouts.admin>
    <x-slot name="title">Kas & Pembangunan Masjid</x-slot>

    <div class="space-y-8">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span>Administrasi</span>
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.08 0Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium text-gray-700">Kas Pembangunan</span>
                </div>

                <h1 class="mt-2 text-2xl font-bold tracking-tight text-gray-900">
                    Kas & Pembangunan
                </h1>

                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
                    Kelola dana pembangunan, pantau proyek, dan catat pemasukan serta pengeluaran secara teratur.
                </p>
            </div>

            <a
                href="{{ route('admin.pembangunan.transactions.create') }}"
                class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/>
                </svg>
                Catat Transaksi
            </a>
        </section>


        {{-- =========================================================
            RINGKASAN KAS
        ========================================================== --}}
        <section>
            <div class="mb-4">
                <h2 class="text-base font-bold text-gray-900">
                    Ringkasan Kas Pembangunan
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Gambaran keseluruhan dana pembangunan masjid.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                {{-- Saldo --}}
                <article class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-500">
                                Saldo Kas Pembangunan
                            </p>

                            <p class="mt-3 break-words text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                Rp {{ number_format((float) $saldoKas, 0, ',', '.') }}
                            </p>

                            <p class="mt-3 text-xs leading-5 text-gray-500">
                                Akumulasi seluruh pemasukan dikurangi pengeluaran.
                            </p>
                        </div>

                        <div class="shrink-0 rounded-xl bg-gray-100 p-3 text-gray-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </div>
                    </div>
                </article>

                {{-- Pemasukan --}}
                <article class="rounded-2xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-emerald-700">
                                Pemasukan
                            </p>

                            <p class="mt-1 text-xs text-emerald-600">
                                {{ $namaBulan }}
                            </p>

                            <p class="mt-3 break-words text-2xl font-bold tracking-tight text-emerald-700 sm:text-3xl">
                                Rp {{ number_format((float) $pemasukanBulanIni, 0, ',', '.') }}
                            </p>

                            <p class="mt-3 text-xs leading-5 text-emerald-700/80">
                                Dana yang diterima pada periode terpilih.
                            </p>
                        </div>

                        <div class="shrink-0 rounded-xl bg-emerald-100 p-3 text-emerald-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 14l5-5m0 0 5 5m-5-5v12"/>
                            </svg>
                        </div>
                    </div>
                </article>

                {{-- Pengeluaran --}}
                <article class="rounded-2xl border border-rose-200 bg-rose-50/50 p-5 shadow-sm md:col-span-2 xl:col-span-1">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-rose-700">
                                Pengeluaran
                            </p>

                            <p class="mt-1 text-xs text-rose-600">
                                {{ $namaBulan }}
                            </p>

                            <p class="mt-3 break-words text-2xl font-bold tracking-tight text-rose-700 sm:text-3xl">
                                Rp {{ number_format((float) $pengeluaranBulanIni, 0, ',', '.') }}
                            </p>

                            <p class="mt-3 text-xs leading-5 text-rose-700/80">
                                Dana yang digunakan pada periode terpilih.
                            </p>
                        </div>

                        <div class="shrink-0 rounded-xl bg-rose-100 p-3 text-rose-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 10l-5 5m0 0-5-5m5 5V3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 17v3h16v-3"/>
                            </svg>
                        </div>
                    </div>
                </article>

            </div>
        </section>


        {{-- =========================================================
            PROYEK PEMBANGUNAN
        ========================================================== --}}
        <section>
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        Proyek Pembangunan
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Proyek yang sudah dibuat beserta ringkasan dananya.
                    </p>
                </div>

                <a
                    href="{{ route('admin.pembangunan.projects.create') }}"
                    class="inline-flex items-center justify-center gap-2 self-start rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/>
                    </svg>
                    Buat Proyek
                </a>
            </div>

            @if ($proyekPembangunan->isNotEmpty())
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 2xl:grid-cols-3">

                    @foreach ($proyekPembangunan as $proyek)
                        @php
                            $targetDana = (float) $proyek->target_amount;
                            $pemasukanProyek = (float) ($proyek->total_pemasukan ?? 0);
                            $pengeluaranProyek = (float) ($proyek->total_pengeluaran ?? 0);
                            $saldoProyek = $pemasukanProyek - $pengeluaranProyek;

                            $persentaseDana = $targetDana > 0
                                ? min(100, max(0, ($pemasukanProyek / $targetDana) * 100))
                                : 0;

                            $statusProyek = $proyek->status;

                            $warnaStatus = match ($statusProyek) {
                                \App\Enums\DevelopmentProjectStatus::ONGOING =>
                                    'border-emerald-200 bg-emerald-50 text-emerald-700',
                                \App\Enums\DevelopmentProjectStatus::COMPLETED =>
                                    'border-blue-200 bg-blue-50 text-blue-700',
                                \App\Enums\DevelopmentProjectStatus::PAUSED =>
                                    'border-amber-200 bg-amber-50 text-amber-700',
                                default =>
                                    'border-gray-200 bg-gray-100 text-gray-700',
                            };
                        @endphp

                        <article class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md">

                            @if ($proyek->image)
                                <div class="h-40 overflow-hidden bg-gray-100">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($proyek->image) }}"
                                        alt="Gambar {{ $proyek->name }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                </div>
                            @endif

                            <div class="space-y-5 p-5">

                                {{-- Nama dan status --}}
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <h3 class="break-words text-base font-bold text-gray-900">
                                            {{ $proyek->name }}
                                        </h3>

                                        <p class="mt-1 text-xs text-gray-500">
                                            @if ($proyek->start_date)
                                                Mulai {{ $proyek->start_date->translatedFormat('d M Y') }}
                                            @else
                                                Tanggal mulai belum ditentukan
                                            @endif
                                        </p>
                                    </div>

                                    <span class="shrink-0 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $warnaStatus }}">
                                        {{ $statusProyek?->label() ?? 'Belum ditentukan' }}
                                    </span>
                                </div>

                                {{-- Pencapaian dana --}}
                                <div>
                                    <div class="flex items-start justify-between gap-3">
                                        <p class="text-sm text-gray-500">
                                            Pemasukan proyek
                                        </p>

                                        <p class="break-words text-right text-sm font-bold text-gray-900">
                                            Rp {{ number_format($pemasukanProyek, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    @if ($targetDana > 0)
                                        <div class="mt-3 h-2.5 overflow-hidden rounded-full bg-gray-100">
                                            <div
                                                class="h-full rounded-full bg-[#c49c4d] transition-all duration-300"
                                                style="width: {{ $persentaseDana }}%"
                                            ></div>
                                        </div>

                                        <div class="mt-2 flex items-start justify-between gap-3">
                                            <span class="text-xs font-medium text-[#a8833e]">
                                                {{ number_format($persentaseDana, 1, ',', '.') }}% dari target
                                            </span>

                                            <span class="text-right text-xs text-gray-500">
                                                Target Rp {{ number_format($targetDana, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @else
                                        <p class="mt-2 text-xs text-gray-500">Target anggaran belum ditetapkan.</p>
                                    @endif
                                </div>

                                {{-- Pengeluaran dan selisih --}}
                                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-4">
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500">
                                            Pengeluaran proyek
                                        </p>

                                        <p class="mt-1 break-words text-sm font-semibold text-rose-600">
                                            Rp {{ number_format($pengeluaranProyek, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500">
                                            Selisih transaksi
                                        </p>

                                        <p class="mt-1 break-words text-sm font-semibold {{ $saldoProyek < 0 ? 'text-rose-600' : 'text-gray-900' }}">
                                            Rp {{ number_format($saldoProyek, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                @if ($proyek->end_date)
                                    <div class="text-xs text-gray-500">
                                        Target selesai:
                                        <span class="font-medium text-gray-700">
                                            {{ $proyek->end_date->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                @endif

                                <div class="flex justify-end border-t border-gray-100 pt-3">
                                    <a
                                        href="{{ route('admin.pembangunan.projects.show', $proyek) }}"
                                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#a8833e] transition hover:text-[#8b6a2f]"
                                    >
                                        Lihat proyek
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </article>
                    @endforeach

                </div>
            @else
                <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-[#c49c4d]">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M3 21h18M5 21V7l8-4v18m6 0V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/>
                        </svg>
                    </div>

                    <h3 class="mt-4 text-base font-bold text-gray-900">
                        Belum ada proyek pembangunan
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        Tidak masalah jika saat ini belum ada pembangunan. Kas pembangunan tetap dapat menerima infak dan mencatat transaksi umum.
                        Buat proyek baru ketika masjid mulai merencanakan pembangunan atau renovasi.
                    </p>

                    <a
                        href="{{ route('admin.pembangunan.projects.create') }}"
                        class="mt-5 inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/>
                        </svg>
                        Buat Proyek Pertama
                    </a>
                </div>
            @endif
        </section>


        {{-- =========================================================
            RIWAYAT TRANSAKSI
        ========================================================== --}}
        <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Header riwayat --}}
            <div class="flex flex-col gap-3 border-b border-gray-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        Riwayat Transaksi
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Seluruh pemasukan dan pengeluaran kas pembangunan, baik umum maupun terkait proyek.
                    </p>
                </div>

                <span class="inline-flex w-fit items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">
                    {{ $transaksiPembangunan->total() }} transaksi
                </span>
            </div>


            {{-- FILTER TRANSAKSI --}}
            <form
                action="{{ route('admin.pembangunan.index') }}"
                method="GET"
                class="space-y-4 border-b border-gray-100 bg-gray-50/70 p-4 sm:p-5"
            >
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Pencarian --}}
                    <div>
                        <label for="search" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Pencarian
                        </label>

                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>

                            <input
                                type="search"
                                id="search"
                                name="search"
                                value="{{ $search }}"
                                maxlength="100"
                                placeholder="Donatur, peruntukan, proyek..."
                                class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-9 pr-3 text-sm text-gray-700 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                            >
                        </div>
                    </div>

                    {{-- Bulan --}}
                    <div>
                        <label for="bulan" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Periode transaksi
                        </label>

                        <input
                            type="month"
                            id="bulan"
                            name="bulan"
                            value="{{ $bulan }}"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        >
                    </div>

                    {{-- Jenis --}}
                    <div>
                        <label for="jenis" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Jenis transaksi
                        </label>

                        <select
                            id="jenis"
                            name="jenis"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        >
                            <option value="">Semua jenis</option>
                            <option value="income" @selected($jenis === 'income')>
                                Pemasukan
                            </option>
                            <option value="expense" @selected($jenis === 'expense')>
                                Pengeluaran
                            </option>
                        </select>
                    </div>

                    {{-- Proyek --}}
                    <div>
                        <label for="proyek" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Kategori transaksi
                        </label>

                        <select
                            id="proyek"
                            name="proyek"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        >
                            <option value="">Semua transaksi</option>
                            <option value="umum" @selected($proyekId === 'umum')>Kas Pembangunan Umum</option>

                            @foreach ($proyekPembangunan as $proyek)
                                <option
                                    value="{{ $proyek->id }}"
                                    @selected((string) $proyekId === (string) $proyek->id)
                                >
                                    {{ $proyek->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="flex flex-col gap-2 border-t border-gray-200 pt-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs leading-5 text-gray-500">
                        Pilih periode dan kategori untuk menemukan transaksi tertentu.
                    </p>

                    <div class="flex flex-wrap items-center gap-2">
                        @if (request()->filled('search') || request()->filled('bulan') || request()->filled('jenis') || request()->filled('proyek'))
                            <a
                                href="{{ route('admin.pembangunan.index') }}"
                                class="inline-flex min-h-10 items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100"
                            >
                                Reset
                            </a>
                        @endif

                        <button
                            type="submit"
                            class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2 text-sm font-semibold text-white transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M6 10h12m-9 6h6"/>
                            </svg>
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>


            {{-- INFORMASI HASIL --}}
            <div class="flex flex-col gap-1 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <p class="text-sm text-gray-600">
                    Menampilkan
                    <span class="font-semibold text-gray-900">
                        {{ $transaksiPembangunan->firstItem() ?? 0 }}–{{ $transaksiPembangunan->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-semibold text-gray-900">
                        {{ $transaksiPembangunan->total() }}
                    </span>
                    transaksi
                </p>

                <p class="text-xs text-gray-500">
                    Periode {{ $namaBulan }}
                </p>
            </div>


            {{-- TABEL --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1150px] text-left text-sm">

                    <thead class="border-y border-gray-100 bg-gray-50">
                        <tr class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="whitespace-nowrap px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Proyek / Kategori</th>
                            <th class="px-5 py-4">Jenis</th>
                            <th class="px-5 py-4">Sumber dana</th>
                            <th class="px-5 py-4">Peruntukan</th>
                            <th class="whitespace-nowrap px-5 py-4 text-right">Nominal</th>
                            <th class="px-5 py-4 text-center">Bukti</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($transaksiPembangunan as $transaksi)
                            @php
                                $isPemasukan = $transaksi->type === \App\Enums\TransactionType::INCOME;
                            @endphp

                            <tr class="transition hover:bg-gray-50/80">

                                {{-- Tanggal --}}
                                <td class="whitespace-nowrap px-5 py-4 align-top">
                                    <p class="font-semibold text-gray-800">
                                        {{ $transaksi->transaction_date?->translatedFormat('d M Y') ?? '-' }}
                                    </p>
                                </td>

                                {{-- Proyek --}}
                                <td class="px-5 py-4 align-top">
                                    @if ($transaksi->project)
                                        <div class="flex items-start gap-2">

                                            <div class="min-w-0">
                                                <p class="max-w-48 break-words font-semibold text-gray-800">
                                                    {{ $transaksi->project->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500">
                                                    Transaksi proyek
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-start gap-2">

                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    Kas Pembangunan Umum
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500">
                                                    Tanpa proyek khusus
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                {{-- Jenis transaksi --}}
                                <td class="whitespace-nowrap px-5 py-4 align-top">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1.5 text-xs font-semibold {{ $isPemasukan
                                        ? 'bg-emerald-50 text-emerald-700'
                                        : 'bg-rose-50 text-rose-700' }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $isPemasukan ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>

                                        {{ $transaksi->type?->label() ?? '-' }}
                                    </span>
                                </td>

                                {{-- Sumber --}}
                                <td class="px-5 py-4 align-top">
                                    <p class="max-w-48 break-words font-medium text-gray-800">
                                        {{ $transaksi->donor_or_source ?: '-' }}
                                    </p>
                                </td>

                                {{-- Peruntukan --}}
                                <td class="px-5 py-4 align-top">
                                    <p class="max-w-56 whitespace-normal break-words leading-5 text-gray-600">
                                        {{ $transaksi->purpose ?: '-' }}
                                    </p>
                                </td>

                                {{-- Nominal --}}
                                <td class="whitespace-nowrap px-5 py-4 text-right align-top">
                                    <p class="font-bold {{ $isPemasukan ? 'text-emerald-700' : 'text-rose-700' }}">
                                        {{ $isPemasukan ? '+' : '-' }} Rp {{ number_format((float) $transaksi->amount, 0, ',', '.') }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-center align-top">
                                    @if ($transaksi->proof_file)
                                        <a
                                            href="{{ \Illuminate\Support\Facades\Storage::url($transaksi->proof_file) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1 rounded-lg px-2 py-1.5 text-xs font-semibold text-[#a8833e] transition hover:bg-amber-50"
                                        >
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="whitespace-nowrap px-5 py-4 text-right align-top">
                                    <div class="flex items-center justify-end gap-1">

                                        <a
                                            href="{{ route('admin.pembangunan.transactions.show', $transaksi) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Lihat detail"
                                            aria-label="Lihat detail transaksi"
                                        >
                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z"/>
                                                <circle cx="12" cy="12" r="3" stroke-width="1.8"/>
                                            </svg>
                                        </a>

                                        <a
                                            href="{{ route('admin.pembangunan.transactions.edit', $transaksi) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#a8833e]"
                                            title="Edit transaksi"
                                            aria-label="Edit transaksi"
                                        >
                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16.862 4.487 2.651 2.651M4 20l4.5-.9L19.51 8.09a1.875 1.875 0 0 0-2.65-2.65L5.85 16.45 4 20Z"/>
                                            </svg>
                                        </a>

                                        <form
                                            action="{{ route('admin.pembangunan.transactions.destroy', $transaksi) }}"
                                            method="POST"
                                            data-confirm="Transaksi ini akan dihapus secara permanen."
                                            data-confirm-title="Hapus transaksi?"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-rose-50 hover:text-rose-600"
                                                title="Hapus transaksi"
                                                aria-label="Hapus transaksi"
                                            >
                                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M9 7V4h6v3m-9 0 1 13h10l1-13M10 11v5m4-5v5"/>
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-14 text-center">
                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                                        </svg>
                                    </div>

                                    <h3 class="mt-4 font-semibold text-gray-900">
                                        Belum ada transaksi pada periode ini
                                    </h3>

                                    <p class="mx-auto mt-1 max-w-md text-sm leading-6 text-gray-500">
                                        Coba ubah periode atau filter pencarian. Jika belum ada transaksi pembangunan, kamu bisa mencatatnya kapan saja.
                                    </p>

                                    <a
                                        href="{{ route('admin.pembangunan.transactions.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]"
                                    >
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/>
                                        </svg>
                                        Catat Transaksi
                                    </a>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>


            {{-- PAGINATION --}}
            @if ($transaksiPembangunan->hasPages())
                <div class="flex flex-col gap-3 border-t border-gray-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-xs text-gray-500">
                        Halaman {{ $transaksiPembangunan->currentPage() }}
                        dari {{ $transaksiPembangunan->lastPage() }}
                    </p>

                    <div>
                        {{ $transaksiPembangunan->links() }}
                    </div>
                </div>
            @endif

        </section>

    </div>
</x-layouts.admin>
