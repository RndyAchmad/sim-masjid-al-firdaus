<x-layouts.admin>
    <x-slot name="title">Detail Transaksi</x-slot>
    <x-slot name="backUrl">{{ route('admin.laporan-keuangan.index') }}</x-slot>

    @php
        $jenis = $laporan->type instanceof \BackedEnum
            ? $laporan->type->value
            : $laporan->type;

        $pemasukan = $jenis === 'income';

        $tanggalTransaksi = $laporan->transaction_date
            ? \Illuminate\Support\Carbon::parse($laporan->transaction_date)->translatedFormat('d F Y')
            : '-';

        $urlBukti = $laporan->proof_file
            ? asset('storage/' . $laporan->proof_file)
            : null;

        $namaFile = $laporan->proof_file
            ? basename($laporan->proof_file)
            : null;

        $ekstensi = $namaFile
            ? strtolower(pathinfo($namaFile, PATHINFO_EXTENSION))
            : null;

        $isPdf = $ekstensi === 'pdf';
        $isImage = in_array($ekstensi, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
    @endphp

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Kolom Kiri: Informasi Transaksi --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">

                {{-- Header --}}
                <div
                    class="flex flex-col gap-3 border-b border-gray-100 pb-4 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="font-bold text-gray-900">
                        Informasi Lengkap Transaksi
                    </h3>

                    <span class="inline-flex w-fit items-center rounded-full border px-3 py-1 text-xs font-semibold
                        {{ $pemasukan
    ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
    : 'border-rose-200 bg-rose-50 text-rose-700' }}">
                        {{ $pemasukan ? 'Pemasukan' : 'Pengeluaran' }}
                    </span>
                </div>

                {{-- Nominal --}}
                <div>
                    <span class="text-xs font-semibold uppercase text-gray-400">
                        Nominal Transaksi
                    </span>

                    <h2 class="mt-1 text-2xl font-bold {{ $pemasukan ? 'text-emerald-700' : 'text-rose-700' }}">
                        {{ $pemasukan ? '+' : '-' }} Rp{{ number_format((float) $laporan->amount, 0, ',', '.') }}
                    </h2>
                </div>

                {{-- Tanggal dan ID --}}
                <div class="grid grid-cols-1 gap-4 rounded-xl border border-gray-200/80 bg-gray-50 p-4 sm:grid-cols-2">
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Tanggal Transaksi
                        </span>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $tanggalTransaksi }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            ID Transaksi
                        </span>

                        <p class="mt-1 break-all text-sm font-semibold text-gray-800">
                            TRX-{{ $laporan->id }}
                        </p>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <span class="text-xs font-semibold uppercase text-gray-400">
                        Keterangan Transaksi
                    </span>

                    <div
                        class="mt-2 rounded-xl border border-gray-200 bg-white p-4 text-sm leading-relaxed text-gray-700">
                        @if ($laporan->description)
                            {!! nl2br(e($laporan->description)) !!}
                        @else
                            <span class="italic text-gray-400">
                                Belum ada keterangan transaksi.
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Informasi Sistem --}}
                <div class="grid grid-cols-1 gap-4 border-t border-gray-100 pt-4 sm:grid-cols-2">
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Dibuat Pada
                        </span>

                        <p class="mt-1 text-sm text-gray-700">
                            {{ $laporan->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Terakhir Diperbarui
                        </span>

                        <p class="mt-1 text-sm text-gray-700">
                            {{ $laporan->updated_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Bukti dan Aksi --}}
        <div class="space-y-6">

            {{-- Bukti Transaksi --}}
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Bukti Transaksi
                </h3>

                <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                    @if ($urlBukti)
                        @if ($isImage)
                            <a href="{{ $urlBukti }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $urlBukti }}" alt="Bukti transaksi {{ $laporan->id }}"
                                    class="h-auto max-h-105 w-full object-contain"
                                    onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                            </a>

                            <div class="hidden p-6 text-center">
                                <p class="text-sm text-red-600">
                                    Gambar tidak dapat ditampilkan. Periksa lokasi file bukti transaksi.
                                </p>
                            </div>
                        @elseif ($isPdf)
                            <div class="flex min-h-48 flex-col items-center justify-center p-6 text-center">
                                <svg class="mb-3 h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>

                                <p class="break-all text-sm font-semibold text-gray-800">
                                    {{ $namaFile }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Dokumen PDF
                                </p>
                            </div>
                        @else
                            <div class="p-6 text-center">
                                <p class="break-all text-sm font-semibold text-gray-800">
                                    {{ $namaFile }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    Format file: {{ strtoupper($ekstensi ?? 'Tidak diketahui') }}
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="flex min-h-48 flex-col items-center justify-center p-8 text-center">
                            <svg class="mb-3 h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />
                            </svg>

                            <p class="text-xs text-gray-400">
                                Tidak ada bukti transaksi yang diunggah.
                            </p>
                        </div>
                    @endif
                </div>

                @if ($urlBukti)
                    <div class="flex flex-col gap-2">
                        <a href="{{ $urlBukti }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Lihat Bukti
                        </a>

                        <a href="{{ $urlBukti }}" download
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                            Unduh Bukti
                        </a>
                    </div>
                @endif

                {{-- Tombol Aksi --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 pt-4">

                    <a href="{{ route('admin.laporan-keuangan.edit', $laporan->id) }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Edit Transaksi
                    </a>

                    <form action="{{ route('admin.laporan-keuangan.destroy', $laporan->id) }}" method="POST"
                        data-confirm="Transaksi ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan."
                        data-confirm-title="Hapus transaksi?">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            Hapus Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
