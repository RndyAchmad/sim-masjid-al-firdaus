<x-layouts.admin>
    <x-slot name="title">Tambah Barang Inventaris</x-slot>
    <x-slot name="backUrl">{{ route('admin.inventaris.index') }}</x-slot>

    <form
        action="{{ route('admin.inventaris.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3"
    >
        @csrf

        {{-- Kolom Kiri: Form Utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Nama Barang --}}
                    <div class="sm:col-span-2">
                        <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            maxlength="255"
                            required
                            autofocus
                            placeholder="Misal: Mimbar Khutbah"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('name') border-red-500 @else @enderror"
                        >

                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kode Barang Otomatis --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Kode Barang
                        </label>

                        <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5">
                            <svg
                                class="mr-2 h-5 w-5 shrink-0 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            <span class="text-sm font-medium text-gray-600">
                                Dibuat otomatis saat disimpan
                            </span>
                        </div>

                        <p class="mt-1.5 text-xs text-gray-500">
                            Format: INV-YYMM-NNN
                        </p>
                    </div>

                    {{-- Jumlah dan Satuan --}}
                    <div>
                        <label for="quantity" class="mb-2 block text-sm font-semibold text-gray-700">
                            Jumlah / Kuantitas <span class="text-red-500">*</span>
                        </label>

                        <div class="flex items-start gap-2">
                            <div class="min-w-0 flex-1">
                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="{{ old('quantity', 0) }}"
                                    min="0"
                                    step="1"
                                    required
                                    placeholder="0"
                                    class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('quantity') border-red-500 @else @enderror"
                                >
                            </div>

                            <div class="w-1/3">
                                <input
                                    type="text"
                                    id="unit"
                                    name="unit"
                                    value="{{ old('unit', 'Unit') }}"
                                    maxlength="50"
                                    required
                                    placeholder="Satuan"
                                    aria-label="Satuan barang"
                                    class="w-full rounded-xl border px-3 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('unit') border-red-500 @else @enderror"
                                >
                            </div>
                        </div>

                        @error('quantity')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @error('unit')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <p class="mt-1.5 text-xs text-gray-500">
                            Contoh satuan: Unit, Buah, Pcs, Roll, atau Set.
                        </p>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">
                        Keterangan / Spesifikasi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        maxlength="5000"
                        placeholder="Tuliskan spesifikasi, lokasi penempatan, atau catatan tambahan..."
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('description') border-red-500 @else @enderror"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Kondisi dan Foto --}}
        <div class="space-y-6">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Informasi Barang
                </h3>

                {{-- Kondisi --}}
                <div>
                    <label for="condition" class="mb-2 block text-sm font-semibold text-gray-700">
                        Kondisi Barang <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="condition"
                        name="condition"
                        required
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('condition') border-red-500 @else @enderror"
                    >
                        @foreach (\App\Enums\InventoryCondition::cases() as $item)
                            <option
                                value="{{ $item->value }}"
                                @selected(old('condition', \App\Enums\InventoryCondition::GOOD->value) === $item->value)
                            >
                                {{ $item->label() }}
                            </option>
                        @endforeach
                    </select>

                    @error('condition')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto Barang --}}
                <div>
                    <label for="image" class="mb-2 block text-sm font-semibold text-gray-700">
                        Foto Barang <span class="font-normal text-gray-400">(Opsional)</span>
                    </label>

                    <label
                        for="image"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 p-5 text-center transition hover:border-[#c49c4d] hover:bg-amber-50/30"
                    >
                        <svg
                            class="mb-2 h-8 w-8 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                            />
                        </svg>

                        <span class="text-sm font-medium text-gray-700">
                            Klik untuk memilih foto
                        </span>

                        <span class="mt-1 text-xs text-gray-500">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </span>
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="sr-only"
                    >

                    <p id="imageFileName" class="mt-2 break-all text-xs text-gray-500">
                        Belum ada foto dipilih.
                    </p>

                    @error('image')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 pt-4">
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2"
                    >
                        Simpan Barang
                    </button>

                    <a
                        href="{{ route('admin.inventaris.index') }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                    >
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('image');
            const imageFileName = document.getElementById('imageFileName');

            if (!imageInput || !imageFileName) return;

            imageInput.addEventListener('change', function () {
                imageFileName.textContent = this.files.length
                    ? this.files[0].name
                    : 'Belum ada foto dipilih.';
            });
        });
    </script>
</x-layouts.admin>
