<x-layouts.admin>
    <x-slot name="title">Detail Transaksi</x-slot>
    <x-slot name="backUrl">{{ route('admin.laporan-keuangan.index') }}</x-slot>

    <div class="max-w-3xl">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            <!-- Banner Warna Berdasarkan Tipe -->
            <div class="bg-rose-50 px-6 py-6 sm:px-8 border-b border-rose-100 flex items-center justify-between">
                <div>
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-800">
                        PENGELUARAN
                    </span>
                    <h2 class="mt-2 text-xl font-bold text-gray-900">Pembayaran Listrik & Air</h2>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500">Nominal</p>
                    <p class="text-2xl font-bold text-rose-700">Rp 1.250.000</p>
                </div>
            </div>

            <div class="p-6 sm:p-8 space-y-6">
                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 rounded-xl bg-gray-50 p-5 border border-gray-100">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Tanggal Transaksi</p>
                        <p class="font-semibold text-gray-900">02 Sep 2026</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">ID Transaksi</p>
                        <p class="font-semibold text-gray-900">TRX-0926-002</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Dicatat Oleh</p>
                        <p class="font-semibold text-gray-900">Bendahara Masjid</p>
                    </div>
                </div>

                <!-- Keterangan Detail -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">Keterangan Detail:</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Pembayaran Listrik & Air Masjid Al-Firdaus Bulan Agustus 2026. Pembayaran dilakukan via transfer
                        bank ke rekening PLN dan PDAM wilayah Sidoarjo.
                    </p>
                </div>

                <!-- Lampiran Bukti -->
                <div class="pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-800 mb-4">Lampiran Bukti (Nota/Kwitansi):</h3>
                    <div
                        class="flex items-center gap-4 rounded-xl border border-gray-200 p-4 w-max hover:bg-gray-50 transition">
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-100 text-red-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">bukti_pembayaran_listrik.pdf</p>
                            <p class="text-xs text-gray-500">450 KB</p>
                        </div>
                        <button
                            class="ml-4 rounded-lg bg-gray-100 p-2 text-gray-600 hover:bg-[#c49c4d] hover:text-white transition">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Actions Button -->
                <div class="pt-6 mt-6 flex justify-end gap-3 border-t border-gray-100">
                    <a href="{{ route('admin.laporan-keuangan.edit', 2) }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                        Edit Data
                    </a>
                    <button
                        class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
                        Hapus Transaksi
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>