<x-layouts.admin>
    <x-slot name="title">Detail Artikel</x-slot>
    <x-slot name="backUrl">{{ route('admin.articles.index') }}</x-slot>

    @php
        $status = $article->status instanceof \BackedEnum
            ? $article->status->value
            : $article->status;

        $labelStatus = $article->status instanceof \App\Enums\PublicationStatus
            ? $article->status->label()
            : ucfirst((string) $status);

        $warnaStatus = match ($status) {
            'published' => 'bg-emerald-50 text-emerald-700',
            'draft' => 'bg-amber-50 text-amber-700',
            'archived' => 'bg-gray-100 text-gray-600',
            default => 'bg-gray-100 text-gray-600',
        };

        $warnaTitik = match ($status) {
            'published' => 'bg-emerald-500',
            'draft' => 'bg-amber-500',
            'archived' => 'bg-gray-400',
            default => 'bg-gray-400',
        };
    @endphp

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Kolom Utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">

                {{-- Status --}}
                <div class="flex flex-wrap items-center gap-3 border-b border-gray-100 pb-4">
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold {{ $warnaStatus }}">
                        <span class="h-1.5 w-1.5 rounded-full {{ $warnaTitik }}"></span>
                        {{ $labelStatus }}
                    </span>

                    <span
                        class="rounded-full border border-amber-100 bg-amber-50 px-3 py-1 text-xs font-medium text-amber-800">
                        {{ $article->category ?: 'Tanpa Kategori' }}
                    </span>
                </div>

                {{-- Judul --}}
                <h1 class="text-xl font-bold leading-relaxed text-gray-900 sm:text-2xl">
                    {{ $article->title }}
                </h1>

                {{-- Thumbnail --}}
                @if ($article->thumbnail)
                    <div class="w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail {{ $article->title }}"
                            class="max-h-112.5 w-full object-contain">
                    </div>
                @endif

                {{-- Ringkasan --}}
                @if ($article->excerpt)
                    <div class="rounded-xl border-l-4 border-[#c49c4d] bg-gray-50 p-4">
                        <p class="text-sm font-medium leading-relaxed text-gray-700">
                            {{ $article->excerpt }}
                        </p>
                    </div>
                @endif

                {{-- Isi Artikel --}}
                <div class="whitespace-pre-line wrap-break-word text-sm leading-7 text-gray-700">{{ $article->content }}
                </div>

            </div>
        </div>

        {{-- Kolom Samping --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">

                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Metadata & Opsi
                </h3>

                <div class="space-y-3 text-sm">

                    {{-- Penulis --}}
                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Penulis / Redaksi</span>
                        <span class="wrap-break-word font-semibold text-gray-800">
                            {{ $article->author ?: 'Pengurus Masjid' }}
                        </span>
                    </div>

                    {{-- Kategori --}}
                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Kategori</span>
                        <span class="font-semibold text-gray-800">
                            {{ $article->category ?: '-' }}
                        </span>
                    </div>

                    {{-- Dibuat --}}
                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Tanggal Dibuat</span>
                        <span class="font-semibold text-gray-800">
                            {{ $article->created_at?->locale('id')->translatedFormat('d F Y, H:i') ?? '-' }}
                        </span>
                    </div>

                    {{-- Diperbarui --}}
                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Terakhir Diperbarui</span>
                        <span class="font-semibold text-gray-800">
                            {{ $article->updated_at?->locale('id')->translatedFormat('d F Y, H:i') ?? '-' }}
                        </span>
                    </div>

                    {{-- Slug --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-400">Slug</span>
                        <span class="break-all font-mono text-xs text-gray-600">
                            {{ $article->slug }}
                        </span>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="space-y-2 border-t border-gray-100 pt-4">

                    {{-- Edit --}}
                    <a href="{{ route('admin.articles.edit', $article->id) }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Artikel
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                        data-confirm-title="Hapus artikel?"
                        data-confirm="Artikel '{{ $article->title }}' akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Artikel
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
