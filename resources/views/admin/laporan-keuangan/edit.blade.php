<x-layouts.admin>
    <x-slot name="title">Edit Transaksi</x-slot>
    <x-slot name="backUrl">{{ route('admin.laporan-keuangan.index') }}</x-slot>

    @php
        $jenis = $laporan->type instanceof \BackedEnum
            ? $laporan->type->value
            : $laporan->type;

        $tanggal = $laporan->transaction_date
            ? \Illuminate\Support\Carbon::parse($laporan->transaction_date)->format('Y-m-d')
            : '';

        $urlBukti = $laporan->proof_file
            ? asset('storage/' . ltrim($laporan->proof_file, '/'))
            : null;

        $ekstensiBukti = $laporan->proof_file
            ? strtolower(pathinfo($laporan->proof_file, PATHINFO_EXTENSION))
            : null;

        $buktiGambar = in_array($ekstensiBukti, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
        $buktiPdf = $ekstensiBukti === 'pdf';
    @endphp

    <form action="{{ route('admin.laporan-keuangan.update', $laporan->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        @csrf
        @method('PUT')

        {{-- Kolom utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Informasi Transaksi
                </h3>

                {{-- Tipe transaksi --}}
                <div>
                    <label class="mb-3 block text-sm font-semibold text-gray-700">
                        Tipe Transaksi <span class="text-red-500">*</span>
                    </label>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <label
                            class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-emerald-50 has-checked:border-emerald-500 has-checked:bg-emerald-50 has-checked:ring-1 has-checked:ring-emerald-500">
                            <input
                                type="radio"
                                name="type"
                                value="income"
                                required
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-600"
                                @checked(old('type', $jenis) === 'income')>

                            <span class="text-sm font-medium text-gray-900">
                                Pemasukan (Infaq/Donasi)
                            </span>
                        </label>

                        <label
                            class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-rose-50 has-checked:border-rose-500 has-checked:bg-rose-50 has-checked:ring-1 has-checked:ring-rose-500">
                            <input
                                type="radio"
                                name="type"
                                value="expense"
                                required
                                class="h-4 w-4 text-rose-600 focus:ring-rose-600"
                                @checked(old('type', $jenis) === 'expense')>

                            <span class="text-sm font-medium text-gray-900">
                                Pengeluaran (Operasional)
                            </span>
                        </label>
                    </div>

                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal transaksi --}}
                <div>
                    <label for="transaction_date" class="mb-2 block text-sm font-semibold text-gray-700">
                        Tanggal Transaksi <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        id="transaction_date"
                        name="transaction_date"
                        value="{{ old('transaction_date', $tanggal) }}"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('transaction_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nominal --}}
                <div>
                    <label for="amount" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nominal (Rp) <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        min="1"
                        step="0.01"
                        value="{{ old('amount', $laporan->amount) }}"
                        placeholder="Contoh: 1500000"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">
                        Keterangan Lengkap <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        maxlength="5000"
                        placeholder="Jelaskan detail transaksi..."
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('description', $laporan->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom bukti dan aksi --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Bukti Transaksi & Aksi
                </h3>

                {{-- Bukti transaksi saat ini --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Bukti Transaksi Saat Ini
                    </label>

                    @if ($laporan->proof_file)
                        @if ($buktiGambar)
                            <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50 p-2">
                                <a href="{{ $urlBukti }}" target="_blank" rel="noopener noreferrer">
                                    <img
                                        src="{{ $urlBukti }}"
                                        alt="Bukti transaksi"
                                        class="max-h-80 w-full rounded-lg object-contain"
                                        loading="lazy">
                                </a>
                            </div>
                        @elseif ($buktiPdf)
                            <a
                                href="{{ $urlBukti }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex flex-col items-center justify-center rounded-xl border border-gray-200 bg-gray-50 p-6 text-center transition hover:bg-gray-100">
                                <svg class="mb-3 h-12 w-12 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 21h10a2 2 0 002-2V9l-6-6H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13 3v6h6" />
                                </svg>

                                <span class="text-sm font-semibold text-gray-800">Dokumen PDF</span>
                                <span class="mt-1 text-xs text-[#a8833e]">Klik untuk melihat bukti</span>
                            </a>
                        @else
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <p class="break-all text-sm text-gray-700">
                                    {{ basename($laporan->proof_file) }}
                                </p>
                                <a href="{{ $urlBukti }}" target="_blank" rel="noopener noreferrer"
                                    class="mt-2 inline-block text-sm font-semibold text-[#a8833e] hover:underline">
                                    Buka file bukti
                                </a>
                            </div>
                        @endif

                        <p class="mt-2 break-all text-xs text-gray-500">
                            {{ basename($laporan->proof_file) }}
                        </p>
                    @else
                        <div class="flex h-36 flex-col items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 text-gray-400">
                            <svg class="mb-2 h-8 w-8" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 16V4m0 0L7 9m5-5l5 5M5 20h14" />
                            </svg>
                            <p class="text-xs">Belum ada bukti transaksi</p>
                        </div>
                    @endif
                </div>

                {{-- Ganti bukti --}}
                <div>
                    <label for="proof_file" class="mb-2 block text-sm font-semibold text-gray-700">
                        Ganti Bukti Transaksi
                    </label>

                    <input
                        type="file"
                        id="proof_file"
                        name="proof_file"
                        accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">

                    <p class="mt-2 text-xs leading-relaxed text-gray-500">
                        Format JPG, JPEG, PNG, atau PDF. Maksimal 2 MB. Kosongkan jika tidak ingin mengganti bukti.
                    </p>

                    @error('proof_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol aksi --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 pt-4">
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                        Perbarui Transaksi
                    </button>

                    <a
                        href="{{ route('admin.laporan-keuangan.index') }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
