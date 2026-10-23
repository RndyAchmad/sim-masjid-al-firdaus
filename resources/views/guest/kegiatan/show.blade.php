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

    $urlKegiatan = route('activities.show', $kegiatan->slug);
    $urlAbsolut = url($urlKegiatan);
    $namaKegiatan = $kegiatan->name;
@endphp

<x-layouts.guest>
    <section class="min-h-screen bg-gray-50 pb-16">

        {{-- Breadcrumb --}}
        <div class="border-b border-gray-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500">
                    <a href="{{ url('/') }}" class="transition hover:text-amber-700">
                        Beranda
                    </a>

                    <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>

                    <a href="{{ route('activities.index') }}"
                        class="transition hover:text-amber-700">
                        Kegiatan
                    </a>

                    <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>

                    <span class="max-w-xs truncate font-medium text-gray-800 sm:max-w-md">
                        {{ $kegiatan->name }}
                    </span>
                </nav>
            </div>
        </div>

        <div class="mx-auto max-w-5xl px-4 pt-8 sm:px-6 lg:px-8">

            {{-- Tombol kembali --}}
            <a href="{{ route('activities.index') }}"
                class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-gray-600 transition hover:text-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Kegiatan
            </a>

            {{-- Artikel / Detail Kegiatan Utama --}}
            <article class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Poster --}}
                <div class="relative aspect-video w-full overflow-hidden bg-linear-to-br from-amber-50 to-amber-100">
                    @if ($kegiatan->image_poster)
                        <img
                            src="{{ asset('storage/' . $kegiatan->image_poster) }}"
                            alt="{{ $kegiatan->name }}"
                            class="h-full w-full object-cover"
                        >
                    @else
                        <div class="flex h-full w-full items-center justify-center text-amber-700">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="mx-auto h-16 w-16 sm:h-20 sm:w-20"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                </svg>
                                <p class="mt-3 text-sm font-medium">Kegiatan Masjid Al-Firdaus</p>
                            </div>
                        </div>
                    @endif

                    {{-- Badge jenis kegiatan --}}
                    <span class="absolute left-4 top-4 rounded-full bg-white/95 px-4 py-2 text-xs font-bold uppercase tracking-wider text-amber-800 shadow sm:text-sm">
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

                <div class="p-5 sm:p-8 lg:p-10">

                    {{-- Label Agenda/Rutin --}}
                    <div class="mb-5">
                        <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-4 py-2 text-xs font-bold uppercase tracking-wider text-amber-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $isRutin ? $labelJadwal : 'Agenda Kegiatan' }}
                        </span>
                    </div>

                    {{-- Judul --}}
                    <h1 class="text-2xl font-extrabold leading-tight tracking-tight text-gray-900 sm:text-3xl lg:text-4xl wrap-break-word">
                        {{ $kegiatan->name }}
                    </h1>

                    {{-- Panel Informasi Jadwal, Waktu & Tempat --}}
                    <div class="mt-7 rounded-2xl border border-amber-200 bg-linear-to-br from-amber-50 to-[#fffaf0] p-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- Tanggal / Hari Rutin --}}
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 text-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
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
                                        <p class="mt-0.5 text-xs font-semibold text-amber-800">
                                            ({{ $labelJadwal }})
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- Waktu --}}
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 text-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm text-gray-500">Waktu</p>
                                    <p class="mt-1 font-bold text-gray-900">
                                        {{ \Carbon\Carbon::parse($kegiatan->time)->format('H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            {{-- Tempat / Lokasi --}}
                            <div class="flex items-start gap-3 sm:col-span-2">
                                <div class="mt-0.5 text-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
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
                        <div class="mt-6 flex items-center gap-4 rounded-xl border border-gray-200 p-4 bg-gray-50/50">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a6 6 0 00-12 0m12 0h4m-4 0v-1a4 4 0 00-8 0v1m4-9a4 4 0 110-8 4 4 0 010 8z"/>
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

                    {{-- Ringkasan / Excerpt --}}
                    @if ($kegiatan->excerpt)
                        <div class="mt-7 rounded-r-xl border-l-4 border-amber-500 bg-amber-50/70 px-5 py-4">
                            <p class="text-base leading-relaxed text-gray-700 sm:text-lg">
                                {{ $kegiatan->excerpt }}
                            </p>
                        </div>
                    @endif

                    {{-- Deskripsi Lengkap --}}
                    @if ($kegiatan->description)
                        <div class="prose prose-gray mt-8 max-w-none whitespace-pre-line wrap-break-word text-base leading-8 text-gray-700">
                            {!! nl2br(e($kegiatan->description)) !!}
                        </div>
                    @endif

                    {{-- Bagikan Kegiatan (Share Buttons) --}}
                    <div class="mt-10 border-t border-gray-200 pt-6">
                        <p class="mb-4 text-sm font-bold text-gray-800">
                            Bagikan kegiatan ini
                        </p>

                        <div class="flex flex-wrap items-center gap-3">
                            {{-- WhatsApp --}}
                            <a
                                href="https://wa.me/?text={{ urlencode($namaKegiatan . ' ' . $urlAbsolut) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Bagikan ke WhatsApp"
                                title="Bagikan ke WhatsApp"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#25D366] text-white transition hover:-translate-y-1 hover:bg-[#1DA851] hover:shadow-md"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18.403 5.633A10.457 10.457 0 0010.834 2C5.086 2 4.14 6.32 4.14 8.784c0 1.554.414 3.003 1.201 4.252L4 19.5l6.702-1.314a10.4 10.4 0 004.887 1.225h.004c5.744 0 10.418-4.665 10.418-10.414 0-2.78-1.082-5.393-3.006-7.362zM14.595 16.92a8.735 8.735 0 01-4.463-1.225l-.32-.191-3.33.653.667-3.235-.208-.332a8.683 8.683 0 01-1.332-4.685c0-4.8 3.908-8.707 8.712-8.707 2.324 0 4.505.906 6.143 2.547a8.653 8.653 0 012.548 6.14c0 4.802-3.908 8.71-8.708 8.71zm4.772-7.534c-.261-.131-1.543-.761-1.782-.849-.239-.088-.413-.131-.587.131-.174.262-.674.848-.826 1.022-.152.174-.304.196-.565.065-.261-.131-1.102-.406-2.1-1.296-.777-.692-1.301-1.547-1.453-1.808-.152-.261-.016-.402.114-.533.117-.117.261-.304.392-.456.131-.152.174-.261.261-.435.087-.174.043-.326-.022-.457-.065-.131-.587-1.414-.804-1.936-.212-.511-.428-.442-.587-.45l-.5-.008c-.174 0-.456.065-.695.326-.239.261-.913.892-.913 2.176 0 1.284.935 2.525 1.065 2.699.13.174 1.839 2.808 4.456 3.938.622.268 1.107.428 1.485.549.623.199 1.19.171 1.638.104.5-.075 1.543-.631 1.761-1.241.218-.61.218-1.132.152-1.241-.066-.109-.239-.174-.5-.305z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            {{-- Facebook --}}
                            <a
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($urlAbsolut) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Bagikan ke Facebook"
                                title="Bagikan ke Facebook"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#1877F2] text-white transition hover:-translate-y-1 hover:bg-[#0C63D4] hover:shadow-md"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            {{-- Instagram --}}
                            <a
                                href="https://www.instagram.com/"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Buka Instagram"
                                title="Buka Instagram"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-linear-to-tr from-[#feda75] via-[#d62976] to-[#962fbf] text-white transition hover:-translate-y-1 hover:shadow-md"
                            >
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </a>

                            {{-- Salin Tautan --}}
                            <button
                                type="button"
                                id="copyKegiatanLink"
                                data-url="{{ $urlAbsolut }}"
                                aria-label="Salin tautan kegiatan"
                                title="Salin tautan kegiatan"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-gray-300 bg-white text-gray-600 transition hover:-translate-y-1 hover:border-amber-500 hover:text-amber-700 hover:shadow-md"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </button>
                        </div>

                        {{-- Notifikasi Salin Tautan (Toast) --}}
                        <div id="copyKegiatanMessage" class="mt-3 hidden items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 transition-all duration-300">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Tautan kegiatan berhasil disalin ke clipboard!</span>
                        </div>

                        <p class="mt-3 text-xs leading-relaxed text-gray-500">
                            Instagram dibuka agar kamu dapat membagikan tautan kegiatan melalui bio, Story, atau pesan langsung.
                        </p>
                    </div>

                </div>
            </article>

            {{-- Kegiatan Lainnya di Bagian Bawah (Opsional agar makin lengkap) --}}
            @if (isset($kegiatanLainnya) && $kegiatanLainnya->isNotEmpty())
                <section class="mt-12">
                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-gray-900 sm:text-2xl">
                            Kegiatan Lainnya
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Informasi agenda dan kegiatan masjid lainnya.
                        </p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        @foreach ($kegiatanLainnya as $lainnya)
                            <a
                                href="{{ route('activities.show', $lainnya->slug) }}"
                                class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-lg"
                            >
                                <div>
                                    <div class="aspect-video overflow-hidden bg-amber-50">
                                        @if ($lainnya->image_poster)
                                            <img
                                                src="{{ asset('storage/' . $lainnya->image_poster) }}"
                                                alt="{{ $lainnya->name }}"
                                                loading="lazy"
                                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                            >
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-amber-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-5">
                                        <p class="mb-3 flex items-center gap-2 text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                                            </svg>
                                            @if ($lainnya->schedule_type instanceof \BackedEnum ? $lainnya->schedule_type->value === 'once' : $lainnya->schedule_type === 'once')
                                                {{ \Carbon\Carbon::parse($lainnya->date)->locale('id')->translatedFormat('d F Y') }}
                                            @else
                                                @php
                                                    $hariLain = $lainnya->day_of_week instanceof \BackedEnum
                                                        ? $lainnya->day_of_week
                                                        : \App\Enums\ScheduleDay::tryFrom((string) $lainnya->day_of_week);
                                                @endphp
                                                {{ $hariLain?->label() ?? ucfirst((string) $lainnya->day_of_week) }}
                                            @endif
                                            · {{ \Carbon\Carbon::parse($lainnya->time)->format('H:i') }} WIB
                                        </p>

                                        <h3 class="line-clamp-2 text-lg font-bold leading-snug text-gray-900 transition group-hover:text-amber-700">
                                            {{ $lainnya->name }}
                                        </h3>

                                        @if ($lainnya->excerpt)
                                            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-gray-600">
                                                {{ $lainnya->excerpt }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="px-5 pb-5">
                                    <span class="inline-flex items-center gap-2 text-sm font-bold text-amber-700">
                                        Lihat detail
                                        <svg class="h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Tombol Lihat Semua Kegiatan di Paling Bawah --}}
            <div class="mt-12 flex justify-center border-t border-gray-200 pt-8">
                <a
                    href="{{ route('activities.index') }}"
                    class="inline-flex items-center justify-center gap-3 rounded-xl bg-amber-700 px-7 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-amber-800 hover:shadow-md"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Lihat Semua Kegiatan
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    {{-- Script JavaScript untuk Salin Tautan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyButton = document.getElementById('copyKegiatanLink');
            const copyMessage = document.getElementById('copyKegiatanMessage');

            if (!copyButton || !copyMessage) return;

            let timeoutId;

            copyButton.addEventListener('click', async function () {
                const url = this.dataset.url;

                try {
                    await navigator.clipboard.writeText(url);
                    
                    copyMessage.classList.remove('hidden');
                    copyMessage.classList.add('flex');

                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(() => {
                        copyMessage.classList.remove('flex');
                        copyMessage.classList.add('hidden');
                    }, 3000);

                } catch (error) {
                    window.prompt('Salin tautan kegiatan berikut:', url);
                }
            });
        });
    </script>
</x-layouts.guest>
