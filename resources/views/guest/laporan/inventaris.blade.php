<x-layouts.guest>
    <div class="relative border-b border-gray-800 bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Aset & Fasilitas Masjid
            </span>

            <h1 class="mt-3 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl">
                Laporan Inventaris Masjid
            </h1>

            <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-gray-400 sm:text-base">
                Informasi sarana, prasarana, dan kondisi barang milik Masjid Al-Firdaus.
            </p>

            <div class="mx-auto mt-6 h-px w-20 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent"></div>
        </div>
    </div>

    <div class="min-h-screen bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-7xl space-y-10 px-4 sm:px-6 lg:px-8">

            {{-- Ringkasan Inventaris --}}
            <section>
                <div class="mx-auto mb-7 max-w-3xl text-center">
                    <span class="mb-3 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Pemeliharaan & Pengelolaan
                    </span>

                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Ringkasan Kondisi Barang
                    </h2>

                    <p class="mt-2 text-sm text-gray-600">
                        Rekapitulasi kondisi inventaris berdasarkan data yang tercatat.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                    {{-- Total Inventaris --}}
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Total Jenis Barang
                            </span>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#8c6b2d]/20 bg-[#8c6b2d]/10 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                        </div>

                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format($totalInventaris, 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">jenis</span>
                        </p>

                        <p class="mt-2 text-xs text-gray-500">Barang terdata di sistem</p>
                    </div>

                    {{-- Kondisi Baik --}}
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Kondisi Baik
                            </span>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format($totalBaik, 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">jenis</span>
                        </p>

                        <p class="mt-2 text-xs text-emerald-600">Dalam kondisi baik</p>
                    </div>

                    {{-- Perlu Perbaikan --}}
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Perlu Perbaikan
                            </span>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-blue-100 bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M14.7 6.3a4 4 0 00-5.6 5.6l-5.4 5.4a2 2 0 102.8 2.8l5.4-5.4a4 4 0 005.6-5.6l-2.5 2.5-2.8-2.8 2.5-2.5z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format($totalPerbaikan, 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">jenis</span>
                        </p>

                        <p class="mt-2 text-xs text-blue-600">Memerlukan pemeliharaan</p>
                    </div>

                    {{-- Rusak atau Hilang --}}
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Rusak / Hilang
                            </span>

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format($totalRusakHilang, 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">jenis</span>
                        </p>

                        <p class="mt-2 text-xs text-rose-600">Perlu penanganan lebih lanjut</p>
                    </div>
                </div>
            </section>

            <div class="border-t border-stone-200"></div>

            {{-- Daftar Inventaris --}}
            <section>
                <div class="mb-6">
                    <span class="mb-2 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Daftar Fasilitas
                    </span>

                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Daftar Inventaris Terdata
                    </h2>

                    <p class="mt-2 text-sm text-gray-600">
                        Lihat informasi barang, jumlah, dan kondisi inventaris masjid.
                    </p>
                </div>

                {{-- Pencarian dan Filter --}}
                <form action="{{ url()->current() }}" method="GET"
                    class="mb-5 rounded-2xl border border-stone-200 bg-white p-4 shadow-sm sm:p-5">

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-[minmax(0,1fr)_220px_auto_auto]">

                        <div>
                            <label for="search" class="mb-1.5 block text-xs font-semibold text-gray-700">
                                Cari Inventaris
                            </label>

                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m21 21-4.35-4.35M19 10.5a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z"/>
                                </svg>

                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama atau kode barang..."
                                    class="w-full rounded-xl border border-stone-200 py-2.5 pl-10 pr-3 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#8c6b2d] focus:outline-none focus:ring-2 focus:ring-[#8c6b2d]/20"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="condition" class="mb-1.5 block text-xs font-semibold text-gray-700">
                                Kondisi Barang
                            </label>

                            <select
                                id="condition"
                                name="condition"
                                class="w-full rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-sm text-gray-700 focus:border-[#8c6b2d] focus:outline-none focus:ring-2 focus:ring-[#8c6b2d]/20"
                            >
                                <option value="">Semua Kondisi</option>
                                <option value="Baik" @selected(request('condition') === 'Baik')>Baik</option>
                                <option value="Repair" @selected(request('condition') === 'Repair')>Repair</option>
                                <option value="Rusak" @selected(request('condition') === 'Rusak')>Rusak</option>
                                <option value="Hilang" @selected(request('condition') === 'Hilang')>Hilang</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full rounded-xl bg-[#8c6b2d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#6e5321]">
                                Cari
                            </button>
                        </div>

                        <div class="flex items-end">
                            <a href="{{ url()->current() }}"
                                class="inline-flex w-full items-center justify-center rounded-xl border border-stone-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-stone-50 md:w-auto">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                {{-- Tabel Responsif --}}
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-180 text-left text-sm text-gray-600">
                            <thead class="border-b border-stone-200 bg-stone-100 text-xs font-bold uppercase tracking-wider text-gray-700">
                                <tr>
                                    <th class="px-5 py-4">Barang</th>
                                    <th class="px-5 py-4">Kode Inventaris</th>
                                    <th class="px-5 py-4">Jumlah</th>
                                    <th class="px-5 py-4">Kondisi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-stone-100">
                                @forelse ($inventories as $inventory)
                                    @php
                                        $condition = $inventory->condition instanceof \App\Enums\InventoryCondition
                                            ? $inventory->condition->value
                                            : $inventory->condition;

                                        $conditionStyle = match ($condition) {
                                            'Baik' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                            'Repair' => 'border-blue-200 bg-blue-50 text-blue-700',
                                            'Rusak' => 'border-rose-200 bg-rose-50 text-rose-700',
                                            'Hilang' => 'border-gray-200 bg-gray-100 text-gray-700',
                                            default => 'border-stone-200 bg-stone-50 text-gray-600',
                                        };
                                    @endphp

                                    <tr class="transition hover:bg-stone-50">
                                        <td class="px-5 py-4">
                                            <div class="flex min-w-0 items-center gap-3">
                                                @if ($inventory->image)
                                                    <img
                                                        src="{{ asset('storage/' . ltrim($inventory->image, '/')) }}"
                                                        alt="{{ $inventory->name }}"
                                                        loading="lazy"
                                                        class="h-12 w-12 shrink-0 rounded-xl border border-stone-200 object-cover"
                                                    >
                                                @else
                                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-stone-200 bg-stone-100 text-stone-400">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                        </svg>
                                                    </div>
                                                @endif

                                                <div class="min-w-0">
                                                    <p class="font-semibold text-gray-900">
                                                        {{ $inventory->name }}
                                                    </p>

                                                    @if ($inventory->description)
                                                        <p class="mt-1 max-w-sm truncate text-xs text-gray-500">
                                                            {{ $inventory->description }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4">
                                            <span class="font-mono text-xs font-semibold text-gray-700">
                                                {{ $inventory->code ?: '-' }}
                                            </span>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4">
                                            <span class="font-semibold text-gray-800">
                                                {{ number_format($inventory->quantity, 0, ',', '.') }}
                                            </span>
                                            <span class="text-gray-500">
                                                {{ $inventory->unit }}
                                            </span>
                                        </td>

                                        <td class="whitespace-nowrap px-5 py-4">
                                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $conditionStyle }}">
                                                {{ $condition ?: 'Tidak diketahui' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-14 text-center">
                                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-stone-100 text-stone-400">
                                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>

                                            <p class="mt-4 font-semibold text-gray-800">
                                                Inventaris tidak ditemukan
                                            </p>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Coba ubah kata kunci pencarian atau filter kondisi barang.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($inventories->hasPages() || $inventories->total() > 0)
                        <div class="flex flex-col gap-3 border-t border-stone-200 bg-white px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-5">
                            <p class="text-xs text-gray-500 sm:text-sm">
                                Menampilkan
                                <span class="font-semibold text-gray-800">{{ $inventories->firstItem() ?? 0 }}</span>
                                –
                                <span class="font-semibold text-gray-800">{{ $inventories->lastItem() ?? 0 }}</span>
                                dari
                                <span class="font-semibold text-gray-800">{{ $inventories->total() }}</span>
                                data inventaris
                            </p>

                            <div class="overflow-x-auto">
                                {{ $inventories->onEachSide(1)->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layouts.guest>
