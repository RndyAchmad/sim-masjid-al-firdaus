<x-layouts.admin>
    <x-slot name="title">Tambah Artikel Keislaman</x-slot>
    <x-slot name="backUrl">{{ route('admin.articles.index') }}</x-slot>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-3xl space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
        @csrf

        <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
            Data Artikel Keislaman
        </h3>

        {{-- Judul Artikel --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-semibold text-gray-700">
                Judul Artikel <span class="text-red-500">*</span>
            </label>

            <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                placeholder="Contoh: Keutamaan Menjaga Salat Berjamaah"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label for="category" class="mb-2 block text-sm font-semibold text-gray-700">
                Kategori Artikel <span class="text-red-500">*</span>
            </label>

            <input type="text" id="category" name="category" value="{{ old('category') }}" required maxlength="255"
                placeholder="Contoh: Fikih, Akhlak, Aqidah"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            @error('category')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ringkasan --}}
        <div>
            <label for="excerpt" class="mb-2 block text-sm font-semibold text-gray-700">
                Ringkasan Artikel
            </label>

            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Tuliskan ringkasan singkat artikel..."
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('excerpt') }}</textarea>

            @error('excerpt')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Isi Artikel --}}
        <div>
            <label for="content" class="mb-2 block text-sm font-semibold text-gray-700">
                Isi Artikel <span class="text-red-500">*</span>
            </label>

            <textarea id="content" name="content" rows="10" required
                placeholder="Tuliskan isi artikel keislaman secara lengkap..."
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('content') }}</textarea>

            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Penulis --}}
        <div>
            <label for="author" class="mb-2 block text-sm font-semibold text-gray-700">
                Penulis / Redaksi <span class="text-red-500">*</span>
            </label>

            <input type="text" id="author" name="author" value="{{ old('author', 'Pengurus Masjid') }}" required
                maxlength="255" placeholder="Nama penulis atau redaksi"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            @error('author')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="mb-2 block text-sm font-semibold text-gray-700">
                Status Artikel <span class="text-red-500">*</span>
            </label>

            <select id="status" name="status" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                <option value="draft" @selected(old('status', 'draft') === 'draft')>
                    Draft — Belum ditampilkan
                </option>
                <option value="published" @selected(old('status') === 'published')>
                    Diterbitkan — Ditampilkan kepada pengunjung
                </option>
                <option value="archived" @selected(old('status') === 'archived')>
                    Arsip — Tidak ditampilkan sebagai artikel aktif
                </option>
            </select>

            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Thumbnail --}}
        <div>
            <label for="thumbnail" class="mb-2 block text-sm font-semibold text-gray-700">
                Gambar Thumbnail
            </label>

            <input type="file" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png,.webp"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-800 file:mr-4 file:rounded-lg file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-gray-700 hover:file:bg-gray-200 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            <p class="mt-1 text-xs text-gray-500">
                Format JPG, JPEG, PNG, atau WEBP. Maksimal ukuran 2 MB.
            </p>

            @error('thumbnail')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
            <a href="{{ route('admin.articles.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#c49c4d] px-6 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                Simpan Artikel
            </button>
        </div>
    </form>
</x-layouts.admin>
