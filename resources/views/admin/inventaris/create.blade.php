<x-layouts.admin>
    <x-slot name="title">Tambah Barang Inventaris</x-slot>
    <x-slot name="backUrl">{{ route('admin.inventaris.index') }}</x-slot>

    <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Kolom Kiri: Form Utama -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-5">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <!-- Nama Barang -->
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Barang</label>
                        <input type="text" placeholder="Misal: Mimbar Khutbah"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <!-- Kode Barang -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Kode Barang (Opsional)</label>
                        <input type="text" placeholder="Misal: INV-2026-003"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Jumlah / Kuantitas</label>
                        <div class="flex items-center gap-2">
                            <input type="number" min="1" placeholder="0"
                                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                            <select
                                class="w-1/3 rounded-xl border border-gray-300 px-3 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                                <option value="Unit">Unit</option>
                                <option value="Buah">Buah</option>
                                <option value="Roll">Roll</option>
                                <option value="Set">Set</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Keterangan / Spesifikasi</label>
                    <textarea rows="4" placeholder="Tuliskan spesifikasi, lokasi penempatan, atau catatan tambahan..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"></textarea>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Meta & Klasifikasi -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-5">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Klasifikasi Barang</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kategori</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="">Pilih Kategori</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Furniture">Furniture / Mebel</option>
                        <option value="Perlengkapan Ibadah">Perlengkapan Ibadah</option>
                        <option value="Kendaraan">Kendaraan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kondisi</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Foto Barang (Opsional)</label>
                    <div
                        class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 p-4 text-center hover:border-[#c49c4d]">
                        <svg class="h-8 w-8 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <p class="text-xs text-gray-500">Unggah gambar barang</p>
                        <input type="file" class="hidden">
                    </div>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">Simpan</button>
                    <a href="{{ route('admin.inventaris.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">Batal</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>