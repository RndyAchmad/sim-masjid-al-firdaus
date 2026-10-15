<x-layouts.admin>
    <x-slot name="title">Detail Transaksi Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.index') }}</x-slot>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Kolom Utama: Rincian Transaksi -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-5">

                <!-- Badge Jenis Transaksi & Tanggal -->
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <!-- Tampilkan Badge Pengeluaran atau Pemasukan -->
                        {{-- @if(($transaksi->jenis ?? 'pengeluaran') === 'pengeluaran') --}}
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span> Pengeluaran Kas
                        </span>
                        {{-- @else --}}
                        <!-- <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Pemasukan Kas
                        </span> -->
                        {{-- @endif --}}

                        <h2 class="mt-2 text-xl font-bold text-gray-900">
                            {{ $transaksi->judul ?? 'Pemasangan Keramik Lantai Utama' }}
                        </h2>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-semibold uppercase text-gray-400">Tanggal Transaksi</p>
                        <p class="text-sm font-medium text-gray-800">15 Oktober 2026</p>
                    </div>
                </div>

                <!-- Nominal Transaksi -->
                <div class="rounded-xl bg-gray-50 p-4 border border-gray-100 flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase text-gray-500">Nominal Uang</span>
                    <span class="text-2xl font-bold text-red-600">
                        - Rp {{ number_format($transaksi->nominal ?? 12500000, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Rincian Penggunaan / Peruntukan Dana -->
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">
                        Rincian Belanja / Peruntukan Dana
                    </h4>
                    <div
                        class="rounded-xl bg-gray-50/75 p-4 border border-gray-100 text-sm text-gray-700 leading-relaxed">
                        {{ $transaksi->rincian ?? '50 dus keramik granit 60x60, 10 sak semen instan, & upah 3 tukang selama 1 minggu.' }}
                    </div>
                </div>

            </div>
        </div>

        <!-- Kolom Samping: Bukti Nota & Opsi Aksi -->
        <div class="space-y-6">
            <!-- Card Foto Bukti Nota -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-3">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Bukti & Dokumentasi</h3>

                <div class="overflow-hidden rounded-xl bg-gray-100 border border-gray-200">
                    <img src="{{ asset('storage/' . ($transaksi->bukti ?? '')) }}" alt="Bukti Transaksi"
                        onerror="this.src='https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400'"
                        class="h-48 w-full object-cover">
                </div>
                <p class="text-xs text-gray-400">Foto nota/kwitansi pendukung transparansi keuangan.</p>
            </div>

            <!-- Card Opsi Pengelolaan -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-3">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Opsi Pengelolaan</h3>

                <div class="space-y-2">
                    <a href="{{ route('admin.pembangunan.edit', $transaksi->id ?? 1) }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Transaksi
                    </a>

                    <form action="{{ route('admin.pembangunan.destroy', $transaksi->id ?? 1) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data transaksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
