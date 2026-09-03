<x-layouts.admin>
    <x-slot name="title">Edit Artikel</x-slot>
    <x-slot name="backUrl">{{ route('admin.articles.index') }}</x-slot>

    <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Judul Artikel</label>
                    <input type="text" value="Keutamaan Menjaga Salat Berjamaah di Masjid"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Ringkasan / Kutipan Singkat</label>
                    <textarea rows="3"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">Penjelasan mendalam mengenai pahala 27 derajat serta keutamaan langkah kaki menuju masjid.</textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Isi Artikel Lengkap</label>
                    <textarea rows="10"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">Salat berjamaah di masjid memiliki keutamaan luar biasa bagi kaum muslimin...</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Pengaturan Artikel</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kategori</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="fiqih" selected>Fiqih</option>
                        <option value="akhlak">Akhlak</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Gambar Cover / Thumbnail Saat
                        Ini</label>
                    <div class="overflow-hidden rounded-xl h-32 w-full mb-2 bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?w=300" alt="Cover"
                            class="h-full w-full object-cover">
                    </div>
                    <button type="button" class="text-xs text-[#c49c4d] font-semibold hover:underline">Ganti Foto
                        Cover</button>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">Perbarui</button>
                    <a href="{{ route('admin.articles.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">Batal</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>