<x-layouts.admin>
    <x-slot name="title">Tambah Berita & Pengumuman</x-slot>
    <x-slot name="backUrl">{{ route('admin.berita.index') }}</x-slot>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-3xl space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
        @csrf

        <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
            Data Berita & Pengumuman
        </h3>

        {{-- Judul Berita --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-semibold text-gray-700">
                Judul Berita <span class="text-red-500">*</span>
            </label>

            <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                placeholder="Contoh: Kegiatan Santunan Anak Yatim"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ringkasan --}}
        <div>
            <label for="excerpt" class="mb-2 block text-sm font-semibold text-gray-700">
                Ringkasan Berita
            </label>

            <textarea id="excerpt" name="excerpt" rows="3"
                placeholder="Tuliskan ringkasan singkat berita untuk ditampilkan pada halaman utama..."
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('excerpt') }}</textarea>

            @error('excerpt')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Isi Berita --}}
        <div>
            <label for="content" class="mb-2 block text-sm font-semibold text-gray-700">
                Isi Berita <span class="text-red-500">*</span>
            </label>

            <textarea id="content" name="content" rows="8" required
                placeholder="Tuliskan isi berita atau pengumuman secara lengkap..."
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('content') }}</textarea>

            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Grid Penulis dan Tanggal --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="author" class="mb-2 block text-sm font-semibold text-gray-700">
                    Penulis <span class="text-red-500">*</span>
                </label>

                <input type="text" id="author" name="author" value="" required
                    maxlength="255" placeholder="Nama penulis"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="published_at" class="mb-2 block text-sm font-semibold text-gray-700">
                    Tanggal Publikasi
                </label>

                <input type="date" id="published_at" name="published_at"
                    value="{{ old('published_at', now()->format('Y-m-d')) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                @error('published_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Status Berita --}}
        <div>
            <label for="status" class="mb-2 block text-sm font-semibold text-gray-700">
                Status Berita <span class="text-red-500">*</span>
            </label>

            <select id="status" name="status" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                <option value="">-- Pilih Status --</option>
                <option value="draft" @selected(old('status', 'draft') === 'draft')>
                    Draft — Disimpan dan belum ditampilkan
                </option>
                <option value="published" @selected(old('status') === 'published')>
                    Diterbitkan — Ditampilkan kepada pengunjung
                </option>
                <option value="archived" @selected(old('status') === 'archived')>
                    Arsip — Tidak ditampilkan sebagai berita aktif
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
            <a href="{{ route('admin.berita.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                Batal
            </a>

            <button type="submit"
                class="rounded-xl bg-[#c49c4d] px-6 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                Simpan Berita
            </button>
        </div>
    </form>
</x-layouts.admin>
