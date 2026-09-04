<x-layouts.admin>
    <x-slot name="title">Edit Inventaris</x-slot>
    <x-slot name="backUrl">{{ route('admin.inventaris.index') }}</x-slot>

    <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-5">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Barang</label>
                        <input type="text" value="Sound System (Mic & Speaker)"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Kode Barang</label>
                        <input type="text" value="INV-2026-001"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Jumlah / Kuantitas</label>
                        <div class="flex items-center gap-2">
                            <input type="number" value="2"
                                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                            <select
                                class="w-1/3 rounded-xl border border-gray-300 px-3 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                                <option value="Unit" selected>Unit</option>
                                <option value="Buah">Buah</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Keterangan / Spesifikasi</label>
                    <textarea rows="4"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">Ditempatkan di ruang utama sholat. Kondisi masih sangat prima dan rutin di-service setiap 6 bulan.</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-5">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Klasifikasi Barang</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kategori</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="Elektronik" selected>Elektronik</option>
                        <option value="Furniture">Furniture / Mebel</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kondisi</label>
                    <select
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="Baik" selected>Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">Perbarui</button>
                    <a href="{{ route('admin.inventaris.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">Batal</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>