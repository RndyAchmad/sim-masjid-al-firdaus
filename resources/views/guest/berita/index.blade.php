<x-layouts.guest>
    {{-- Header Banner Halaman Berita --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Informasi & Dokumentasi
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Kabar Masjid Al-Firdaus
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Warta kegiatan, liputan acara, dan pengumuman terbaru untuk jamaah
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header Section (Rata Tengah) --}}
            <div class="mb-10 text-center max-w-3xl mx-auto sm:mb-12">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                    Berita Terkini
                </span>
                <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                    Liputan & Pengumuman
                </h2>
                <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                    Ikuti kabar perkembangan program, dokumentasi acara, dan informasi penting lainnya.
                </p>
            </div>

            {{-- Grid Berita --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Berita 1 --}}
                <div
                    class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-[#8c6b2d] hover:shadow-xl">
                    <div class="relative aspect-video w-full overflow-hidden bg-stone-100 border-b border-stone-200">
                        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800"
                            alt="Penyaluran Santunan"
                            class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                    </div>

                    <div class="flex flex-1 flex-col justify-between p-5 sm:p-6 bg-white">
                        <div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-[#8c6b2d]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>18 Oktober 2026</span>
                            </div>

                            <h3 class="mt-2 font-serif text-lg font-bold text-gray-900 sm:text-xl line-clamp-2">
                                Penyaluran Santunan Anak Yatim dan Dhuafa Bulan Ini
                            </h3>

                            <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3">
                                DKM Masjid Al-Firdaus telah menyalurkan paket santunan dan perlengkapan sekolah kepada
                                30 anak yatim warga sekitar.
                            </p>
                        </div>

                        <div class="mt-6 border-t border-stone-100 pt-4 space-y-3">
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Oleh: <strong class="text-gray-800">Redaksi Al-Firdaus</strong></span>
                            </div>

                            <a href="#"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8c6b2d] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6e5321]">
                                Baca Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Berita 2 --}}
                <div
                    class="flex flex-col overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-[#8c6b2d] hover:shadow-xl">
                    <div class="relative aspect-video w-full overflow-hidden bg-stone-100 border-b border-stone-200">
                        <img src="https://images.unsplash.com/photo-1519817650390-64a93db51149?q=80&w=800"
                            alt="Pemasangan AC"
                            class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                    </div>

                    <div class="flex flex-1 flex-col justify-between p-5 sm:p-6 bg-white">
                        <div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-[#8c6b2d]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>12 Oktober 2026</span>
                            </div>

                            <h3 class="mt-2 font-serif text-lg font-bold text-gray-900 sm:text-xl line-clamp-2">
                                Pemeliharaan dan Servis Rutin Sound System Ruang Utama
                            </h3>

                            <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3">
                                Tim teknis telah selesai melakukan perbaikan mic wireless serta kalibrasi amplifier demi
                                kenyamanan pendengaran jamaah.
                            </p>
                        </div>

                        <div class="mt-6 border-t border-stone-100 pt-4 space-y-3">
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Oleh: <strong class="text-gray-800">Seksi Sarpras</strong></span>
                            </div>

                            <a href="#"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8c6b2d] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#6e5321]">
                                Baca Selengkapnya
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
        </div>
    </div>
</x-layouts.guest>
