<x-layouts.admin>
    <x-slot name="title">Edit Inventaris</x-slot>
    <x-slot name="backUrl">{{ route('admin.inventaris.index') }}</x-slot>

    @if ($errors->has('general'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first('general') }}
        </div>
    @endif

    <form
        action="{{ route('admin.inventaris.update', $inventory->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3"
    >
        @csrf
        @method('PUT')

        {{-- Kolom Kiri --}}
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
                            value="{{ old('name', $inventory->name) }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('name') border-red-500 @else @enderror"
                        >

                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kode Otomatis --}}
                    <div>
                        <label for="code" class="mb-2 block text-sm font-semibold text-gray-700">
                            Kode Barang
                        </label>

                        <input
                            type="text"
                            id="code"
                            value="{{ $inventory->code }}"
                            readonly
                            class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-600"
                        >

                        <p class="mt-1.5 text-xs text-gray-500">
                            Kode dibuat otomatis dan tidak dapat diubah.
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
                                    value="{{ old('quantity', $inventory->quantity) }}"
                                    min="0"
                                    step="1"
                                    required
                                    class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('quantity') border-red-500 @else @enderror"
                                >
                            </div>

                            <div class="w-1/3">
                                <input
                                    type="text"
                                    id="unit"
                                    name="unit"
                                    value="{{ old('unit', $inventory->unit) }}"
                                    maxlength="50"
                                    required
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
                        rows="5"
                        maxlength="5000"
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('description') border-red-500 @else @enderror"
                        placeholder="Tuliskan spesifikasi, lokasi penempatan, atau catatan tambahan..."
                    >{{ old('description', $inventory->description) }}</textarea>

                    @error('description')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="space-y-6">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Informasi Barang
                </h3>

                {{-- Kondisi --}}
                <div>
                    <label for="condition" class="mb-2 block text-sm font-semibold text-gray-700">
                        Kondisi <span class="text-red-500">*</span>
                    </label>

                    @php
                        $currentCondition = old(
                            'condition',
                            $inventory->condition instanceof \App\Enums\InventoryCondition
                                ? $inventory->condition->value
                                : $inventory->condition
                        );
                    @endphp

                    <select
                        id="condition"
                        name="condition"
                        required
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] @error('condition') border-red-500 @else @enderror"
                    >
                        @foreach (\App\Enums\InventoryCondition::cases() as $item)
                            <option
                                value="{{ $item->value }}"
                                @selected($currentCondition === $item->value)
                            >
                                {{ $item->label() }}
                            </option>
                        @endforeach
                    </select>

                    @error('condition')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto Saat Ini --}}
                @if ($inventory->image)
                    <div>
                        <p class="mb-2 block text-sm font-semibold text-gray-700">
                            Foto Saat Ini
                        </p>

                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($inventory->image) }}"
                            alt="Foto {{ $inventory->name }}"
                            class="h-44 w-full rounded-xl border border-gray-200 object-cover"
                            loading="lazy"
                        >
                    </div>
                @endif

                {{-- Upload Foto Baru --}}
                <div>
                    <label for="image" class="mb-2 block text-sm font-semibold text-gray-700">
                        {{ $inventory->image ? 'Ganti Foto Barang' : 'Foto Barang' }}
                        <span class="font-normal text-gray-400">(Opsional)</span>
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="block w-full rounded-xl border border-gray-300 text-sm text-gray-700 file:mr-3 file:border-0 file:bg-gray-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-200"
                    >

                    <p class="mt-1.5 text-xs text-gray-500">
                        JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        Kosongkan jika tidak ingin mengganti foto.
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
                        Perbarui Data
                    </button>

                    <a
                        href="{{ route('admin.inventaris.index', $inventory->id) }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                    >
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
