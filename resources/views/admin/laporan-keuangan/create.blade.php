<x-layouts.admin>
    <x-slot name="title">Catat Transaksi Baru</x-slot>
    <x-slot name="backUrl">{{ route('admin.laporan-keuangan.index') }}</x-slot>

    <form action="{{ route('admin.laporan-keuangan.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-4xl space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
        @csrf

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

            {{-- Tipe Transaksi --}}
            <div class="sm:col-span-2">
                <label class="mb-3 block text-sm font-semibold text-gray-700">
                    Tipe Transaksi <span class="text-red-500">*</span>
                </label>

                <div class="flex flex-wrap gap-4">
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-emerald-50 has-checked:border-emerald-500 has-checked:bg-emerald-50 has-checked:ring-1 has-checked:ring-emerald-500">
                        <input type="radio" name="type" value="income"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-600" {{ old('type', 'income') === 'income' ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-900">
                            Pemasukan (Infaq/Donasi)
                        </span>
                    </label>

                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-rose-50 has-checked:border-rose-500 has-checked:bg-rose-50 has-checked:ring-1 has-checked:ring-rose-500">
                        <input type="radio" name="type" value="expense"
                            class="h-4 w-4 text-rose-600 focus:ring-rose-600" {{ old('type') === 'expense' ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-900">
                            Pengeluaran (Operasional)
                        </span>
                    </label>
                </div>

                @error('type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Transaksi --}}
            <div>
                <label for="transaction_date" class="mb-2 block text-sm font-semibold text-gray-700">
                    Tanggal Transaksi <span class="text-red-500">*</span>
                </label>

                <input type="date" id="transaction_date" name="transaction_date"
                    value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                @error('transaction_date')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nominal --}}
            <div>
                <label for="amount" class="mb-2 block text-sm font-semibold text-gray-700">
                    Nominal (Rp) <span class="text-red-500">*</span>
                </label>

                <input type="number" id="amount" name="amount" min="1" step="0.01" value="{{ old('amount') }}"
                    placeholder="Contoh: 1500000"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                @error('amount')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="sm:col-span-2">
                <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">
                    Keterangan Lengkap <span class="text-red-500">*</span>
                </label>

                <textarea id="description" name="description" rows="3"
                    placeholder="Jelaskan detail transaksi (contoh: Pembayaran listrik masjid bulan Agustus)..."
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bukti Transaksi --}}
            <div class="sm:col-span-2">
                <label for="proof_file" class="mb-2 block text-sm font-semibold text-gray-700">
                    Lampiran / Bukti Nota (Opsional)
                </label>

                <input type="file" id="proof_file" name="proof_file" accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-[#c49c4d] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-[#a8833e]">

                <p class="mt-1 text-xs text-gray-500">
                    Format: JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                </p>

                @error('proof_file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col gap-3 border-t border-gray-100 pt-4 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.laporan-keuangan.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#c49c4d] px-8 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                Simpan Transaksi
            </button>
        </div>
    </form>
</x-layouts.admin>
