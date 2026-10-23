<x-layouts.admin>
    <x-slot name="title">Edit Artikel</x-slot>
    <x-slot name="backUrl">{{ route('admin.articles.index') }}</x-slot>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @method('PUT')

        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 lg:col-span-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- Kolom utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Edit Konten Artikel
                </h3>

                {{-- Judul --}}
                <div>
                    <label for="title" class="mb-2 block text-sm font-semibold text-gray-700">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>

                    <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ringkasan --}}
                <div>
                    <label for="excerpt" class="mb-2 block text-sm font-semibold text-gray-700">
                        Ringkasan Artikel
                    </label>

                    <textarea id="excerpt" name="excerpt" rows="3" maxlength="1000"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('excerpt', $article->excerpt) }}</textarea>

                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi artikel --}}
                <div>
                    <label for="content" class="mb-2 block text-sm font-semibold text-gray-700">
                        Isi Artikel <span class="text-red-500">*</span>
                    </label>

                    <textarea id="content" name="content" rows="12" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('content', $article->content) }}</textarea>

                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom pengaturan --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Pengaturan Artikel
                </h3>

                {{-- Kategori --}}
                <div>
                    <label for="category" class="mb-2 block text-sm font-semibold text-gray-700">
                        Kategori <span class="text-red-500">*</span>
                    </label>

                    <input type="text" id="category" name="category" value="{{ old('category', $article->category) }}"
                        required maxlength="255" placeholder="Contoh: Fiqih, Akhlak"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div>
                    <label for="author" class="mb-2 block text-sm font-semibold text-gray-700">
                        Penulis <span class="text-red-500">*</span>
                    </label>

                    <input type="text" id="author" name="author"
                        value="{{ old('author', $article->author ?: 'Pengurus Masjid') }}" required maxlength="255"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="mb-2 block text-sm font-semibold text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>

                    @php
                        $statusSaatIni = old(
                            'status',
                            $article->status instanceof \App\Enums\PublicationStatus
                            ? $article->status->value
                            : $article->status
                        );
                    @endphp

                    <select id="status" name="status" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="draft" @selected($statusSaatIni === 'draft')>
                            Draft
                        </option>
                        <option value="published" @selected($statusSaatIni === 'published')>
                            Diterbitkan
                        </option>
                        <option value="archived" @selected($statusSaatIni === 'archived')>
                            Arsip
                        </option>
                    </select>

                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail saat ini --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Thumbnail Saat Ini
                    </label>

                    @if ($article->thumbnail)
                        <div class="mb-3 h-40 w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail {{ $article->title }}"
                                class="h-full w-full object-cover">
                        </div>
                    @else
                        <div
                            class="mb-3 flex h-40 items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 text-sm text-gray-400">
                            Belum ada thumbnail
                        </div>
                    @endif

                    <label for="thumbnail" class="mb-2 block text-xs font-semibold text-gray-600">
                        Ganti Thumbnail (Opsional)
                    </label>

                    <input type="file" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png,.webp"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">

                    <p class="mt-1 text-xs text-gray-500">
                        JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </p>

                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 pt-4">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Perbarui Artikel
                    </button>

                    <a href="{{ route('admin.articles.index') }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
