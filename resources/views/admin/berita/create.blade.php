<x-layouts.admin>
    <x-slot name="title">Tulis Berita / Pengumuman</x-slot>
    <x-slot name="backUrl">{{ route('admin.berita.index') }}</x-slot>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf

        <!-- Kolom Kiri: Form Utama Konten -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Konten Berita</h3>

                <!-- Judul Berita -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Judul Berita / Pengumuman <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul"
                        placeholder="Contoh: Penyaluran Bantuan Sembako untuk Dhuafa Bulan Ini" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <!-- Kutipan Singkat -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Ringkasan / Kutipan Singkat</label>
                    <textarea rows="3" name="ringkasan"
                        placeholder="Ringkasan singkat berita yang akan muncul di kartu pengumuman depan..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"></textarea>
                </div>

                <!-- Isi Artikel Berita Lengkap -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Isi Berita Lengkap <span
                            class="text-red-500">*</span></label>
                    <textarea rows="10" name="isi"
                        placeholder="Tuliskan berita atau informasi pengumuman secara lengkap di sini..." required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"></textarea>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pengaturan Rilis & Gambar -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Pengaturan Publikasi</h3>

                <!-- Status Publikasi -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Status</label>
                    <select name="status"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none">
                        <option value="published">Diterbitkan (Publik)</option>
                        <option value="draft">Simpan Sebagai Draf</option>
                    </select>
                </div>

                <!-- Penulis / Redaksi -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Penulis / Redaksi</label>
                    <input type="text" name="penulis" value="Pengurus Masjid" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <!-- Tanggal Terbit -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Tanggal Rilis</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <!-- Gambar Sampul -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Foto Sampul / Gambar
                        Dokumentasi</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
                    <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG (Maks 2MB)</p>
                </div>

                <!-- Aksi -->
                <div class="pt-2 flex flex-col gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Simpan & Terbitkan
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
