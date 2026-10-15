<x-layouts.admin>
    <x-slot name="title">Kelola Jadwal Imam Jumat</x-slot>

    <div class="space-y-6" x-data="{ openImportModal: false }">
        <!-- Header Actions, Search & Filter -->
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <!-- Pencarian & Filter Bulan (Kalender) -->
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center flex-1">
                <!-- Search Input -->
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" placeholder="Cari jadwal..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Input Filter Kalender Bulan/Tahun -->
                <form method="GET" action="{{ route('admin.jadwal-imam.index') }}"
                    class="flex w-full sm:w-auto items-center gap-2">
                    <input type="month" name="bulan" value="{{ request('bulan', date('Y-m')) }}"
                        class="w-full sm:w-auto rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <button type="submit"
                        class="shrink-0 rounded-xl bg-gray-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-gray-800">
                        Filter
                    </button>
                </form>
            </div>

            <!-- Tombol Export, Import, dan Tambah Data (Stack Vertikal di HP, Horisontal di Desktop) -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full lg:w-auto">
                <!-- Export Excel -->
                <a href="{{ route('admin.jadwal-imam.export') }}"
                    class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-xl border border-emerald-600 bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>

                <!-- Import Excel (Buka Modal) -->
                <button type="button" @click="openImportModal = true"
                    class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-xl border border-blue-600 bg-blue-50 px-4 py-2.5 text-sm font-semibold text-blue-700 transition hover:bg-blue-100">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import Excel
                </button>

                <!-- Tambah Jadwal -->
                <a href="{{ route('admin.jadwal-imam.create') }}"
                    class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm shadow-[#c49c4d]/30 transition hover:bg-[#a8833e]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Jadwal
                </a>
            </div>

        </div>

        <!-- Tabel Data Jadwal Imam Jumat (Scrollable di Layar Kecil) -->
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-160 text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Tanggal (Jumat)</th>
                            <th class="px-6 py-4">Imam Sholat</th>
                            <th class="px-6 py-4">Muadzin</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Row Dummy 1 -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-2 w-2 rounded-full bg-[#c49c4d]"></span>
                                    Jumat, 16 Oktober 2026
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-900 font-medium whitespace-nowrap">Ustadz H. Ahmad Fauzi</td>
                            <td class="px-6 py-4 text-gray-600 whitespace-nowrap">Bpk. Ridwan</td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.jadwal-imam.show', 1) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-blue-50 hover:text-blue-600"
                                        title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.jadwal-imam.edit', 1) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]"
                                        title="Edit">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.jadwal-imam.destroy', 1) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600"
                                            title="Hapus">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Row Dummy 2 -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex h-2 w-2 rounded-full bg-[#c49c4d]"></span>
                                    Jumat, 23 Oktober 2026
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-900 font-medium whitespace-nowrap">Ustadz H. Fulan, Lc.</td>
                            <td class="px-6 py-4 text-gray-600 whitespace-nowrap">Bpk. Zulkifli</td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.jadwal-imam.show', 2) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-blue-50 hover:text-blue-600"
                                        title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.jadwal-imam.edit', 2) }}"
                                        class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]"
                                        title="Edit">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.jadwal-imam.destroy', 2) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600"
                                            title="Hapus">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Import Excel (Responsive Popup) -->
        <div x-show="openImportModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            x-cloak>
            <div @click.away="openImportModal = false"
                class="w-full max-w-md rounded-2xl bg-white p-5 sm:p-6 shadow-xl space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900">Import Jadwal dari Excel</h3>
                    <button @click="openImportModal = false"
                        class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
                </div>

                <form action="{{ route('admin.jadwal-imam.import') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1">Pilih
                            File Excel (.xlsx / .xls)</label>
                        <input type="file" name="file" accept=".xlsx, .xls, .csv" required
                            class="w-full rounded-xl border border-gray-300 p-2 text-sm focus:border-[#c49c4d] focus:outline-none">
                        <p class="mt-1.5 text-xs text-gray-400">Pastikan format kolom sesuai dengan template (Tanggal,
                            Imam, Muadzin).</p>
                    </div>

                    <div
                        class="flex flex-col-reverse sm:flex-row items-center justify-end gap-2 sm:gap-3 pt-3 border-t border-gray-100">
                        <button type="button" @click="openImportModal = false"
                            class="w-full sm:w-auto rounded-xl px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto rounded-xl bg-[#c49c4d] px-5 py-2 text-sm font-semibold text-white shadow-md hover:bg-[#a8833e] transition">
                            Unggah & Import
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layouts.admin>
