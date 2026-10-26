<x-layouts.admin>
    <x-slot name="title">Detail Inventaris</x-slot>
    <x-slot name="backUrl">{{ route('admin.inventaris.index') }}</x-slot>

    @php
        $conditionEnum = $inventory->condition instanceof \App\Enums\InventoryCondition
            ? $inventory->condition
            : \App\Enums\InventoryCondition::tryFrom((string) $inventory->condition);

        $conditionLabel = $conditionEnum?->label() ?? 'Tidak diketahui';

        $conditionStyle = match ($conditionEnum) {
            \App\Enums\InventoryCondition::GOOD => [
                'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                'dot' => 'bg-emerald-500',
                'icon' => 'text-emerald-600',
            ],
            \App\Enums\InventoryCondition::DAMAGED => [
                'badge' => 'bg-amber-50 text-amber-700 ring-amber-200',
                'dot' => 'bg-amber-500',
                'icon' => 'text-amber-600',
            ],
            \App\Enums\InventoryCondition::MISSING => [
                'badge' => 'bg-red-50 text-red-700 ring-red-200',
                'dot' => 'bg-red-500',
                'icon' => 'text-red-600',
            ],
            \App\Enums\InventoryCondition::REPAIR => [
                'badge' => 'bg-blue-50 text-blue-700 ring-blue-200',
                'dot' => 'bg-blue-500',
                'icon' => 'text-blue-600',
            ],
            default => [
                'badge' => 'bg-gray-100 text-gray-600 ring-gray-200',
                'dot' => 'bg-gray-400',
                'icon' => 'text-gray-500',
            ],
        };

        $tanggalMasuk = $inventory->created_at
            ? $inventory->created_at->locale('id')->translatedFormat('d F Y')
            : '—';

        $tanggalUpdate = $inventory->updated_at
            ? $inventory->updated_at->locale('id')->translatedFormat('d F Y, H:i')
            : '—';
    @endphp

    <div class="mx-auto w-full max-w-6xl space-y-5 sm:space-y-6">

        {{-- Header halaman --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <a href="{{ route('admin.inventaris.index') }}" class="transition hover:text-[#a8833e]">
                        Inventaris
                    </a>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-700">Detail Barang</span>
                </div>

                <h1 class="mt-2 wrap-break-word text-xl font-bold tracking-tight text-gray-900 sm:text-2xl">
                    Detail Inventaris
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Informasi lengkap barang inventaris masjid.
                </p>
            </div>

            {{-- Tombol aksi desktop --}}
            <div class="hidden shrink-0 gap-2 sm:flex">
                <a href="{{ route('admin.inventaris.edit', $inventory->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Edit Data
                </a>
            </div>
        </div>

        {{-- Konten utama --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

            {{-- Bagian identitas barang --}}
            <div class="border-b border-gray-100 p-5 sm:p-7 lg:p-8">
                <div class="flex flex-col gap-6 md:flex-row md:items-start">

                    {{-- Foto barang --}}
                    <div class="w-full shrink-0 md:w-64 lg:w-72">
                        @if ($inventory->image)
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($inventory->image) }}" target="_blank"
                                rel="noopener noreferrer"
                                class="group relative block overflow-hidden rounded-2xl border border-gray-200 bg-gray-50">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($inventory->image) }}"
                                    alt="Foto {{ $inventory->name }}"
                                    class="aspect-4/3 w-full object-contain transition duration-300 group-hover:scale-[1.02]"
                                    loading="lazy">
                                <span
                                    class="absolute inset-x-0 bottom-0 bg-gray-900/60 px-3 py-2 text-center text-xs font-medium text-white opacity-100 transition sm:opacity-0 sm:group-hover:opacity-100">
                                    Lihat foto ukuran penuh
                                </span>
                            </a>
                        @else
                            <div
                                class="flex aspect-4/3 w-full flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50 text-gray-400">
                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 16l5-5a2 2 0 012.828 0L15 15m-2-2l1.172-1.172a2 2 0 012.828 0L21 16M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2zm4-11h.01" />
                                </svg>
                                <p class="mt-2 text-sm font-medium">Belum ada foto</p>
                                <p class="mt-1 text-xs">Foto barang belum diunggah</p>
                            </div>
                        @endif
                    </div>

                    {{-- Identitas --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <span
                                class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold ring-1 ring-inset {{ $conditionStyle['badge'] }}">
                                <span class="h-2 w-2 rounded-full {{ $conditionStyle['dot'] }}"></span>
                                {{ $conditionLabel }}
                            </span>

                            <span class="rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-600">
                                Barang Inventaris
                            </span>
                        </div>

                        <h2 class="mt-4 wrap-break-word text-2xl font-bold leading-tight text-gray-900 sm:text-3xl">
                            {{ $inventory->name }}
                        </h2>

                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span class="text-sm text-gray-500">Kode barang</span>
                            <span
                                class="inline-flex max-w-full break-all rounded-lg border border-gray-200 bg-gray-50 px-3 py-1.5 font-mono text-sm font-semibold text-gray-700">
                                {{ $inventory->code ?: 'Belum tersedia' }}
                            </span>
                        </div>

                        <p class="mt-4 max-w-2xl text-sm leading-6 text-gray-500">
                            Informasi identitas dan kondisi terkini barang inventaris yang tercatat dalam sistem.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Ringkasan informasi --}}
            <div class="grid grid-cols-1 divide-y divide-gray-100 sm:grid-cols-3 sm:divide-x sm:divide-y-0">

                <div class="flex items-start gap-4 p-5 sm:p-6">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-[#a8833e]">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm text-gray-500">Jumlah Barang</p>
                        <p class="mt-1 wrap-break-word text-xl font-bold text-gray-900">
                            {{ number_format($inventory->quantity, 0, ',', '.') }}
                            <span class="text-sm font-medium text-gray-500">{{ $inventory->unit }}</span>
                        </p>
                        <p class="mt-1 text-xs text-gray-400">Jumlah tercatat</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 sm:p-6">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14H4V6a1 1 0 011-1z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm text-gray-500">Tanggal Ditambahkan</p>
                        <p class="mt-1 wrap-break-word text-base font-bold text-gray-900">
                            {{ $tanggalMasuk }}
                        </p>
                        <p class="mt-1 text-xs text-gray-400">Pertama dicatat</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 sm:p-6">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                        <p class="mt-1 wrap-break-word text-base font-bold text-gray-900">
                            {{ $tanggalUpdate }}
                        </p>
                        <p class="mt-1 text-xs text-gray-400">Tanggal dan waktu</p>
                    </div>
                </div>
            </div>

            {{-- Keterangan --}}
            <div class="border-t border-gray-100 p-5 sm:p-7 lg:p-8">
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <h3 class="font-bold text-gray-900">Keterangan / Spesifikasi</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Catatan tambahan dan informasi penempatan barang.
                        </p>

                        <div
                            class="mt-4 rounded-xl border border-gray-100 bg-gray-50/70 p-4 text-sm leading-7 text-gray-700 sm:p-5">
                            @if (filled($inventory->description))
                                <p class="whitespace-pre-line wrap-break-word">{{ $inventory->description }}</p>
                            @else
                                <p class="italic text-gray-400">Belum ada keterangan untuk barang ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer aksi --}}
            <div
                class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/70 p-5 sm:flex-row sm:items-center sm:justify-between sm:px-7 sm:py-5 lg:px-8">

                <a href="{{ route('admin.inventaris.index') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 sm:w-auto">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>

                <div class="grid grid-cols-1 gap-2 sm:flex sm:items-center">

                    {{-- Hapus --}}
                    <form action="{{ route('admin.inventaris.destroy', $inventory->id) }}" method="POST"
                        data-confirm="true" data-confirm-title="Hapus barang inventaris?"
                        data-confirm-text="Barang {{ $inventory->name }} akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan."
                        class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-200 sm:w-auto">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                            </svg>
                            Hapus Data
                        </button>
                    </form>

                    {{-- Edit --}}
                    <a href="{{ route('admin.inventaris.edit', $inventory->id) }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2 sm:w-auto">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
