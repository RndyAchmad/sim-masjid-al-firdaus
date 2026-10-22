<x-layouts.admin>
    <x-slot name="title">Manajemen Kegiatan</x-slot>

    <div class="space-y-6">

        {{-- Header Actions & Search --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <form action="{{ route('admin.kegiatan.index') }}" method="GET"
                class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center"
                onkeydown="if (event.key === 'Enter' && event.target.tagName !== 'BUTTON') event.preventDefault()">
                {{-- Input Pencarian --}}
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" name="search" value="{{ $search ?? request('search') }}"
                        placeholder="Cari nama atau pemateri..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Filter Tipe --}}
                <select name="tipe"
                    class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto">
                    <option value="">Semua Tipe</option>

                    @foreach ($tipeKegiatan as $item)
                        <option value="{{ $item }}" @selected(($tipe ?? request('tipe')) === $item)>
                            {{ ucfirst($item) }}
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

                {{-- Reset Filter --}}
                @if (request()->filled('search') || request()->filled('tipe'))
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Tombol Tambah Kegiatan --}}
            <a href="{{ route('admin.kegiatan.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e] sm:w-auto">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kegiatan
            </a>
        </div>

        {{-- Tabel Data Kegiatan --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">

            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-225 text-left text-sm text-gray-600">

                    {{-- Table Header --}}
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Nama Kegiatan</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Pemateri</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">

                        @forelse ($kegiatans as $kegiatan)
                            @php
                                $scheduleTypeValue = $kegiatan->schedule_type instanceof \BackedEnum
                                    ? $kegiatan->schedule_type->value
                                    : $kegiatan->schedule_type;

                                $scheduleTypeLabel = \App\Enums\ActivityScheduleType::tryFrom($scheduleTypeValue)?->label()
                                    ?? ucfirst((string) $scheduleTypeValue);

                                $dayValue = $kegiatan->day_of_week instanceof \BackedEnum
                                    ? $kegiatan->day_of_week->value
                                    : $kegiatan->day_of_week;

                                $dayLabel = $dayValue
                                    ? (\App\Enums\ScheduleDay::tryFrom($dayValue)?->label() ?? ucfirst($dayValue))
                                    : null;

                                $dateLabel = $kegiatan->date
                                    ? \Illuminate\Support\Carbon::parse($kegiatan->date)->format('d-m-Y')
                                    : null;

                                $timeLabel = $kegiatan->time
                                    ? substr((string) $kegiatan->time, 0, 5)
                                    : '-';
                            @endphp

                            <tr class="transition hover:bg-gray-50/50">

                                {{-- Nama Kegiatan --}}
                                <td class="px-6 py-4">
                                    <div class="min-w-48">
                                        <p class="font-semibold text-gray-900">
                                            {{ $kegiatan->name }}
                                        </p>
                                    </div>
                                </td>

                                {{-- Tipe Kegiatan --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex rounded-full border border-gray-200 bg-gray-50 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                        {{ ucfirst($kegiatan->tipe) }}
                                    </span>
                                </td>

                                {{-- Jadwal --}}
                                <td class="px-6 py-4">
                                    <div class="whitespace-nowrap">
                                        <p class="font-medium text-gray-800">
                                            @if ($scheduleTypeValue === 'once')
                                                {{ $dateLabel ?? '-' }}
                                            @else
                                                {{ $dayLabel ?? '-' }}
                                            @endif
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $scheduleTypeLabel }} · {{ $timeLabel }} WIB
                                        </p>
                                    </div>
                                </td>

                                {{-- Lokasi --}}
                                <td class="px-6 py-4">
                                    <span class="inline-block max-w-40 text-gray-700">
                                        {{ $kegiatan->location ?: '-' }}
                                    </span>
                                </td>

                                {{-- Pemateri --}}
                                <td class="px-6 py-4">
                                    <span class="whitespace-nowrap text-gray-700">
                                        {{ $kegiatan->speaker ?: '-' }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Detail --}}
                                        <a href="{{ route('admin.kegiatan.show', $kegiatan->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="Detail kegiatan {{ $kegiatan->name }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit kegiatan {{ $kegiatan->name }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}" method="POST"
                                            data-confirm="Kegiatan {{ $kegiatan->name }} akan dihapus. Tindakan ini tidak dapat dibatalkan."
                                            data-confirm-title="Hapus kegiatan?">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="Hapus kegiatan {{ $kegiatan->name }}">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="mb-3 h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1z" />
                                        </svg>

                                        <p class="font-medium text-gray-700">
                                            Belum ada data kegiatan.
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Coba ubah pencarian atau filter yang digunakan.
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
                        {{ $kegiatans->firstItem() ?? 0 }}–{{ $kegiatans->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-semibold text-gray-700">
                        {{ $kegiatans->total() }}
                    </span>
                    kegiatan
                </p>

                <div>
                    {{ $kegiatans->links() }}
                </div>
            </div>

        </div>
    </div>
</x-layouts.admin>
