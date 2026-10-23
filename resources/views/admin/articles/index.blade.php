<x-layouts.admin>
    <x-slot name="title">Kelola Artikel Keislaman</x-slot>

    <div class="space-y-6">

        {{-- Header Actions, Search & Filter Status --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form action="{{ route('admin.articles.index') }}" method="GET"
                class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">

                {{-- Input Pencarian --}}
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau kategori artikel..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Filter Status --}}
                <select name="status"
                    class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto">
                    <option value="">Semua Status</option>
                    <option value="published" @selected(request('status') === 'published')>
                        Diterbitkan
                    </option>
                    <option value="draft" @selected(request('status') === 'draft')>
                        Draft
                    </option>
                    <option value="archived" @selected(request('status') === 'archived')>
                        Arsip
                    </option>
                </select>

                {{-- Tombol Filter --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4h18M6 10h12m-9 6h6m-4 4h2" />
                    </svg>
                    Filter
                </button>

                {{-- Reset --}}
                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('admin.articles.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Tombol Tambah Artikel --}}
            <a href="{{ route('admin.articles.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e] sm:w-auto">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Artikel
            </a>
        </div>

        {{-- Tabel Data Artikel --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-225 text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Judul Artikel</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Penulis / Redaksi</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($articles as $item)
                            @php
                                $statusArtikel = $item->status instanceof \BackedEnum
                                    ? $item->status->value
                                    : $item->status;

                                $labelStatus = $item->status instanceof \App\Enums\PublicationStatus
                                    ? $item->status->label()
                                    : ucfirst((string) $statusArtikel);

                                $warnaStatus = match ($statusArtikel) {
                                    'published' => 'border-emerald-100 bg-emerald-50 text-emerald-700',
                                    'draft' => 'border-gray-200 bg-gray-100 text-gray-600',
                                    'archived' => 'border-amber-100 bg-amber-50 text-amber-800',
                                    default => 'border-gray-200 bg-gray-50 text-gray-600',
                                };

                                $warnaTitik = match ($statusArtikel) {
                                    'published' => 'bg-emerald-500',
                                    'draft' => 'bg-gray-400',
                                    'archived' => 'bg-amber-500',
                                    default => 'bg-gray-400',
                                };
                            @endphp

                            <tr class="transition hover:bg-gray-50/50">

                                {{-- Judul dan Thumbnail --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="max-w-sm min-w-0">
                                            <p class="font-semibold text-gray-900">
                                                {{ $item->title }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($item->category)
                                        <span
                                            class="inline-flex items-center rounded-full border border-amber-100 bg-amber-50 px-3 py-1 text-xs font-medium text-amber-800">
                                            {{ $item->category }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">Belum ditentukan</span>
                                    @endif
                                </td>

                                {{-- Penulis / Redaksi --}}
                                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-800">
                                    {{ $item->author ?: 'Pengurus Masjid' }}
                                </td>

                                {{-- Status --}}
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-semibold {{ $warnaStatus }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $warnaTitik }}"></span>
                                        {{ $labelStatus }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Detail --}}
                                        <a href="{{ route('admin.articles.show', $item->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="Detail artikel {{ $item->title }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.articles.edit', $item->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit artikel {{ $item->title }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.articles.destroy', $item->id) }}" method="POST"
                                            data-confirm-title="Hapus artikel?"
                                            data-confirm="Artikel '{{ $item->title }}' akan dihapus. Tindakan ini tidak dapat dibatalkan.">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="Hapus artikel {{ $item->title }}">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z" />
                                        </svg>
                                    </div>

                                    <p class="mt-4 font-semibold text-gray-900">
                                        Belum ada data artikel
                                    </p>

                                    <p class="mt-1 text-sm text-gray-500">
                                        @if (request()->filled('search') || request()->filled('status'))
                                            Tidak ada artikel yang sesuai dengan pencarian atau filter.
                                        @else
                                            Artikel keislaman yang ditambahkan akan muncul di sini.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div
                class="flex flex-col gap-3 border-t border-gray-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-gray-500">
                    Menampilkan
                    <span class="font-semibold text-gray-700">
                        {{ $articles->firstItem() ?? 0 }}–{{ $articles->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-semibold text-gray-700">
                        {{ $articles->total() }}
                    </span>
                    artikel
                </p>

                <div>
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>