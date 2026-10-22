@php
    $jenisJadwal = $kegiatan->schedule_type instanceof \BackedEnum
        ? $kegiatan->schedule_type->value
        : $kegiatan->schedule_type;

    $hari = $kegiatan->day_of_week instanceof \BackedEnum
        ? $kegiatan->day_of_week
        : \App\Enums\ScheduleDay::tryFrom((string) $kegiatan->day_of_week);

    $labelHari = $hari?->label() ?? ucfirst((string) $kegiatan->day_of_week);

    $isRutin = in_array($jenisJadwal, ['weekly', 'biweekly']);

    $labelJadwal = match ($jenisJadwal) {
        'weekly' => 'Setiap Minggu',
        'biweekly' => 'Setiap Dua Minggu',
        default => 'Agenda Mendatang',
    };

    $tanggalAcara = $kegiatan->date
        ? \Carbon\Carbon::parse($kegiatan->date)->startOfDay()
        : null;

    $hariIni = now()->startOfDay();

    $selisihHari = $tanggalAcara
        ? (int) $hariIni->diffInDays($tanggalAcara, false)
        : null;

    $tanggalLewat = $tanggalAcara && $tanggalAcara->lt($hariIni);
@endphp

<x-layouts.guest>
    <section class="min-h-screen bg-gray-50 pb-16">

        {{-- Breadcrumb --}}
        <div class="border-b border-gray-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500">
                    <a href="{{ route('activities.index') }}"
                        class="transition hover:text-amber-700">
                        Kegiatan
                    </a>
                    <span>/</span>
                    <span class="font-medium text-gray-900">
                        {{ \Illuminate\Support\Str::limit($kegiatan->name, 45) }}
                    </span>
                </nav>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">

            {{-- Tombol kembali --}}
            <a href="{{ route('activities.index') }}"
                class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-gray-600 transition hover:text-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke daftar kegiatan
            </a>

            {{-- Konten utama --}}
            <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-3 lg:gap-10">

                {{-- Detail kegiatan --}}
                <article class="min-w-0 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm lg:col-span-2">

                    {{-- Poster --}}
                    <div class="relative aspect-video overflow-hidden bg-linear-to-br from-amber-50 to-amber-100 sm:aspect-16/8">
                        @if ($kegiatan->image_poster)
                            <img
                                src="{{ asset('storage/' . $kegiatan->image_poster) }}"
                                alt="{{ $kegiatan->name }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-amber-700">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="mx-auto h-16 w-16 sm:h-20 sm:w-20"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                    </svg>
                                    <p class="mt-3 font-semibold">Kegiatan Masjid Al-Firdaus</p>
                                </div>
                            </div>
                        @endif

                        {{-- Badge jenis kegiatan --}}
                        <span class="absolute left-4 top-4 rounded-full bg-white/95 px-4 py-2 text-xs font-bold text-amber-800 shadow sm:text-sm">
                            {{ ucfirst(str_replace('_', ' ', $kegiatan->tipe)) }}
                        </span>

                        {{-- Badge hitung mundur untuk agenda sekali --}}
                        @if (!$isRutin && $tanggalAcara && !$tanggalLewat && $selisihHari === 0)
                            <span class="absolute right-4 top-4 inline-flex items-center gap-2 rounded-full bg-red-600 px-3 py-2 text-xs font-bold text-white shadow-lg sm:px-4 sm:text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 7v5l3 2"/>
                                </svg>
                                Hari ini
                            </span>
                        @elseif (!$isRutin && $tanggalAcara && !$tanggalLewat && $selisihHari >= 1 && $selisihHari <= 7)
                            <span class="absolute right-4 top-4 inline-flex items-center gap-2 rounded-full bg-red-600 px-3 py-2 text-xs font-bold text-white shadow-lg sm:px-4 sm:text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 7v5l3 2"/>
                                </svg>
                                {{ $selisihHari }} hari lagi
                            </span>
                        @endif
                    </div>

                    <div class="p-5 sm:p-7 lg:p-8">

                        {{-- Judul --}}
                        <div class="mb-6">
                            <span class="inline-flex rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-800">
                                {{ $isRutin ? $labelJadwal : 'Agenda Kegiatan' }}
                            </span>

                            <h1 class="mt-4 wrap-break-word text-2xl font-bold leading-tight text-gray-900 sm:text-3xl lg:text-4xl">
                                {{ $kegiatan->name }}
                            </h1>

                            @if ($kegiatan->excerpt)
                                <p class="mt-4 text-base leading-7 text-gray-600 sm:text-lg">
                                    {{ $kegiatan->excerpt }}
                                </p>
                            @endif
                        </div>

                        {{-- Panel informasi jadwal --}}
                        <div class="rounded-2xl border border-amber-200 bg-linear-to-br from-amber-50 to-[#fffaf0] p-5 sm:p-6">

                            <div class="mb-5 flex items-center gap-3">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#c49c4d] text-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="font-bold text-gray-900">Informasi Kegiatan</h2>
                                    <p class="text-sm text-gray-500">
                                        Jadwal dan lokasi pelaksanaan
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                {{-- Tanggal atau hari rutin --}}
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-gray-500">
                                            {{ $isRutin ? 'Hari Kegiatan' : 'Tanggal' }}
                                        </p>
                                        <p class="mt-1 font-bold text-gray-900">
                                            @if ($isRutin)
                                                {{ $labelHari }}
                                            @elseif ($tanggalAcara)
                                                {{ $tanggalAcara->locale('id')->translatedFormat('l, d F Y') }}
                                            @else
                                                Belum ditentukan
                                            @endif
                                        </p>
                                        @if ($isRutin)
                                            <p class="mt-1 text-sm text-amber-800">
                                                {{ $labelJadwal }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Jam --}}
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.7">
                                            <circle cx="12" cy="12" r="9"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 7v5l3 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Waktu</p>
                                        <p class="mt-1 font-bold text-gray-900">
                                            {{ \Carbon\Carbon::parse($kegiatan->time)->format('H:i') }} WIB
                                        </p>
                                    </div>
                                </div>

                                {{-- Lokasi --}}
                                <div class="flex items-start gap-3 sm:col-span-2">
                                    <div class="mt-0.5 text-amber-700">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-gray-500">Tempat</p>
                                        <p class="mt-1 wrap-break-word font-bold text-gray-900">
                                            {{ $kegiatan->location }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Pemateri --}}
                        @if ($kegiatan->speaker)
                            <div class="mt-6 flex items-center gap-4 rounded-xl border border-gray-200 p-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-800">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19a6 6 0 00-12 0m12 0h4m-4 0v-1a4 4 0 00-8 0v1m4-9a4 4 0 110-8 4 4 0 010 8z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-500">Pemateri / Penceramah</p>
                                    <p class="mt-1 wrap-break-word font-bold text-gray-900">
                                        {{ $kegiatan->speaker }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        {{-- Deskripsi --}}
                        @if ($kegiatan->description)
                            <div class="mt-8">
                                <h2 class="text-xl font-bold text-gray-900">
                                    Tentang Kegiatan
                                </h2>
                                <div class="mt-4 wrap-break-word text-sm leading-7 text-gray-600 sm:text-base">
                                    {!! nl2br(e($kegiatan->description)) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </article>

                {{-- Sidebar --}}
                <aside class="space-y-6 lg:sticky lg:top-24">

                    {{-- Ringkasan --}}
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                        <h2 class="text-lg font-bold text-gray-900">
                            Ringkasan Jadwal
                        </h2>

                        <div class="mt-5 space-y-4">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Jenis Kegiatan
                                </p>
                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ ucfirst(str_replace('_', ' ', $kegiatan->tipe)) }}
                                </p>
                            </div>

                            <div class="border-t border-gray-100"></div>

                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Pola Jadwal
                                </p>
                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $labelJadwal }}
                                </p>
                            </div>

                            @if (!$isRutin && $tanggalAcara)
                                <div class="border-t border-gray-100"></div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        Status Jadwal
                                    </p>
                                    @if ($tanggalLewat)
                                        <span class="mt-2 inline-flex rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-600">
                                            Telah berlalu
                                        </span>
                                    @elseif ($selisihHari === 0)
                                        <span class="mt-2 inline-flex rounded-full bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">
                                            Berlangsung hari ini
                                        </span>
                                    @else
                                        <span class="mt-2 inline-flex rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700">
                                            Akan datang
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('activities.index') }}"
                            class="mt-6 inline-flex w-full items-center justify-center rounded-xl border border-gray-300 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:border-amber-400 hover:bg-amber-50 hover:text-amber-800">
                            Lihat Semua Kegiatan
                        </a>
                    </div>

                    {{-- Kegiatan lainnya --}}
                    @if (isset($kegiatanLainnya) && $kegiatanLainnya->isNotEmpty())
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                            <h2 class="text-lg font-bold text-gray-900">
                                Kegiatan Lainnya
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Lihat agenda masjid lainnya.
                            </p>

                            <div class="mt-5 space-y-4">
                                @foreach ($kegiatanLainnya as $lainnya)
                                    <a href="{{ route('activities.show', $lainnya->slug) }}"
                                        class="group flex items-start gap-3 rounded-xl p-2 transition hover:bg-amber-50">

                                        <div class="h-16 w-16 shrink-0 overflow-hidden rounded-lg bg-amber-50">
                                            @if ($lainnya->image_poster)
                                                <img
                                                    src="{{ asset('storage/' . $lainnya->image_poster) }}"
                                                    alt="{{ $lainnya->name }}"
                                                    class="h-full w-full object-cover transition group-hover:scale-105"
                                                    loading="lazy"
                                                >
                                            @else
                                                <div class="flex h-full items-center justify-center text-amber-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-7 w-7" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8 7V3m8 4V3M4 11h16"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <h3 class="line-clamp-2 text-sm font-semibold leading-5 text-gray-800 transition group-hover:text-amber-800">
                                                {{ $lainnya->name }}
                                            </h3>

                                            <p class="mt-1 text-xs text-gray-500">
                                                @if ($lainnya->schedule_type instanceof \BackedEnum
                                                    ? $lainnya->schedule_type->value === 'once'
                                                    : $lainnya->schedule_type === 'once')
                                                    {{ \Carbon\Carbon::parse($lainnya->date)->locale('id')->translatedFormat('d M Y') }}
                                                @else
                                                    @php
                                                        $hariLain = $lainnya->day_of_week instanceof \BackedEnum
                                                            ? $lainnya->day_of_week
                                                            : \App\Enums\ScheduleDay::tryFrom((string) $lainnya->day_of_week);
                                                    @endphp
                                                    {{ $hariLain?->label() ?? ucfirst((string) $lainnya->day_of_week) }}
                                                @endif
                                                · {{ \Carbon\Carbon::parse($lainnya->time)->format('H:i') }}
                                            </p>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="mt-1 h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-1 group-hover:text-amber-700"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
</x-layouts.guest>