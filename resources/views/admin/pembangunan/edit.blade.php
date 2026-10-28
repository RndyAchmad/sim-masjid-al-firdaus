<x-layouts.admin>
    <x-slot name="title">Edit Transaksi Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.transactions.show', $transaction) }}</x-slot>

    @php
        $selectedType = old('type', $transaction->type->value);
        $selectedProject = old('development_project_id', $transaction->development_project_id);
    @endphp

    <div class="mx-auto max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Edit Transaksi Pembangunan</h1>
            <p class="mt-1 text-sm text-gray-500">Perbarui data transaksi. Saldo dan ringkasan proyek akan dihitung ulang dari data terbaru.</p>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                Periksa kembali kolom yang ditandai sebelum menyimpan perubahan.
            </div>
        @endif

        <form
            action="{{ route('admin.pembangunan.transactions.update', $transaction) }}"
            method="POST"
            enctype="multipart/form-data"
            x-data="{ jenis: '{{ $selectedType }}' }"
            class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3"
        >
            @csrf
            @method('PUT')

            <section class="space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm lg:col-span-2 sm:p-6">
                <div class="border-b border-gray-100 pb-4">
                    <h2 class="font-bold text-gray-900">Informasi Transaksi</h2>
                    <p class="mt-1 text-sm text-gray-500">Kolom bertanda <span class="text-red-500">*</span> wajib diisi.</p>
                </div>

                <div>
                    <p class="mb-2 text-sm font-semibold text-gray-700">Jenis transaksi <span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <label class="cursor-pointer rounded-xl border p-4 transition" :class="jenis === 'income' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" name="type" value="income" x-model="jenis" class="sr-only">
                            <span class="block font-semibold text-emerald-800">Pemasukan</span>
                            <span class="mt-1 block text-xs text-gray-600">Infak, donasi, atau dana yang diterima.</span>
                        </label>
                        <label class="cursor-pointer rounded-xl border p-4 transition" :class="jenis === 'expense' ? 'border-rose-500 bg-rose-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" name="type" value="expense" x-model="jenis" class="sr-only">
                            <span class="block font-semibold text-rose-800">Pengeluaran</span>
                            <span class="mt-1 block text-xs text-gray-600">Material, upah tukang, atau kebutuhan renovasi.</span>
                        </label>
                    </div>
                    @error('type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="development_project_id" class="mb-2 block text-sm font-semibold text-gray-700">Kategori dana</label>
                        <select id="development_project_id" name="development_project_id" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                            <option value="">Kas Pembangunan Umum</option>
                            @foreach ($proyekPembangunan as $proyek)
                                <option value="{{ $proyek->id }}" @selected((string) $selectedProject === (string) $proyek->id)>{{ $proyek->name }}</option>
                            @endforeach
                        </select>
                        @error('development_project_id') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="transaction_date" class="mb-2 block text-sm font-semibold text-gray-700">Tanggal transaksi <span class="text-red-500">*</span></label>
                        <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        @error('transaction_date') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="donor_or_source" class="mb-2 block text-sm font-semibold text-gray-700">Sumber / pihak terkait <span class="text-red-500">*</span></label>
                        <input type="text" id="donor_or_source" name="donor_or_source" value="{{ old('donor_or_source', $transaction->donor_or_source) }}" maxlength="255" required class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        @error('donor_or_source') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="amount" class="mb-2 block text-sm font-semibold text-gray-700">Nominal (Rupiah) <span class="text-red-500">*</span></label>
                        <input type="number" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}" min="1" max="999999999999.99" step="0.01" required class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        @error('amount') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="purpose" class="mb-2 block text-sm font-semibold text-gray-700">Rincian / peruntukan <span class="text-red-500">*</span></label>
                    <textarea id="purpose" name="purpose" rows="5" maxlength="1000" required class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm leading-6 text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('purpose', $transaction->purpose) }}</textarea>
                    @error('purpose') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </section>

            <aside class="space-y-6">
                <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                    <h2 class="border-b border-gray-100 pb-3 font-bold text-gray-900">Bukti Transaksi</h2>

                    @if ($transaction->proof_file)
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($transaction->proof_file) }}" target="_blank" rel="noopener noreferrer" class="mt-4 block text-sm font-semibold text-[#a8833e] hover:text-[#8b6a2f]">Lihat bukti saat ini</a>
                    @else
                        <p class="mt-4 text-sm text-gray-500">Belum ada bukti transaksi.</p>
                    @endif

                    <label for="proof_file" class="mt-4 block text-sm font-semibold text-gray-700">Ganti / tambah bukti</label>
                    <input type="file" id="proof_file" name="proof_file" accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf" class="mt-2 block w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
                    <p class="mt-2 text-xs leading-5 text-gray-500">JPG, JPEG, PNG, atau PDF; maksimal 2 MB.</p>
                    @error('proof_file') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                </section>

                <div class="space-y-3">
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-[#c49c4d] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#a8833e]">Simpan Perubahan</button>
                    <a href="{{ route('admin.pembangunan.transactions.show', $transaction) }}" class="inline-flex w-full items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">Batal</a>
                </div>
            </aside>
        </form>
    </div>
</x-layouts.admin>
