<x-layouts.admin>
    <x-slot name="title">Detail Berita / Pengumuman</x-slot>
    <x-slot name="backUrl">{{ route('admin.berita.index') }}</x-slot>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Kolom Utama: Isi Berita -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Diterbitkan
                    </span>
                    <span class="text-xs text-gray-400">• 14 Oktober 2026</span>
                </div>

                <h1 class="text-xl font-bold text-gray-900">Penyaluran Bantuan Sembako untuk Dhuafa Bulan Ini</h1>

                <div class="overflow-hidden rounded-xl bg-gray-100 border border-gray-200 h-64 w-full">
                    <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=800" alt="Cover Berita"
                        class="h-full w-full object-cover">
                </div>

                <div class="prose max-w-none text-sm text-gray-700 leading-relaxed space-y-3 pt-2">
                    <p class="font-medium text-gray-900">Alhamdulillah, kegiatan penyaluran bantuan sembako bulanan
                        telah sukses diselenggarakan oleh Sie Sosial Masjid Al-Firdaus.</p>
                    <p>Bantuan ini bersumber dari infaq dan sedekah terikat jamaah yang dikumpulkan sepanjang bulan ini.
                        Sebanyak 50 paket sembako berupa beras, minyak goreng, gula, dan bahan pokok lainnya disalurkan
                        langsung kepada keluarga penerima manfaat di lingkungan sekitar masjid.</p>
                </div>
            </div>
        </div>

        <!-- Kolom Samping: Informasi Penulis & Aksi -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Metadata & Opsi</h3>

                <div class="space-y-2 text-xs text-gray-600">
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-400">Penulis / Redaksi:</span>
                        <span class="font-semibold text-gray-800">Haji Ridwan</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-400">Tanggal Rilis:</span>
                        <span class="font-semibold text-gray-800">14 Okt 2026</span>
                    </div>
                </div>

                <div class="pt-2 space-y-2">
                    <a href="{{ route('admin.berita.edit', 1) }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Berita
                    </a>

                    <form action="{{ route('admin.berita.destroy', 1) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Berita
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
