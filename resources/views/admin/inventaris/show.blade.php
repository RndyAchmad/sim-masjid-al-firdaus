<x-layouts.admin>
    <x-slot name="title">Detail Inventaris</x-slot>
    <x-slot name="backUrl">{{ route('admin.inventaris.index') }}</x-slot>

    <div class="max-w-4xl space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-sm space-y-6">

            <!-- Badge Kategori & Kondisi -->
            <div class="flex items-center gap-3">
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-600">Elektronik</span>
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Kondisi Baik
                </span>
            </div>

            <!-- Nama & Kode Barang -->
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Sound System (Mic & Speaker)</h1>
                <p class="mt-1 text-sm text-gray-500">Kode Barang: <span
                        class="font-semibold text-gray-700">INV-2026-001</span></p>
            </div>

            <!-- Detail Grid Info -->
            <div class="grid grid-cols-2 gap-4 rounded-xl bg-gray-50 p-5 sm:grid-cols-4">
                <div>
                    <p class="text-xs text-gray-500">Jumlah Total</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">2 Unit</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tanggal Masuk</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900">12 Jan 2026</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Diinput Oleh</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900">Sekretaris</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Terakhir Update</p>
                    <p class="mt-1 text-sm font-semibold text-gray-900">03 Sep 2026</p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="prose max-w-none text-sm text-gray-700 sm:text-base">
                <p class="font-semibold text-gray-800">Catatan / Keterangan:</p>
                <p class="mt-2">Ditempatkan di ruang utama sholat. Kondisi masih sangat prima dan rutin di-service
                    setiap 6 bulan. Digunakan khusus untuk pelaksanaan sholat Jumat dan kajian tabligh akbar.</p>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.inventaris.edit', 1) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                    Edit Data
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>