<x-layouts.admin>
    <x-slot name="title">Tambah Artikel Baru</x-slot>
    <x-slot name="backUrl">{{ route('admin.articles.index') }}</x-slot>

    <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Kolom Kiri: Form Utama -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Judul Artikel</label>
                    <input type="text" placeholder="Masukkan judul artikel..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Ringkasan / Kutipan Singkat</label>
                    <textarea rows="3" placeholder="Tuliskan gambaran singkat isi artikel..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Isi Artikel Lengkap</label>
                    <textarea rows="10" placeholder="Tulis isi artikel di sini..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"></textarea>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Meta & Publish Options -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Pengaturan Artikel</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kategori</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="">Pilih Kategori</option>
                        <option value="fiqih">Fiqih</option>
                        <option value="akhlak">Akhlak</option>
                        <option value="sejarah">Sejarah Islam</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Gambar Cover / Thumbnail</label>
                    <div
                        class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 p-4 text-center hover:border-[#c49c4d]">
                        <svg class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xs text-gray-500">Klik atau drag foto ke sini</p>
                        <input type="file" class="hidden">
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Status</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="published">Publikasikan Langsung</option>
                        <option value="draft">Simpan sebagai Draft</option>
                    </select>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">Simpan</button>
                    <a href="{{ route('admin.articles.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">Batal</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>