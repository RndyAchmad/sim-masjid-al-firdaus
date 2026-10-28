<x-layouts.admin>
    <x-slot name="title">Catat Transaksi Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.index') }}</x-slot>

    <div class="mx-auto max-w-6xl space-y-6">

        {{-- HEADER --}}
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <span>Kas Pembangunan</span>
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.08 0Z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium text-gray-700">Catat Transaksi</span>
            </div>

            <h1 class="mt-2 text-2xl font-bold tracking-tight text-gray-900">
                Catat Transaksi Pembangunan
            </h1>

            <p class="mt-1 text-sm leading-6 text-gray-500">
                Catat pemasukan infak atau pengeluaran dana pembangunan dengan informasi yang jelas dan dapat dipertanggungjawabkan.
            </p>
        </div>

        {{-- PESAN ERROR UMUM --}}
        @if (session('error'))
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0Z"/>
                </svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                <p class="text-sm font-semibold text-red-800">
                    Ada beberapa data yang perlu diperbaiki.
                </p>
                <p class="mt-1 text-sm text-red-700">
                    Periksa kembali kolom yang ditandai sebelum menyimpan transaksi.
                </p>
            </div>
        @endif

        <form
            action="{{ route('admin.pembangunan.transactions.store') }}"
            method="POST"
            enctype="multipart/form-data"
            x-data="{
                jenis: '{{ old('type', 'income') }}',
                proyek: '{{ old('development_project_id', '') }}',
                preview: null,
                namaFile: '',
                formatRupiah(angka) {
                    if (!angka) return 'Rp 0';
                    return 'Rp ' + Number(angka).toLocaleString('id-ID');
                },
                pilihFile(event) {
                    const file = event.target.files[0];

                    if (this.preview) {
                        URL.revokeObjectURL(this.preview);
                    }

                    this.preview = null;
                    this.namaFile = '';

                    if (!file) return;

                    this.namaFile = file.name;

                    if (file.type.startsWith('image/')) {
                        this.preview = URL.createObjectURL(file);
                    }
                }
            }"
            class="space-y-6"
        >
            @csrf

            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">

                {{-- KOLOM UTAMA --}}
                <div class="space-y-6 lg:col-span-2">

                    {{-- JENIS TRANSAKSI --}}
                    <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                        <div class="mb-5 border-b border-gray-100 pb-4">
                            <h2 class="font-bold text-gray-900">
                                Informasi Transaksi
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Tentukan jenis transaksi dan dana yang berkaitan.
                            </p>
                        </div>

                        <div class="space-y-5">

                            {{-- Pilihan jenis --}}
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-gray-700">
                                    Jenis Transaksi <span class="text-red-500">*</span>
                                </label>

                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                                    <label
                                        class="flex cursor-pointer items-start gap-3 rounded-xl border p-4 transition"
                                        :class="jenis === 'income'
                                            ? 'border-emerald-500 bg-emerald-50 ring-1 ring-emerald-500'
                                            : 'border-gray-200 bg-white hover:border-gray-300'"
                                    >
                                        <input
                                            type="radio"
                                            name="type"
                                            value="income"
                                            x-model="jenis"
                                            class="mt-1 h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500"
                                            required
                                        >

                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                </span>
                                                <span class="text-sm font-bold text-gray-900">
                                                    Pemasukan
                                                </span>
                                            </div>

                                            <p class="mt-2 text-xs leading-5 text-gray-500">
                                                Infak, donasi, atau dana yang diterima.
                                            </p>
                                        </div>
                                    </label>

                                    <label
                                        class="flex cursor-pointer items-start gap-3 rounded-xl border p-4 transition"
                                        :class="jenis === 'expense'
                                            ? 'border-rose-500 bg-rose-50 ring-1 ring-rose-500'
                                            : 'border-gray-200 bg-white hover:border-gray-300'"
                                    >
                                        <input
                                            type="radio"
                                            name="type"
                                            value="expense"
                                            x-model="jenis"
                                            class="mt-1 h-4 w-4 border-gray-300 text-rose-600 focus:ring-rose-500"
                                            required
                                        >

                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 text-rose-700">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                    </svg>
                                                </span>
                                                <span class="text-sm font-bold text-gray-900">
                                                    Pengeluaran
                                                </span>
                                            </div>

                                            <p class="mt-2 text-xs leading-5 text-gray-500">
                                                Upah tukang, material, atau biaya renovasi.
                                            </p>
                                        </div>
                                    </label>

                                </div>

                                @error('type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kategori proyek --}}
                            <div>
                                <label for="development_project_id" class="mb-2 block text-sm font-semibold text-gray-700">
                                    Kategori Dana
                                </label>

                                <select
                                    id="development_project_id"
                                    name="development_project_id"
                                    x-model="proyek"
                                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                                >
                                    <option value="">Kas Pembangunan Umum</option>

                                    @foreach (($proyekPembangunan ?? collect()) as $itemProyek)
                                        <option value="{{ $itemProyek->id }}" @selected((string) old('development_project_id') === (string) $itemProyek->id)>
                                            {{ $itemProyek->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('development_project_id')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div class="mt-3 flex items-start gap-2 rounded-xl bg-amber-50 p-3">
                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#a8833e]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v3m0 4h.01M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0Z"/>
                                    </svg>

                                    <p class="text-xs leading-5 text-amber-900">
                                        <strong>Kas Pembangunan Umum</strong> dipilih jika dana belum ditujukan untuk proyek tertentu. Pilih proyek, misalnya pembangunan menara, jika transaksi memang khusus untuk proyek tersebut.
                                    </p>
                                </div>
                            </div>

                            {{-- Donatur / sumber --}}
                            <div>
                                <label for="donor_or_source" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <span x-text="jenis === 'income' ? 'Donatur / Sumber Dana' : 'Penerima / Sumber Pengeluaran'"></span>
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="donor_or_source"
                                    name="donor_or_source"
                                    value="{{ old('donor_or_source') }}"
                                    maxlength="255"
                                    required
                                    placeholder="Contoh: Hamba Allah, kotak infak, atau toko bangunan"
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                                >

                                @error('donor_or_source')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal dan nominal --}}
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                <div>
                                    <label for="transaction_date" class="mb-2 block text-sm font-semibold text-gray-700">
                                        Tanggal Transaksi <span class="text-red-500">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        id="transaction_date"
                                        name="transaction_date"
                                        value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                                        required
                                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                                    >

                                    @error('transaction_date')
                                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="amount" class="mb-2 block text-sm font-semibold text-gray-700">
                                        Nominal (Rupiah) <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-500">
                                            Rp
                                        </span>

                                        <input
                                            type="number"
                                            id="amount"
                                            name="amount"
                                            value="{{ old('amount') }}"
                                            min="1"
                                            max="999999999999.99"
                                            step="0.01"
                                            required
                                            placeholder="Contoh: 1250000"
                                            class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                                        >
                                    </div>

                                    @error('amount')
                                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <p class="mt-1.5 text-xs text-gray-400">
                                        Masukkan angka tanpa titik pemisah ribuan.
                                    </p>
                                </div>

                            </div>

                            {{-- Peruntukan / rincian --}}
                            <div>
                                <label for="purpose" class="mb-2 block text-sm font-semibold text-gray-700">
                                    <span x-text="jenis === 'income' ? 'Peruntukan Dana' : 'Rincian Penggunaan Dana'"></span>
                                    <span class="text-red-500">*</span>
                                </label>

                                <textarea
                                    id="purpose"
                                    name="purpose"
                                    rows="4"
                                    maxlength="1000"
                                    required
                                    placeholder="Contoh: Infak khusus pembangunan menara, atau pembayaran upah 3 tukang untuk minggu pertama."
                                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm leading-6 text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                                >{{ old('purpose') }}</textarea>

                                @error('purpose')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <p class="mt-1.5 text-xs leading-5 text-gray-400">
                                    Jelaskan tujuan pemasukan atau rincian pengeluaran agar pencatatan transparan dan mudah dipahami.
                                </p>
                            </div>

                        </div>
                    </section>

                </div>


                {{-- KOLOM KANAN --}}
                <div class="space-y-6">

                    {{-- BUKTI TRANSAKSI --}}
                    <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                        <div class="mb-5 border-b border-gray-100 pb-4">
                            <h2 class="font-bold text-gray-900">
                                Bukti Transaksi
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Lampirkan bukti jika tersedia.
                            </p>
                        </div>

                        <div>
                            <label for="proof_file" class="mb-2 block text-sm font-semibold text-gray-700">
                                <span x-text="jenis === 'income' ? 'Bukti Transfer / Kwitansi' : 'Nota / Bukti Pembayaran'"></span>
                            </label>

                            <label
                                for="proof_file"
                                class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-7 text-center transition hover:border-[#c49c4d] hover:bg-amber-50/40"
                            >
                                <svg class="h-9 w-9 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 16V4m0 0L7 9m5-5 5 5M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3"/>
                                </svg>

                                <span class="mt-3 text-sm font-semibold text-gray-700">
                                    Pilih file bukti
                                </span>

                                <span class="mt-1 text-xs leading-5 text-gray-500">
                                    JPG, JPEG, PNG, atau PDF
                                    <br>
                                    Maksimal 2 MB
                                </span>
                            </label>

                            <input
                                type="file"
                                id="proof_file"
                                name="proof_file"
                                accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                                class="sr-only"
                                @change="pilihFile($event)"
                            >

                            @error('proof_file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <div x-cloak x-show="namaFile" class="mt-3 rounded-xl border border-gray-200 p-3">
                                <template x-if="preview">
                                    <img
                                        :src="preview"
                                        alt="Pratinjau bukti transaksi"
                                        class="mb-3 max-h-48 w-full rounded-lg object-contain"
                                    >
                                </template>

                                <div class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6"/>
                                    </svg>

                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-gray-700">
                                            File dipilih
                                        </p>
                                        <p class="mt-1 break-all text-xs text-gray-500" x-text="namaFile"></p>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-3 text-xs leading-5 text-gray-500">
                                Bukti membantu bendahara melakukan pemeriksaan dan mendukung transparansi kas.
                            </p>
                        </div>
                    </section>


                    {{-- RINGKASAN SEBELUM SIMPAN --}}
                    <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                        <h2 class="font-bold text-gray-900">
                            Ringkasan Input
                        </h2>

                        <div class="mt-4 space-y-4">

                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm text-gray-500">Jenis</span>

                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold"
                                    :class="jenis === 'income'
                                        ? 'bg-emerald-50 text-emerald-700'
                                        : 'bg-rose-50 text-rose-700'"
                                    x-text="jenis === 'income' ? 'Pemasukan' : 'Pengeluaran'"
                                ></span>
                            </div>

                            <div class="flex items-start justify-between gap-3">
                                <span class="text-sm text-gray-500">Kategori</span>

                                <span class="max-w-40 text-right text-sm font-semibold text-gray-800"
                                    x-text="proyek === ''
                                        ? 'Kas Pembangunan Umum'
                                        : (document.getElementById('development_project_id')?.selectedOptions[0]?.text || 'Proyek terpilih')"
                                ></span>
                            </div>

                            <div class="border-t border-gray-100 pt-4">
                                <p class="text-sm text-gray-500">Nominal transaksi</p>

                                <p
                                    class="mt-1 break-words text-2xl font-bold"
                                    :class="jenis === 'income' ? 'text-emerald-700' : 'text-rose-700'"
                                    x-text="formatRupiah(document.getElementById('amount')?.value)"
                                ></p>
                            </div>

                        </div>

                        <div class="mt-5 rounded-xl bg-gray-50 p-3">
                            <p class="text-xs leading-5 text-gray-500">
                                Periksa kembali jenis transaksi, kategori dana, tanggal, dan nominal sebelum menyimpan.
                            </p>
                        </div>
                    </section>

                </div>

            </div>


            {{-- TOMBOL AKSI --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('admin.pembangunan.index') }}"
                    class="inline-flex min-h-11 items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6"/>
                    </svg>
                    Simpan Transaksi
                </button>
            </div>

        </form>
    </div>
</x-layouts.admin>
