<x-layouts.admin>
    <x-slot name="title">Detail Berita / Pengumuman</x-slot>
    <x-slot name="backUrl">{{ route('admin.berita.index') }}</x-slot>

    @php
        $status = $berita->status instanceof \App\Enums\PublicationStatus
            ? $berita->status->value
            : $berita->status;

        $labelStatus = $berita->status instanceof \App\Enums\PublicationStatus
            ? $berita->status->label()
            : ucfirst((string) $berita->status);
    @endphp

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Kolom utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">

                {{-- Status dan tanggal --}}
                <div class="flex flex-wrap items-center gap-3 border-b border-gray-100 pb-4">
                    @if ($status === 'published')
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            {{ $labelStatus }}
                        </span>
                    @elseif ($status === 'draft')
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                            {{ $labelStatus }}
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                            {{ $labelStatus }}
                        </span>
                    @endif

                    <span class="text-xs text-gray-400">
                        {{ $berita->published_at
    ? $berita->published_at->translatedFormat('d F Y')
    : 'Tanggal publikasi belum ditentukan' }}
                    </span>
                </div>

                {{-- Judul --}}
                <h1 class="text-xl font-bold leading-relaxed text-gray-900 sm:text-2xl">
                    {{ $berita->title }}
                </h1>

                {{-- Thumbnail --}}
                @if ($berita->thumbnail)
                    <div class="w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100">
                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Thumbnail {{ $berita->title }}"
                            class="max-h-112.5 w-full object-contain">
                    </div>
                @endif

                {{-- Ringkasan --}}
                @if ($berita->excerpt)
                    <div class="rounded-xl border-l-4 border-[#c49c4d] bg-gray-50 p-4">
                        <p class="text-sm font-medium leading-relaxed text-gray-700">
                            {{ $berita->excerpt }}
                        </p>
                    </div>
                @endif

                {{-- Isi berita --}}
                <div class="whitespace-pre-line wrap-break-word text-sm leading-7 text-gray-700">{{ $berita->content }}
                </div>

            </div>
        </div>

        {{-- Kolom samping --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Metadata & Opsi
                </h3>

                <div class="space-y-3 text-sm">
                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Penulis</span>
                        <span class="wrap-break-word font-semibold text-gray-800">
                            {{ $berita->author }}
                        </span>
                    </div>

                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Tanggal Publikasi</span>
                        <span class="font-semibold text-gray-800">
                            {{ $berita->published_at
    ? $berita->published_at->translatedFormat('d F Y')
    : '-' }}
                        </span>
                    </div>

                    <div class="flex flex-col gap-1 border-b border-gray-50 pb-3">
                        <span class="text-xs text-gray-400">Terakhir Diperbarui</span>
                        <span class="font-semibold text-gray-800">
                            {{ $berita->updated_at->translatedFormat('d F Y, H:i') }}
                        </span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-400">Slug</span>
                        <span class="break-all font-mono text-xs text-gray-600">
                            {{ $berita->slug }}
                        </span>
                    </div>
                </div>

                <div class="space-y-2 border-t border-gray-100 pt-4">
                    <a href="{{ route('admin.berita.edit', $berita->id) }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Berita
                    </a>

                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST"
                        data-confirm-title="Hapus berita?"
                        data-confirm="Berita ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Berita
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
