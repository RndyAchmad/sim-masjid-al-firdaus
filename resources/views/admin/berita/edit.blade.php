<x-layouts.admin>
    <x-slot name="title">Edit Berita / Pengumuman</x-slot>
    <x-slot name="backUrl">{{ route('admin.berita.index') }}</x-slot>

    <form action="{{ route('admin.berita.update', $berita->id ?? 1) }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @method('PUT')

        <!-- Kolom Kiri: Form Utama Konten -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Edit Konten Berita</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Judul Berita / Pengumuman</label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $berita->judul ?? 'Penyaluran Bantuan Sembako untuk Dhuafa Bulan Ini') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Ringkasan / Kutipan Singkat</label>
                    <textarea rows="3" name="ringkasan"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('ringkasan', $berita->ringkasan ?? 'Penyaluran bantuan paket sembako kepada 50 penerima manfaat di lingkungan sekitar masjid.') }}</textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Isi Berita Lengkap</label>
                    <textarea rows="10" name="isi" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('isi', $berita->isi ?? 'Alhamdulillah, kegiatan penyaluran bantuan sembako telah terlaksana dengan lancar pada hari Ahad kemarin...') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pengaturan Rilis & Foto -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Pengaturan Publikasi</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Status</label>
                    <select name="status"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none">
                        <option value="published" selected>Diterbitkan (Publik)</option>
                        <option value="draft">Draf</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Penulis / Redaksi</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis ?? 'Haji Ridwan') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Tanggal Rilis</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal ?? '2026-10-14') }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Foto Sampul Saat Ini</label>
                    <div class="overflow-hidden rounded-xl h-36 w-full mb-2 bg-gray-100 border border-gray-200">
                        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=400" alt="Cover Berita"
                            class="h-full w-full object-cover">
                    </div>
                    <label class="mb-2 block text-xs font-semibold text-gray-600">Ganti Foto Sampul (Opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
                </div>

                <div class="pt-2 flex flex-col gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Perbarui Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
