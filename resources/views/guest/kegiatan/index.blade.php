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

                    {{-- Card Event 1 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-[#8c6b2d] hover:shadow-xl">
                        <div
                            class="relative aspect-video w-full overflow-hidden bg-stone-100 border-b border-stone-200">
                            <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800"
                                alt="Tabligh Akbar"
                                class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                            <div class="absolute top-3 left-3">
                                <span
                                    class="inline-flex items-center rounded-md bg-[#8c6b2d] px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow-md">
                                    Special Event
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col justify-between p-5 sm:p-6">
                            <div>
                                <div class="flex items-center gap-2 text-xs font-semibold text-[#8c6b2d]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>25 Oktober 2026</span>
                                </div>

                                <h3 class="mt-2 font-serif text-lg font-bold text-gray-900 sm:text-xl line-clamp-2">
                                    Tabligh Akbar & Santunan Anak Yatim Piatu
                                </h3>

                                <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3">
                                    Peringatan Maulid Nabi Muhammad SAW bersama seluruh warga Perumahan Taman Puspa Sari
                                    dan jamaah sekitar.
                                </p>
                            </div>

                            <div class="mt-6 border-t border-stone-100 pt-4 space-y-2">
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Pukul 19:30 WIB (Ba'da Isya) - Selesai</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Penceramah: <strong class="text-gray-800">Ust. Dr. H.
                                            Wijayanto</strong></span>
                                </div>
                            </div>

                            <div class="mt-5 pt-2">
                                <a href="{{ route('activities.show', ['slug' => 'tabligh-akbar-santunan-anak-yatim-piatu']) }}"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8c6b2d] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6e5321]">
                                    Detail Kegiatan
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Card Event 2 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-[#8c6b2d] hover:shadow-xl">
                        <div
                            class="relative aspect-video w-full overflow-hidden bg-stone-100 border-b border-stone-200">
                            <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=800"
                                alt="Pelatihan Qurban"
                                class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                            <div class="absolute top-3 left-3">
                                <span
                                    class="inline-flex items-center rounded-md bg-[#8c6b2d] px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow-md">
                                    Special Event
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col justify-between p-5 sm:p-6">
                            <div>
                                <div class="flex items-center gap-2 text-xs font-semibold text-[#8c6b2d]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>10 November 2026</span>
                                </div>

                                <h3 class="mt-2 font-serif text-lg font-bold text-gray-900 sm:text-xl line-clamp-2">
                                    Seminar Parenting Islami Era Digital
                                </h3>

                                <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3">
                                    Mendidik anak generasi masa kini dengan pendekatan islami di tengah pesatnya
                                    perkembangan teknologi gadget.
                                </p>
                            </div>

                            <div class="mt-6 border-t border-stone-100 pt-4 space-y-2">
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Pukul 08:00 - 11:30 WIB</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Pemateri: <strong class="text-gray-800">Ibu Dr. Aisah Dahlan,
                                            CHt</strong></span>
                                </div>
                            </div>

                            <div class="mt-5 pt-2">
                                <a href="#"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8c6b2d] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6e5321]">
                                    Detail Kegiatan
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Card Event 3 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-[#8c6b2d] hover:shadow-xl">
                        <div
                            class="relative aspect-video w-full overflow-hidden bg-stone-100 border-b border-stone-200">
                            <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800"
                                alt="Bakti Sosial"
                                class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                            <div class="absolute top-3 left-3">
                                <span
                                    class="inline-flex items-center rounded-md bg-[#8c6b2d] px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white shadow-md">
                                    Special Event
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col justify-between p-5 sm:p-6">
                            <div>
                                <div class="flex items-center gap-2 text-xs font-semibold text-[#8c6b2d]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>1 Desember 2026</span>
                                </div>

                                <h3 class="mt-2 font-serif text-lg font-bold text-gray-900 sm:text-xl line-clamp-2">
                                    Bakti Sosial & Pengobatan Gratis Warga
                                </h3>

                                <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3">
                                    Pemeriksaan kesehatan umum gratis dan pembagian sembako bagi warga sekitar yang
                                    membutuhkan.
                                </p>
                            </div>

                            <div class="mt-6 border-t border-stone-100 pt-4 space-y-2">
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Pukul 08:00 WIB - Selesai</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Kerjasama: <strong class="text-gray-800">Tim Medis RSI
                                            Sidoarjo</strong></span>
                                </div>
                            </div>

                            <div class="mt-5 pt-2">
                                <a href="#"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8c6b2d] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6e5321]">
                                    Detail Kegiatan
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

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
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                    {{-- Rutin 1 --}}
                    <div
                        class="rounded-xl border border-stone-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                            <span class="rounded-md bg-[#8c6b2d]/10 px-2.5 py-1 text-xs font-bold text-[#8c6b2d]">
                                Setiap Minggu
                            </span>
                            <span class="text-xs font-semibold text-gray-500">
                                Ba'da Subuh
                            </span>
                        </div>

                        <h3 class="mt-3 font-serif text-lg font-bold text-gray-900">
                            Kajian Subuh Ahad Pagi
                        </h3>

                        <p class="mt-1 text-xs text-gray-600 line-clamp-2">
                            Pembahasan kitab Riyadhus Shalihin & sarapan bersama jamaah di serambi masjid.
                        </p>

                        <div
                            class="mt-4 flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-stone-50">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Ust. KH. Ahmad Dahlan
                            </span>
                            <span class="font-medium text-stone-400">Rutin</span>
                        </div>
                    </div>

                    {{-- Rutin 2 --}}
                    <div
                        class="rounded-xl border border-stone-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                            <span class="rounded-md bg-[#8c6b2d]/10 px-2.5 py-1 text-xs font-bold text-[#8c6b2d]">
                                Setiap Kamis
                            </span>
                            <span class="text-xs font-semibold text-gray-500">
                                Ba'da Maghrib
                            </span>
                        </div>

                        <h3 class="mt-3 font-serif text-lg font-bold text-gray-900">
                            Kajian Fiqih Ibadah
                        </h3>

                        <p class="mt-1 text-xs text-gray-600 line-clamp-2">
                            Pendalaman tata cara ibadah harian sesuai tuntunan Al-Qur'an dan As-Sunnah yang sahih.
                        </p>

                        <div
                            class="mt-4 flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-stone-50">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Ust. Muhammad Ridwan
                            </span>
                            <span class="font-medium text-stone-400">Rutin</span>
                        </div>
                    </div>

                    {{-- Rutin 3 --}}
                    <div
                        class="rounded-xl border border-stone-200 bg-white p-5 shadow-sm transition-all duration-200 hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                            <span class="rounded-md bg-[#8c6b2d]/10 px-2.5 py-1 text-xs font-bold text-[#8c6b2d]">
                                Setiap Hari
                            </span>
                            <span class="text-xs font-semibold text-gray-500">
                                Ba'da Ashar
                            </span>
                        </div>

                        <h3 class="mt-3 font-serif text-lg font-bold text-gray-900">
                            TPQ & Tahsin Remaja
                        </h3>

                        <p class="mt-1 text-xs text-gray-600 line-clamp-2">
                            Pembelajaran membaca, memperbaiki bacaan (tahsin), dan menghafal Al-Qur'an untuk anak-anak &
                            remaja.
                        </p>

                        <div
                            class="mt-4 flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-stone-50">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Tim Pengajar TPQ
                            </span>
                            <span class="font-medium text-stone-400">Rutin</span>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>
