<x-layouts.admin>
    <x-slot name="title">Edit Berita / Pengumuman</x-slot>
    <x-slot name="backUrl">{{ route('admin.berita.index') }}</x-slot>

    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 lg:col-span-3">
                <p class="font-bold">Berita belum dapat diperbarui:</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 lg:col-span-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- Kolom utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Edit Konten Berita
                </h3>

                <div>
                    <label for="title" class="mb-2 block text-sm font-semibold text-gray-700">
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $berita->title) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="mb-2 block text-sm font-semibold text-gray-700">
                        Ringkasan Berita
                    </label>
                    <textarea id="excerpt" name="excerpt" rows="3" maxlength="1000"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('excerpt', $berita->excerpt) }}</textarea>

                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="mb-2 block text-sm font-semibold text-gray-700">
                        Isi Berita <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="12" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('content', $berita->content) }}</textarea>

                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom pengaturan publikasi --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Pengaturan Publikasi
                </h3>

                <div>
                    <label for="status" class="mb-2 block text-sm font-semibold text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    @php
                        $statusSaatIni = old(
                            'status',
                            $berita->status instanceof \App\Enums\PublicationStatus
                            ? $berita->status->value
                            : $berita->status
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

                <div>
                    <label for="author" class="mb-2 block text-sm font-semibold text-gray-700">
                        Penulis <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="author" name="author" value="{{ old('author', $berita->author) }}" required
                        maxlength="255"
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
                        value="{{ old('published_at', $berita->published_at?->format('Y-m-d')) }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail saat ini --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Thumbnail Saat Ini
                    </label>

                    @if ($berita->thumbnail)
                        <div class="mb-3 h-40 w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100">
                            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Thumbnail {{ $berita->title }}"
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

                <div class="flex flex-col gap-3 border-t border-gray-100 pt-4">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Perbarui Berita
                    </button>

                    <a href="{{ route('admin.berita.index') }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
