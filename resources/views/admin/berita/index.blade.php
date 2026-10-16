<x-layouts.admin>
    <x-slot name="title">Berita & Pengumuman Masjid</x-slot>

    <div class="space-y-6">     
        <!-- 2. Header Actions, Search & Filter Status -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" placeholder="Cari judul berita..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <select class="w-full sm:w-auto rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    <option value="">Semua Status</option>
                    <option value="published">Diterbitkan</option>
                    <option value="draft">Draf</option>
                </select>
            </div>

            <a href="{{ route('admin.berita.create') }}"
                class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e]">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tulis Berita / Pengumuman
            </a>
        </div>

        <!-- 3. Tabel Data Berita -->
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[700px] text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Judul Berita</th>
                            <th class="px-6 py-4">Penulis / Admin</th>
                            <th class="px-6 py-4">Tanggal Rilis</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Row Berita 1 -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-16 shrink-0 overflow-hidden rounded-lg bg-gray-100 border border-gray-200">
                                        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=300" alt="Cover" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Penyaluran Bantuan Sembako untuk Dhuafa Bulan Ini</p>
                                        <p class="text-xs text-gray-400">Warta Kegiatanan</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">Haji Ridwan (Seksi Sosial)</td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">14 Oktober 2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Diterbitkan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.berita.show', 1) }}" class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700" title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', 1) }}" class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]" title="Edit">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600" title="Hapus">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row Berita 2 (Pengumuman Draf) -->
                        <tr class="transition hover:bg-gray-50/50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-16 shrink-0 overflow-hidden rounded-lg bg-gray-100 border border-gray-200">
                                        <img src="https://images.unsplash.com/photo-1590076175571-4b5459efb08c?w=300" alt="Cover" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Pendaftaran Santri Baru TPA Al-Firdaus Angkatan 2026/2027</p>
                                        <p class="text-xs text-gray-400">Pengumuman Resmi</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">Ustadz Fauzi</td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">10 Oktober 2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span> Draf
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.berita.show', 2) }}" class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-700" title="Detail">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', 2) }}" class="rounded-lg p-2 text-gray-400 hover:bg-amber-50 hover:text-[#c49c4d]" title="Edit">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button class="rounded-lg p-2 text-gray-400 hover:bg-red-50 hover:text-red-600" title="Hapus">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
