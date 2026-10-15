<x-layouts.admin>
    <x-slot name="title">Laporan Keuangan Masjid</x-slot>

    <div class="space-y-6">

        <!-- Widget Ringkasan (Opsional tapi sangat disarankan) -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 lg:gap-6">
            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Saldo Kas Saat Ini</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">Rp 45.500.000</p>
            </div>
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-6 shadow-sm">
                <p class="text-sm font-medium text-emerald-600">Pemasukan (Bulan Ini)</p>
                <p class="mt-2 text-3xl font-bold text-emerald-700">+ Rp 12.000.000</p>
            </div>
            <div class="rounded-2xl border border-rose-100 bg-rose-50/50 p-6 shadow-sm">
                <p class="text-sm font-medium text-rose-600">Pengeluaran (Bulan Ini)</p>
                <p class="mt-2 text-3xl font-bold text-rose-700">- Rp 4.250.000</p>
            </div>
        </div>

        <!-- Header Actions & Search -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-1 gap-3">
                <div class="relative max-w-xs flex-1">
                    <input type="text" placeholder="Cari keterangan..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <select
                    class="rounded-xl border border-gray-300 bg-white py-2.5 px-4 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <option value="">Semua Bulan</option>
                    <option value="09">September 2026</option>
                    <option value="08">Agustus 2026</option>
                </select>
            </div>

            <a href="{{ route('admin.laporan-keuangan.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Catat Transaksi
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-right">Nominal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Data Pemasukan -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-gray-900">04 Sep 2026</td>
                            <td class="px-6 py-4">Kotak Amal Jumat (Minggu 1)</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700">Pemasukan</span>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-emerald-600">+ Rp 3.500.000</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.laporan-keuangan.show', 1) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700"><svg
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg></a>
                                    <a href="{{ route('admin.laporan-keuangan.edit', 1) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]"><svg
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg></a>
                                    <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600"><svg
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Data Pengeluaran -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-gray-900">02 Sep 2026</td>
                            <td class="px-6 py-4">Pembayaran Listrik & Air Bulan Agustus</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-1 text-xs font-medium text-rose-700">Pengeluaran</span>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-rose-600">- Rp 1.250.000</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.laporan-keuangan.show', 2) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700"><svg
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg></a>
                                    <a href="{{ route('admin.laporan-keuangan.edit', 2) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]"><svg
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg></a>
                                    <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600"><svg
                                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>