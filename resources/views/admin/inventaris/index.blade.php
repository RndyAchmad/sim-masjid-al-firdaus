<x-layouts.admin>
    <x-slot name="title">Kelola Inventaris Masjid</x-slot>

    <div class="space-y-6">

        {{-- Header Actions, Search & Filter --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <form action="{{ route('admin.inventaris.index') }}" method="GET"
                class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center"
                onkeydown="if (event.key === 'Enter' && event.target.tagName !== 'BUTTON') event.preventDefault()">

                {{-- Pencarian --}}
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau kode barang..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Filter Kondisi --}}
                <select
                    name="condition"
                    class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto">

                    <option value="">Semua Kondisi</option>

                    @foreach ($conditions as $item)
                        <option value="{{ $item->value }}" @selected($condition === $item->value)>
                            {{ $item->label() }}
                        </option>
                    @endforeach
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
                @if (request()->filled('search') || request()->filled('condition'))
                    <a href="{{ route('admin.inventaris.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                        Reset
                    </a>
                @endif

            </form>

            {{-- Tambah Barang --}}
            <a href="{{ route('admin.inventaris.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e] sm:w-auto">

                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Tambah Barang
            </a>

        </div>

        {{-- Tabel Data Inventaris --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-225 text-left text-sm text-gray-600">

                    {{-- Header Tabel --}}
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Informasi Barang</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Kondisi</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse ($inventories as $inventory)

                            @php
                                $conditionEnum = $inventory->condition instanceof \App\Enums\InventoryCondition
                                    ? $inventory->condition
                                    : \App\Enums\InventoryCondition::tryFrom((string) $inventory->condition);

                                $conditionLabel = $conditionEnum?->label() ?? 'Tidak diketahui';

                                $conditionStyle = match ($conditionEnum) {
                                    \App\Enums\InventoryCondition::GOOD => [
                                        'badge' => 'bg-emerald-50 text-emerald-700',
                                        'dot' => 'bg-emerald-500',
                                    ],
                                    \App\Enums\InventoryCondition::DAMAGED => [
                                        'badge' => 'bg-amber-50 text-amber-700',
                                        'dot' => 'bg-amber-500',
                                    ],
                                    \App\Enums\InventoryCondition::MISSING => [
                                        'badge' => 'bg-red-50 text-red-700',
                                        'dot' => 'bg-red-500',
                                    ],
                                    \App\Enums\InventoryCondition::REPAIR => [
                                        'badge' => 'bg-blue-50 text-blue-700',
                                        'dot' => 'bg-blue-500',
                                    ],
                                    default => [
                                        'badge' => 'bg-gray-100 text-gray-600',
                                        'dot' => 'bg-gray-400',
                                    ],
                                };
                            @endphp

                            <tr class="transition hover:bg-gray-50/50">

                                {{-- Informasi Barang --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        {{-- Foto Barang --}}
                                        <div
                                            class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-gray-100 bg-gray-50">

                                            @if ($inventory->image)
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($inventory->image) }}"
                                                    alt="Foto {{ $inventory->name }}" class="h-full w-full object-cover"
                                                    loading="lazy">
                                            @else
                                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            @endif

                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900">
                                                {{ $inventory->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-400">
                                                Kode:
                                                {{ $inventory->code ?: 'Belum ada kode' }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- Jumlah --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-semibold text-gray-900">
                                        {{ number_format($inventory->quantity, 0, ',', '.') }}
                                    </span>

                                    <span class="text-gray-500">
                                        {{ $inventory->unit ?: 'Unit' }}
                                    </span>
                                </td>

                                {{-- Kondisi --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold {{ $conditionStyle['badge'] }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $conditionStyle['dot'] }}"></span>
                                        {{ $conditionLabel }}
                                    </span>
                                </td>

                                {{-- Keterangan --}}
                                <td class="px-6 py-4">
                                    <p class="max-w-xs text-sm leading-5 text-gray-600">
                                        {{ $inventory->description ?: '-' }}
                                    </p>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Detail --}}
                                        <a href="{{ route('admin.inventaris.show', $inventory->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="Detail barang {{ $inventory->name }}">

                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.inventaris.edit', $inventory->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit barang {{ $inventory->name }}">

                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.inventaris.destroy', $inventory->id) }}" method="POST"
                                            data-confirm="Barang {{ $inventory->name }} akan dihapus. Tindakan ini tidak dapat dibatalkan."
                                            data-confirm-title="Hapus barang?">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="Hapus barang {{ $inventory->name }}">

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

                            {{-- Data Kosong --}}
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <svg class="mb-3 h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>

                                        <p class="font-medium text-gray-700">
                                            Belum ada data inventaris.
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            @if ($search || $condition)
                                                Coba ubah kata kunci pencarian atau filter kondisi.
                                            @else
                                                Silakan tambahkan data inventaris masjid terlebih dahulu.
                                            @endif
                                        </p>

                                    </div>

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
                        {{ $inventories->firstItem() ?? 0 }}–{{ $inventories->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-semibold text-gray-700">
                        {{ $inventories->total() }}
                    </span>
                    barang
                </p>

                <div>
                    {{ $inventories->links() }}
                </div>

            </div>

        </div>

    </div>
</x-layouts.admin>
