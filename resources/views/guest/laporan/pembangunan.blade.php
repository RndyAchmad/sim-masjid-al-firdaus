<x-layouts.guest>
    {{-- Header Banner Halaman Keuangan Pembangunan --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Infaq & Wakaf Pembangunan
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Laporan Keuangan Pembangunan
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Laporan penerimaan infak, wakaf terikat, dan pengeluaran proyek pembangunan & renovasi Masjid Al-Firdaus
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Sejuk / Off-White) --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            {{-- 1. SECTION RINGKASAN SALDO KAS PEMBANGUNAN --}}
            <section>
                {{-- Header Section (Rata Tengah) --}}
                <div class="mb-8 text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                        Akuntabilitas & Amanah
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                        Ringkasan Kas Pembangunan
                    </h2>
                    <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                        Ikhtisar rekapitulasi penerimaan infak/wakaf dan pengeluaran material & renovasi.
                    </p>
                </div>

                {{-- Card Grid Ringkasan Kas Pembangunan --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                    {{-- Card 1: Total Pemasukan --}}
                    <div
                        class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md transition-all duration-300 hover:border-emerald-500 hover:shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Pemasukan Bulan
                                Ini</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            Rp 25.500.000
                        </p>
                        <p class="mt-2 text-xs text-emerald-600 font-medium flex items-center gap-1">
                            <span>▲ Wakaf Semen, Infaq Material & Transfer Donatur</span>
                        </p>
                    </div>

                    {{-- Card 2: Total Pengeluaran --}}
                    <div
                        class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md transition-all duration-300 hover:border-rose-500 hover:shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Pengeluaran Bulan
                                Ini</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600 border border-rose-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            Rp 18.200.000
                        </p>
                        <p class="mt-2 text-xs text-rose-600 font-medium flex items-center gap-1">
                            <span>▼ Pembelian Material, Besi, & Upah Tukang</span>
                        </p>
                    </div>

                    {{-- Card 3: Saldo Akhir Kas Pembangunan --}}
                    <div
                        class="rounded-2xl border border-[#8c6b2d]/30 bg-linear-to-br from-white via-white to-[#F7F4EE] p-6 shadow-md transition-all duration-300 hover:border-[#8c6b2d] hover:shadow-xl sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">Saldo Kas
                                Pembangunan</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8c6b2d]/10 text-[#8c6b2d] border border-[#8c6b2d]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-[#8c6b2d] sm:text-3xl">
                            Rp 36.600.000
                        </p>
                        <p class="mt-2 text-xs text-gray-500 font-medium">
                            Saldo kas siap pakai untuk kelanjutan renovasi
                        </p>
                    </div>

                </div>
            </section>

            {{-- Separator Pembatas --}}
            <div class="border-t border-stone-200/80"></div>

            {{-- 2. SECTION TABEL MUTASI TRANSAKSI PEMBANGUNAN --}}
            <section>
                {{-- Header & Filter Periode --}}
                <div class="mb-8 flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                            Rincian Transaksi
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Buku Kas Pembangunan
                        </h2>
                    </div>

                    {{-- Filter Bulan & Tahun --}}
                    <div class="flex items-center gap-2">
                        <select
                            class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            <option value="10">Oktober</option>
                            <option value="09">September</option>
                            <option value="08">Agustus</option>
                        </select>
                        <select
                            class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>

                {{-- Tabel Transaksi Responsif (Sesuai Kolom Admin) --}}
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs sm:text-sm text-gray-600">
                            <thead
                                class="bg-stone-100 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-stone-200">
                                <tr>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Tanggal</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Keterangan / Transaksi</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Kategori / Alokasi</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Jenis</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4 text-right">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 bg-white font-sans">

                                {{-- Baris Transaksi 1 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        15 Okt 2026</td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Pembayaran Rangka Baja Ringan & Atap Spandek Kanopi (Termin 1)
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-500">
                                        Material & Konstruksi
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold text-rose-700 border border-rose-200">
                                            Pengeluaran
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-right font-mono font-bold text-rose-600">
                                        - 12.500.000
                                    </td>
                                </tr>

                                {{-- Baris Transaksi 2 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        10 Okt 2026</td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Hamba Allah (Transfer BSI) - Infaq Spesial Pembangunan
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-500">
                                        Infaq Terikat / Donasi
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 border border-emerald-200">
                                            Pemasukan
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-right font-mono font-bold text-emerald-600">
                                        + 10.000.000
                                    </td>
                                </tr>

                                {{-- Baris Transaksi 3 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        04 Okt 2026</td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Upah Tukang & Pekerja Pengecoran Minggu Ke-1 (4 Orang)
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-500">
                                        Upah Tukang
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold text-rose-700 border border-rose-200">
                                            Pengeluaran
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-right font-mono font-bold text-rose-600">
                                        - 4.200.000
                                    </td>
                                </tr>

                                {{-- Baris Transaksi 4 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        01 Okt 2026</td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Bpk. H. Sutrisno - Wakaf Semen (50 Sak) & Pasir Cor
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-500">
                                        Wakaf Material
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 border border-emerald-200">
                                            Pemasukan
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-right font-mono font-bold text-emerald-600">
                                        + 5.500.000
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>
