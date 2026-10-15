<x-layouts.admin>
    <x-slot name="title">Edit Transaksi Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.index') }}</x-slot>

    <form action="{{ route('admin.pembangunan.update', $transaksi->id ?? 1) }}" method="POST"
        enctype="multipart/form-data" x-data="{ jenis: '{{ old('jenis', $transaksi->jenis ?? 'pengeluaran') }}' }"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @method('PUT')

        <!-- Kolom Kiri: Form Utama Transaksi -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Informasi Transaksi Pembangunan</h3>

                <!-- Pilihan Jenis Transaksi -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Jenis Transaksi <span
                            class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label @click="jenis = 'pemasukan'"
                            :class="jenis === 'pemasukan' ? 'border-emerald-600 bg-emerald-50 text-emerald-800' : 'border-gray-200 bg-white text-gray-600'"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border p-3 text-sm font-semibold transition">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Pemasukan (Donasi / Infaq)
                        </label>

                        <label @click="jenis = 'pengeluaran'"
                            :class="jenis === 'pengeluaran' ? 'border-red-600 bg-red-50 text-red-800' : 'border-gray-200 bg-white text-gray-600'"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border p-3 text-sm font-semibold transition">
                            <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            Pengeluaran (Beli Material / Tukang)
                        </label>
                    </div>
                    <input type="hidden" name="jenis" :value="jenis">
                </div>

                <!-- Input Judul / Keterangan -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700"
                        x-text="jenis === 'pemasukan' ? 'Nama Donatur / Keterangan Pemasukan' : 'Nama Proyek / Pembelian'"></label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $transaksi->judul ?? 'Pemasangan Keramik Lantai Utama') }}" required
                        :placeholder="jenis === 'pemasukan' ? 'Contoh: Hamba Allah / Infaq Kotak Pembangunan' : 'Contoh: Renovasi Tempat Wudhu / Pembelian Keramik'"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Tanggal -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Tanggal Transaksi <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal"
                            value="{{ old('tanggal', $transaksi->tanggal ?? '2026-10-15') }}" required
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <!-- Nominal Uang -->
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Nominal Uang (Rp) <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="nominal"
                            value="{{ old('nominal', $transaksi->nominal ?? 12500000) }}" required
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                <!-- Rincian Penggunaan Dana -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700"
                        x-text="jenis === 'pemasukan' ? 'Peruntukan Dana (Diniatkan Untuk Apa)' : 'Rincian Belanja / Material (Beli Apa Saja)'"></label>
                    <textarea rows="4" name="rincian"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('rincian', $transaksi->rincian ?? '50 dus keramik granit 60x60, 10 sak semen instan, & upah 3 tukang selama 1 minggu.') }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">Rincian ini akan ditampilkan pada portal web publik agar
                        jamaah mengetahui alokasi dana secara transparan.</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Upload Nota / Ganti Foto & Aksi -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Bukti & Dokumentasi</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Foto Bukti / Nota Saat Ini</label>
                    <div class="overflow-hidden rounded-xl h-36 w-full mb-3 bg-gray-100 border border-gray-200">
                        <img src="{{ asset('storage/' . ($transaksi->bukti ?? '')) }}" alt="Bukti Nota"
                            onerror="this.src='https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400'"
                            class="h-full w-full object-cover">
                    </div>

                    <label class="mb-2 block text-xs font-semibold text-gray-600">Ganti Foto Bukti (Opsional)</label>
                    <input type="file" name="bukti" accept="image/*"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
                </div>

                <div class="pt-2 flex flex-col gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Perbarui Transaksi
                    </button>
                    <a href="{{ route('admin.pembangunan.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
