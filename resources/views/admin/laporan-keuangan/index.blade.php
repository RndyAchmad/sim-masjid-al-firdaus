<x-layouts.admin>
    <x-slot name="title">Laporan Keuangan Masjid</x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- Card 1: Saldo Kas (Kiri) -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Saldo Kas Saat Ini</p>
                    <span class="rounded-full bg-gray-100 p-1.5 text-gray-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <h3 class="mt-2 text-2xl font-bold text-gray-900">Rp 45.500.000</h3>
                <p class="mt-1 text-xs text-gray-400">Total kas operasional aktif</p>
            </div>

            <!-- Card 2: Pemasukan (Tengah) -->
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Pemasukan (Bulan Ini)</p>
                    <span class="rounded-full bg-emerald-100 p-1.5 text-emerald-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 11l5-5m0 0l5 5m-5-5v12" />
                        </svg>
                    </span>
                </div>
                <h3 class="mt-2 text-2xl font-bold text-emerald-700">+ Rp 12.000.000</h3>
                <p class="mt-1 text-xs text-emerald-600/80">Infaq, Kotak Amal & Donasi</p>
            </div>

            <!-- Card 3: Pengeluaran (Kanan) -->
            <div class="rounded-2xl border border-rose-200 bg-rose-50/50 p-5 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wider text-rose-600">Pengeluaran (Bulan Ini)</p>
                    <span class="rounded-full bg-rose-100 p-1.5 text-rose-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                        </svg>
                    </span>
                </div>
                <h3 class="mt-2 text-2xl font-bold text-rose-700">- Rp 4.250.000</h3>
                <p class="mt-1 text-xs text-rose-600/80">Operasional & Pemeliharaan</p>
            </div>
        </div>

        <!-- 2. Action Bar, Search & Filter Bulan -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" placeholder="Cari keterangan transaksi..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Input Filter Kalender Bulan/Tahun -->
                <form method="GET" action="" class="flex w-full sm:w-auto items-center gap-2">
                    <input type="month" name="bulan" value="{{ request('bulan', date('Y-m')) }}"
                        class="w-full sm:w-auto rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <button type="submit"
                        class="shrink-0 rounded-xl bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-800">
                        Filter
                    </button>
                </form>
            </div>

            <a href="{{ route('admin.laporan-keuangan.create') }}"
                class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e]">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Catat Transaksi
            </a>
        </div>

        <!-- 3. Tabel Data Keuangan (Responsive dengan Scrollbar) -->
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-175 text-left text-sm text-gray-600">
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
                        <!-- Data Pemasukan -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">04 Sep 2026</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">Kotak Amal Jumat (Minggu 1)</p>
                                <p class="text-xs text-gray-400">Infaq Operasional</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Pemasukan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-emerald-600 whitespace-nowrap">+ Rp 3.500.000
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.laporan-keuangan.show', 1) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700"
                                        title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.laporan-keuangan.edit', 1) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]"
                                        title="Edit">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600"
                                        title="Hapus">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Data Pengeluaran -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">02 Sep 2026</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">Pembayaran Listrik & Air</p>
                                <p class="text-xs text-gray-400">Periode Bulan Agustus</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Pengeluaran
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-rose-600 whitespace-nowrap">- Rp 1.250.000
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.laporan-keuangan.show', 2) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700"
                                        title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.laporan-keuangan.edit', 2) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]"
                                        title="Edit">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600"
                                        title="Hapus">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
