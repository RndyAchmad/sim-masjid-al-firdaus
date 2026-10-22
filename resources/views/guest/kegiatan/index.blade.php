<x-layouts.guest>
    {{-- Header Banner Halaman Kegiatan --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Agenda & Syiar
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Jadwal Kegiatan Masjid
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Ikuti berbagai agenda kajian, kegiatan rutin, dan event keagamaan di Masjid Al-Firdaus
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-16 sm:space-y-20">

            {{-- 1. SECTION ATAS: EVENT MENDATANG (Sekali Jalan) --}}
            <section>
                {{-- Header Section (Rata Tengah) --}}
                <div class="mb-8 text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                        Spesial & Mendatang
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                        Event & Agenda Mendatang
                    </h2>
                    <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                        Agenda kegiatan khusus dan peringatan hari besar Islam yang akan diselenggarakan dalam waktu
                        dekat.
                    </p>
                </div>

                {{-- Grid Event Dummy --}}
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($events as $event)
                        @php
                            $tanggalAcara = \Carbon\Carbon::parse($event->date)->startOfDay();
                            $hariIni = now()->startOfDay();
                            $selisihHari = (int) $hariIni->diffInDays($tanggalAcara, false);

                            $tanggalLewat = $tanggalAcara->lt($hariIni);
                            $labelTipe = ucfirst(str_replace('_', ' ', $event->tipe));
                        @endphp

                        <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-xl">

                            {{-- Poster dan badge hitung mundur --}}
                            <a href="{{ route('activities.show', $event->slug) }}"
                                class="relative block aspect-16/10 overflow-hidden bg-amber-50">

                                @if ($event->image_poster)
                                    <img
                                        src="{{ asset('storage/' . $event->image_poster) }}"
                                        alt="{{ $event->name }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center bg-linear-to-br from-amber-50 to-amber-100">
                                        <div class="text-center text-amber-700">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-14 w-14"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                            </svg>
                                            <p class="mt-2 text-sm font-semibold">Agenda Masjid</p>
                                        </div>
                                    </div>
                                @endif

                                {{-- Label kategori --}}
                                <span class="absolute left-3 top-3 max-w-[55%] truncate rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold text-amber-800 shadow-sm sm:left-4 sm:top-4">
                                    {{ $labelTipe }}
                                </span>

                                {{-- Hitung mundur acara --}}
                                @if (!$tanggalLewat && $selisihHari === 0)
                                    <span class="absolute right-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-red-600 px-3 py-2 text-xs font-bold text-white shadow-lg sm:right-4 sm:top-4">
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
                                @elseif (!$tanggalLewat && $selisihHari >= 1 && $selisihHari <= 7)
                                    <span class="absolute right-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-red-600 px-3 py-2 text-xs font-bold text-white shadow-lg sm:right-4 sm:top-4">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <circle cx="12" cy="12" r="9"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 7v5l3 2"/>
                                        </svg>
                                        {{ $selisihHari }} {{ $selisihHari === 1 ? 'hari' : 'hari' }} lagi
                                    </span>
                                @endif
                            </a>

                            {{-- Konten card --}}
                            <div class="flex flex-1 flex-col p-4 sm:p-5">

                                <h3 class="text-lg font-bold leading-snug text-gray-900 transition group-hover:text-amber-700 sm:text-xl">
                                    <a href="{{ route('activities.show', $event->slug) }}">
                                        {{ $event->name }}
                                    </a>
                                </h3>

                                <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-600">
                                    {{ $event->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 110) }}
                                </p>

                                {{-- Panel informasi utama --}}
                                <div class="mt-5 rounded-xl border border-amber-200 bg-linear-to-br from-amber-50 to-[#fffaf0] p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#c49c4d] text-white shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                            </svg>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <p class="text-xs font-medium text-amber-800">Tanggal Kegiatan</p>
                                            <p class="mt-0.5 font-bold text-gray-900">
                                                {{ $tanggalAcara->locale('id')->translatedFormat('l, d F Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="my-3 border-t border-amber-200/80"></div>

                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                        {{-- Jam --}}
                                        <div class="flex min-w-0 items-start gap-2.5">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mt-0.5 h-5 w-5 shrink-0 text-amber-700"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.7">
                                                <circle cx="12" cy="12" r="9"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 7v5l3 2"/>
                                            </svg>
                                            <div class="min-w-0">
                                                <p class="text-xs text-gray-500">Waktu</p>
                                                <p class="wrap-break-word text-sm font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Tempat --}}
                                        <div class="flex min-w-0 items-start gap-2.5">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mt-0.5 h-5 w-5 shrink-0 text-amber-700"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <div class="min-w-0">
                                                <p class="text-xs text-gray-500">Tempat</p>
                                                <p class="wrap-break-word text-sm font-semibold text-gray-900">
                                                    {{ $event->location }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Pemateri --}}
                                @if ($event->speaker)
                                    <div class="mt-4 flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 19a6 6 0 00-12 0m12 0h4m-4 0v-1a4 4 0 00-8 0v1m4-9a4 4 0 110-8 4 4 0 010 8z"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-xs text-gray-500">Pemateri</p>
                                            <p class="truncate text-sm font-semibold text-gray-800">
                                                {{ $event->speaker }}
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                {{-- Tombol detail --}}
                                <a href="{{ route('activities.show', $event->slug) }}"
                                    class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-6 py-12 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-amber-50 text-amber-700">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-7 w-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3M4 11h16"/>
                                </svg>
                            </div>
                            <h3 class="mt-4 font-semibold text-gray-900">
                                Belum Ada Agenda Mendatang
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Informasi agenda kegiatan masjid akan ditampilkan di sini.
                            </p>
                        </div>
                    @endforelse
                </div>

            </section>

            {{-- Separator Pembatas --}}
            <div class="border-t border-stone-200/80"></div>

            {{-- 2. SECTION BAWAH: KEGIATAN RUTIN --}}
            <section>
                {{-- Header Section (Rata Tengah) --}}
                <div class="mb-8 text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                        Program Berkala
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                        Jadwal Kegiatan Rutin
                    </h2>
                    <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                        Agenda kajian dan program pembinaan jamaah yang diselenggarakan secara rutin setiap pekannya.
                    </p>
                </div>

                {{-- Grid Kegiatan Rutin Dummy --}}
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($kegiatanRutin as $event)
                        @php
                            $jenisJadwal = $event->schedule_type instanceof \BackedEnum
                                ? $event->schedule_type->value
                                : $event->schedule_type;

                            $hari = $event->day_of_week instanceof \BackedEnum
                                ? $event->day_of_week
                                : \App\Enums\ScheduleDay::tryFrom((string) $event->day_of_week);

                            $labelHari = $hari?->label() ?? ucfirst((string) $event->day_of_week);

                            $labelJadwal = $jenisJadwal === 'biweekly'
                                ? 'Setiap Dua Minggu'
                                : 'Setiap Minggu';
                        @endphp

                        <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                            {{-- Poster kegiatan rutin --}}
                            <a href="{{ route('activities.show', $event->slug) }}"
                                class="relative block aspect-16/10 overflow-hidden bg-amber-50">

                                @if ($event->image_poster)
                                    <img
                                        src="{{ asset('storage/' . $event->image_poster) }}"
                                        alt="{{ $event->name }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center bg-linear-to-br from-amber-50 to-amber-100">
                                        <div class="text-center text-amber-700">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-14 w-14"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                            </svg>
                                            <p class="mt-2 text-sm font-semibold">Kegiatan Rutin</p>
                                        </div>
                                    </div>
                                @endif

                                <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1.5 text-xs font-semibold text-amber-800 shadow-sm">
                                    {{ $labelJadwal }}
                                </span>
                            </a>

                            {{-- Informasi kegiatan --}}
                            <div class="flex flex-1 flex-col p-5">
                                <div class="mb-3 flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800">
                                        {{ ucfirst(str_replace('_', ' ', $event->tipe)) }}
                                    </span>

                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                        {{ $labelHari }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold leading-snug text-gray-900 transition group-hover:text-amber-700">
                                    <a href="{{ route('activities.show', $event->slug) }}">
                                        {{ $event->name }}
                                    </a>
                                </h3>

                                <p class="mt-2 flex-1 text-sm leading-6 text-gray-600 line-clamp-3">
                                    {{ $event->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 120) }}
                                </p>

                                <div class="mt-4 space-y-3 border-t border-gray-100 pt-4">
                                    {{-- Hari --}}
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Hari Kegiatan</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $labelHari }} · {{ $labelJadwal }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Jam --}}
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Waktu</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($event->time)->format('H:i') }} WIB
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Pemateri --}}
                                    @if ($event->speaker)
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.7">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 19a6 6 0 00-12 0m12 0h4m-4 0v-1a4 4 0 00-8 0v1m4-9a4 4 0 110-8 4 4 0 010 8z"/>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs text-gray-500">Pemateri</p>
                                                <p class="truncate text-sm font-semibold text-gray-800">
                                                    {{ $event->speaker }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Lokasi --}}
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
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
                                            <p class="text-xs text-gray-500">Lokasi</p>
                                            <p class="truncate text-sm font-semibold text-gray-800">
                                                {{ $event->location }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('activities.show', $event->slug) }}"
                                    class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-6 py-12 text-center">
                            <h3 class="font-semibold text-gray-900">Belum Ada Jadwal Rutin</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Jadwal kegiatan rutin masjid akan ditampilkan di sini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>
