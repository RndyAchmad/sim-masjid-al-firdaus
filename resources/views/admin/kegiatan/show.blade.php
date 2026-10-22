<x-layouts.admin>
    <x-slot name="title">Detail Kegiatan</x-slot>
    <x-slot name="backUrl">{{ route('admin.kegiatan.index') }}</x-slot>

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
            ? \Illuminate\Support\Carbon::parse($kegiatan->date)->translatedFormat('d F Y')
            : null;

        $timeLabel = $kegiatan->time
            ? substr((string) $kegiatan->time, 0, 5)
            : '-';
    @endphp

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Kolom Kiri: Informasi Kegiatan --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">

                {{-- Header --}}
                <div
                    class="flex flex-col gap-3 border-b border-gray-100 pb-4 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="font-bold text-gray-900">
                        Informasi Lengkap Kegiatan
                    </h3>

                    <span
                        class="inline-flex w-fit items-center rounded-full border border-[#c49c4d]/20 bg-amber-50 px-3 py-1 text-xs font-semibold text-[#a8833e]">
                        {{ ucfirst($kegiatan->tipe) }}
                    </span>
                </div>

                {{-- Nama Kegiatan --}}
                <div>
                    <span class="text-xs font-semibold uppercase text-gray-400">
                        Nama / Judul Kegiatan
                    </span>

                    <h2 class="mt-1 text-xl font-bold text-gray-900">
                        {{ $kegiatan->name }}
                    </h2>

                    @if ($kegiatan->excerpt)
                        <p class="mt-2 text-sm leading-relaxed text-gray-500">
                            {{ $kegiatan->excerpt }}
                        </p>
                    @endif
                </div>

                {{-- Jadwal, Pemateri, Lokasi --}}
                <div class="grid grid-cols-1 gap-4 rounded-xl border border-gray-200/80 bg-gray-50 p-4 sm:grid-cols-2">

                    {{-- Jadwal --}}
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Jadwal Kegiatan
                        </span>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            @if ($scheduleTypeValue === 'once')
                                {{ $dateLabel ?? 'Tanggal belum ditentukan' }}
                            @else
                                {{ $dayLabel ?? 'Hari belum ditentukan' }}
                            @endif
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $scheduleTypeLabel }}
                        </p>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Waktu
                        </span>

                        <p class="mt-1 font-mono text-sm font-semibold text-gray-800">
                            {{ $timeLabel }} WIB
                        </p>
                    </div>

                    {{-- Pemateri --}}
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Pemateri / Pengisi Acara
                        </span>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $kegiatan->speaker ?: 'Belum ditentukan' }}
                        </p>
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Lokasi / Tempat
                        </span>

                        <p class="mt-1 text-sm font-semibold text-gray-800">
                            {{ $kegiatan->location ?: '-' }}
                        </p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <span class="text-xs font-semibold uppercase text-gray-400">
                        Deskripsi Kegiatan
                    </span>

                    <div
                        class="mt-2 rounded-xl border border-gray-200 bg-white p-4 text-sm leading-relaxed text-gray-700">
                        @if ($kegiatan->description)
                            {!! nl2br(e($kegiatan->description)) !!}
                        @else
                            <span class="italic text-gray-400">
                                Belum ada deskripsi kegiatan.
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Informasi Sistem --}}
                <div class="grid grid-cols-1 gap-4 border-t border-gray-100 pt-4 sm:grid-cols-2">
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Slug
                        </span>

                        <p class="mt-1 break-all text-sm text-gray-700">
                            {{ $kegiatan->slug }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Dibuat Pada
                        </span>

                        <p class="mt-1 text-sm text-gray-700">
                            {{ $kegiatan->created_at?->translatedFormat('d F Y, H:i') ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Poster dan Aksi --}}
        <div class="space-y-6">

            {{-- Poster --}}
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Poster / Pamflet
                </h3>

                <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                    @if ($kegiatan->image_poster)
                        <img src="{{ asset('storage/' . $kegiatan->image_poster) }}" alt="Poster {{ $kegiatan->name }}"
                            class="h-auto w-full object-contain">
                    @else
                        <div class="flex min-h-48 flex-col items-center justify-center p-8 text-center">
                            <svg class="mb-3 h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm0 11l5-5 4 4 3-3 4 4M9 8h.01" />
                            </svg>

                            <p class="text-xs text-gray-400">
                                Tidak ada poster yang diunggah.
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col gap-3 pt-2">

                    {{-- Edit --}}
                    <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Kegiatan
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}" method="POST"
                        data-confirm="Kegiatan {{ $kegiatan->name }} akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan."
                        data-confirm-title="Hapus kegiatan?">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Kegiatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
