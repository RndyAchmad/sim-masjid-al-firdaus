@php
    $selectedStatus = old('status', $project?->status?->value ?? \App\Enums\DevelopmentProjectStatus::ONGOING->value);
@endphp

@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
        Periksa kembali kolom yang ditandai sebelum menyimpan proyek.
    </div>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <section class="space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm lg:col-span-2 sm:p-6">
        <div class="border-b border-gray-100 pb-4">
            <h2 class="font-bold text-gray-900">Informasi Proyek</h2>
            <p class="mt-1 text-sm text-gray-500">Buat proyek hanya untuk pekerjaan pembangunan atau renovasi yang perlu dikelola secara khusus.</p>
        </div>

        <div>
            <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">Nama proyek <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $project?->name) }}" maxlength="255" required placeholder="Contoh: Renovasi Tempat Wudu" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            @error('name') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label for="target_amount" class="mb-2 block text-sm font-semibold text-gray-700">Target anggaran</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-500">Rp</span>
                    <input type="number" id="target_amount" name="target_amount" value="{{ old('target_amount', $project?->target_amount) }}" min="1" max="999999999999.99" step="0.01" placeholder="Opsional" class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>
                <p class="mt-1.5 text-xs text-gray-500">Bukan saldo atau dana yang sudah diterima.</p>
                @error('target_amount') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-semibold text-gray-700">Status proyek <span class="text-red-500">*</span></label>
                <select id="status" name="status" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @foreach ($statusProyek as $status)
                        <option value="{{ $status->value }}" @selected($selectedStatus === $status->value)>{{ $status->label() }}</option>
                    @endforeach
                </select>
                @error('status') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label for="start_date" class="mb-2 block text-sm font-semibold text-gray-700">Tanggal mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $project?->start_date?->format('Y-m-d')) }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                @error('start_date') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="end_date" class="mb-2 block text-sm font-semibold text-gray-700">Target selesai</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $project?->end_date?->format('Y-m-d')) }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                @error('end_date') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">Deskripsi proyek</label>
            <textarea id="description" name="description" rows="6" maxlength="5000" placeholder="Jelaskan ruang lingkup pekerjaan pembangunan atau renovasi." class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm leading-6 text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('description', $project?->description) }}</textarea>
            @error('description') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </section>

    <aside class="space-y-6">
        <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="border-b border-gray-100 pb-3 font-bold text-gray-900">Gambar Proyek</h2>

            @if ($project?->image)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($project->image) }}" alt="Gambar {{ $project->name }}" class="mt-4 h-40 w-full rounded-xl border border-gray-200 object-cover">
            @endif

            <label for="image" class="mt-4 block text-sm font-semibold text-gray-700">{{ $project?->image ? 'Ganti gambar (opsional)' : 'Unggah gambar (opsional)' }}</label>
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="mt-2 block w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
            <p class="mt-2 text-xs leading-5 text-gray-500">JPG, JPEG, PNG, atau WEBP; maksimal 2 MB.</p>
            @error('image') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
        </section>

        <div class="space-y-3">
            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-[#c49c4d] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#a8833e]">{{ $submitLabel }}</button>
            <a href="{{ $cancelUrl }}" class="inline-flex w-full items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">Batal</a>
        </div>
    </aside>

    @isset ($unlinkedTransactions)
        @php
            $selectedTransactionIds = collect(old('transaction_ids', []))
                ->map(fn ($id) => (string) $id)
                ->all();
        @endphp

        <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm lg:col-span-3">
            <div class="border-b border-gray-100 p-5 sm:p-6">
                <h2 class="font-bold text-gray-900">Hubungkan Transaksi Kas Umum</h2>
                <p class="mt-1 max-w-3xl text-sm leading-6 text-gray-500">
                    Pilih transaksi yang memang berkaitan dengan proyek ini, misalnya pengeluaran yang sebelumnya dicatat sebagai kas umum.
                    Transaksi tidak diduplikasi; sistem hanya menghubungkannya ke proyek ini.
                </p>
            </div>

            @if ($unlinkedTransactions->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px] text-left text-sm">
                        <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <tr>
                                <th class="w-16 px-5 py-4 text-center">Pilih</th>
                                <th class="px-5 py-4">Tanggal</th>
                                <th class="px-5 py-4">Jenis</th>
                                <th class="px-5 py-4">Sumber / Pihak</th>
                                <th class="px-5 py-4">Rincian</th>
                                <th class="px-5 py-4 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($unlinkedTransactions as $transaction)
                                @php
                                    $isIncome = $transaction->type === \App\Enums\TransactionType::INCOME;
                                @endphp
                                <tr class="transition hover:bg-gray-50/80">
                                    <td class="px-5 py-4 text-center">
                                        <input
                                            type="checkbox"
                                            id="transaction_{{ $transaction->id }}"
                                            name="transaction_ids[]"
                                            value="{{ $transaction->id }}"
                                            @checked(in_array((string) $transaction->id, $selectedTransactionIds, true))
                                            class="h-4 w-4 rounded border-gray-300 text-[#c49c4d] focus:ring-[#c49c4d]"
                                        >
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-800">{{ $transaction->transaction_date->translatedFormat('d M Y') }}</td>
                                    <td class="px-5 py-4">
                                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $isIncome ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $transaction->type->label() }}</span>
                                    </td>
                                    <td class="px-5 py-4 font-medium text-gray-800">{{ $transaction->donor_or_source }}</td>
                                    <td class="max-w-md px-5 py-4 leading-5 text-gray-600">{{ $transaction->purpose }}</td>
                                    <td class="whitespace-nowrap px-5 py-4 text-right font-semibold {{ $isIncome ? 'text-emerald-700' : 'text-rose-700' }}">{{ $isIncome ? '+' : '-' }} Rp {{ number_format((float) $transaction->amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-5 py-10 text-center sm:px-6">
                    <p class="font-semibold text-gray-800">Tidak ada transaksi kas umum yang ditemukan.</p>
                    <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian atau catat transaksi baru terlebih dahulu.</p>
                </div>
            @endif

            @error('transaction_ids')
                <p class="border-t border-red-100 bg-red-50 px-5 py-3 text-sm text-red-700 sm:px-6">{{ $message }}</p>
            @enderror
            @error('transaction_ids.*')
                <p class="border-t border-red-100 bg-red-50 px-5 py-3 text-sm text-red-700 sm:px-6">{{ $message }}</p>
            @enderror
        </section>
    @endisset
</form>
