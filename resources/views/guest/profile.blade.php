<x-layouts.guest>
    {{-- Header Banner Halaman Profil (Tetap Gelap Elegan) --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Mengenal Lebih Dekat
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Profil Masjid Al-Firdaus
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Taman Puspa Sari - Kab. Sidoarjo
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- 1. Section: Pengertian / Tentang Masjid --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12 lg:items-center">

                {{-- Flex Container untuk Teks & Judul --}}
                <div class="flex flex-col space-y-4 sm:space-y-6">
                    {{-- Badge Label (Warna Gelap Elegan) & Judul Utama --}}
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321]">
                            Sejarah & Pengertian
                        </span>
                        <h2
                            class="mt-3 font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                            Pusat Ibadah, Dakwah, dan Ukhuwah Jamaah
                        </h2>
                    </div>

                    {{-- GAMBAR KHUSUS MOBILE (Tampil hanya di Mobile/Tablet) --}}
                    <div class="block lg:hidden my-2">
                        <div
                            class="relative overflow-hidden rounded-2xl border border-stone-200 bg-white p-2 sm:p-3 shadow-xl shadow-stone-200/60">
                            <div
                                class="aspect-video w-full overflow-hidden rounded-xl bg-stone-100 border border-stone-200 flex items-center justify-center">
                                @if(isset($profil->foto_masjid) && $profil->foto_masjid)
                                    <img src="{{ asset('storage/' . $profil->foto_masjid) }}" alt="Foto Masjid Al-Firdaus"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="text-center p-4 sm:p-6">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="mx-auto h-10 w-10 text-[#a8833e] sm:h-12 sm:w-12" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="mt-3 block text-xs font-medium text-gray-500 sm:mt-4 sm:text-sm">[ Foto
                                            Dokumentasi Masjid Al-Firdaus ]</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Paragraf Penjelasan --}}
                    <p class="text-sm leading-relaxed text-gray-700 sm:text-base">
                        <strong class="text-gray-900">Masjid Al-Firdaus Taman Puspa Sari</strong> bukan sekadar tempat
                        sujud ritual semata,
                        melainkan pusat peradaban dan pembinaan umat Islam di lingkungan sekitar. Didirikan dengan
                        semangat gotong royong warga, masjid ini hadir untuk memfasilitasi kebutuhan ibadah harian
                        jamaah sekaligus menjadi wadah sosial keagamaan.
                    </p>
                    <p class="text-sm leading-relaxed text-gray-700 sm:text-base">
                        Nama <em class="text-[#8c6b2d] font-semibold not-italic">Al-Firdaus</em> diambil dengan harapan
                        tinggi agar masjid ini dapat menjadi wasilah
                        (perantara) bagi para jamaahnya menuju surga tertinggi Allah SWT melalui peningkatan ketakwaan,
                        pemahaman ilmu agama yang lurus, serta jalinan transparansi dan keterbukaan dalam pengelolaan
                        kegiatan operasional masjid.
                    </p>
                </div>

                {{-- GAMBAR KHUSUS DESKTOP (Tampil Sejajar Kanan di Laptop/Desktop) --}}
                <div
                    class="hidden lg:block relative overflow-hidden rounded-2xl border border-stone-200 bg-white p-3 shadow-xl shadow-stone-200/60">
                    <div
                        class="aspect-video w-full overflow-hidden rounded-xl bg-stone-100 border border-stone-200 flex items-center justify-center">
                        @if(isset($profil->foto_masjid) && $profil->foto_masjid)
                            <img src="{{ asset('storage/' . $profil->foto_masjid) }}" alt="Foto Masjid Al-Firdaus"
                                class="h-full w-full object-cover">
                        @else
                            <div class="text-center p-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-[#a8833e]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="mt-4 block text-sm font-medium text-gray-500">[ Foto Dokumentasi Masjid
                                    Al-Firdaus ]</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- 2. Section: Visi & Misi --}}
    <div class="border-t border-stone-200/80 bg-[#F3F0EA] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 lg:mb-16">
                {{-- Badge Label (Warna Gelap Elegan) --}}
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3 sm:mb-4">
                    Arah & Tujuan
                </span>
                <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">Visi &
                    Misi Masjid</h2>
                <p class="mt-2 text-xs text-gray-600 sm:mt-3 sm:text-sm md:text-base">Landasan utama kami dalam bergerak
                    melayani jamaah dan memakmurkan rumah Allah.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
                {{-- Box Visi --}}
                <div
                    class="rounded-2xl border border-stone-200/90 bg-white p-6 sm:p-8 shadow-md transition-all duration-300 hover:border-[#8c6b2d] hover:shadow-xl">
                    <div
                        class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-xl bg-[#8c6b2d]/15 text-[#8c6b2d] mb-5 sm:mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 font-serif text-xl sm:text-2xl font-bold text-gray-900">Visi</h3>
                    <p class="leading-relaxed text-gray-700 text-base sm:text-lg italic">
                        "Terwujudnya Masjid Al-Firdaus yang makmur, mandiri, unggul sebagai pusat ibadah, edukasi dakwah
                        Islam, serta pelopor transparansi ummat yang berlandaskan Al-Qur'an dan As-Sunnah."
                    </p>
                </div>

                {{-- Box Misi --}}
                <div
                    class="rounded-2xl border border-stone-200/90 bg-white p-6 sm:p-8 shadow-md transition-all duration-300 hover:border-[#8c6b2d] hover:shadow-xl">
                    <div
                        class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-xl bg-[#8c6b2d]/15 text-[#8c6b2d] mb-5 sm:mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="mb-3 font-serif text-xl sm:text-2xl font-bold text-gray-900">Misi</h3>
                    <ul class="space-y-3 sm:space-y-4 text-xs sm:text-sm md:text-base text-gray-700">
                        <li class="flex items-start gap-3">
                            <span
                                class="flex h-5 w-5 sm:h-6 sm:w-6 shrink-0 items-center justify-center rounded-full bg-[#8c6b2d] text-xs font-bold text-white shadow-xs mt-0.5">1</span>
                            <span>Menyelenggarakan ibadah sholat fardhu, jumat, dan hari raya secara tertib, nyaman, dan
                                khusyuk.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="flex h-5 w-5 sm:h-6 sm:w-6 shrink-0 items-center justify-center rounded-full bg-[#8c6b2d] text-xs font-bold text-white shadow-xs mt-0.5">2</span>
                            <span>Mengadakan kajian keislaman berkala yang inklusif demi meningkatkan wawasan dan
                                ukhuwah islamiyah warga.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="flex h-5 w-5 sm:h-6 sm:w-6 shrink-0 items-center justify-center rounded-full bg-[#8c6b2d] text-xs font-bold text-white shadow-xs mt-0.5">3</span>
                            <span>Mengelola keuangan infak, sedekah, dan wakaf umat secara profesional, jujur, dan 100%
                                transparan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Section: Bagan Struktur Pengurus --}}
    <div class="border-t border-stone-200/80 bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12 lg:mb-16">
                {{-- Badge Label (Warna Gelap Elegan) --}}
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3 sm:mb-4">
                    Susunan DKM
                </span>
                <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">Struktur
                    Pengurus Masjid</h2>
                <p class="mt-2 text-xs text-gray-600 sm:mt-3 sm:text-sm md:text-base">
                    Bagan kepengurusan dan tata kelola DKM Masjid Al-Firdaus.
                </p>
            </div>

            {{-- Container Gambar Bagan Struktur Organisasi --}}
            <div class="mx-auto max-w-5xl">
                <div
                    class="relative overflow-hidden rounded-2xl border border-stone-200 bg-white p-2 sm:p-4 shadow-xl shadow-stone-200/80">
                    <div
                        class="relative w-full overflow-hidden rounded-xl bg-stone-50 border border-stone-200 flex items-center justify-center min-h-62.5 sm:min-h-100 lg:min-h-125">
                        @if(isset($profil->gambar_struktur) && $profil->gambar_struktur)
                            <img src="{{ asset('storage/' . $profil->gambar_struktur) }}"
                                alt="Bagan Struktur Organisasi Masjid Al-Firdaus"
                                class="h-auto w-full object-contain max-h-200">
                        @else
                            <div class="text-center p-6 sm:p-10">
                                <div
                                    class="mx-auto flex h-16 w-16 sm:h-20 sm:w-20 items-center justify-center rounded-full bg-[#8c6b2d]/10 text-[#8c6b2d] mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-800 sm:text-lg">Bagan Struktur Organisasi</h3>
                                <p class="mt-1 text-xs text-gray-500 sm:text-sm max-w-md mx-auto">
                                    [ Upload foto bagan struktur organisasi dari Admin Panel ]
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.guest>
