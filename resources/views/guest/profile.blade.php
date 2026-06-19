<x-layouts.guest>
    {{-- Header Banner Halaman Profil --}}
    <div class="relative bg-linear-to-b from-black to-[#0B0B0B] py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-widest text-[#c49c4d]">Mengenal Lebih Dekat</span>
            <h1 class="mt-2 text-4xl font-bold tracking-tight text-white md:text-5xl">
                Profil Masjid Al-Firdaus
            </h1>
            <p class="mt-3 text-sm text-gray-400">Taman Puspa Sari • Kab. Sidoarjo</p>
        </div>
    </div>

    {{-- 1. Section: Pengertian / Tentang Masjid --}}
    <div class="bg-[#0B0B0B] py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:items-center">
                {{-- Deskripsi --}}
                <div class="space-y-6">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-[#c49c4d]/20 bg-[#c49c4d]/10 px-3 py-1 text-xs font-medium text-[#c49c4d]">
                        Sejarah & Pengertian
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Pusat Ibadah, Dakwah, dan Ukhuwah Jamaah
                    </h2>
                    <p class="leading-relaxed text-gray-300">
                        <strong>Masjid Al-Firdaus Taman Puspa Sari</strong> bukan sekadar tempat sujud ritual semata,
                        melainkan pusat peradaban dan pembinaan umat Islam di lingkungan sekitar. Didirikan dengan
                        semangat gotong royong warga, masjid ini hadir untuk memfasilitasi kebutuhan ibadah harian
                        jamaah sekaligus menjadi wadah sosial keagamaan.
                    </p>
                    <p class="leading-relaxed text-gray-300">
                        Nama <em>Al-Firdaus</em> diambil dengan harapan tinggi agar masjid ini dapat menjadi wasilah
                        (perantara) bagi para jamaahnya menuju surga tertinggi Allah SWT melalui peningkatan ketakwaan,
                        pemahaman ilmu agama yang lurus, serta jalinan transparansi dan keterbukaan dalam pengelolaan
                        kegiatan operasional masjid.
                    </p>
                </div>

                {{-- Visual Box / Gambar Masjid --}}
                <div class="relative overflow-hidden rounded-2xl border border-gray-800 bg-[#121212] p-2 shadow-2xl">
                    <div
                        class="aspect-video w-full rounded-xl bg-gray-900 flex items-center justify-center border border-gray-800">
                        {{-- Kamu bisa mengganti tag ini dengan <img> jika sudah ada foto masjid asli --}}
                        <div class="text-center p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-[#c49c4d]/50"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="mt-4 block text-sm font-medium text-gray-400">[ Foto Dokumentasi Masjid
                                Al-Firdaus ]</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Section: Visi & Misi --}}
    <div class="border-t border-gray-900 bg-black py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-[#c49c4d]/20 bg-[#c49c4d]/10 px-3 py-1 text-xs font-medium text-[#c49c4d] mb-4">
                    Arah & Tujuan
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Visi & Misi Masjid</h2>
                <p class="mt-3 text-gray-400">Landasan utama kami dalam bergerak melayani jamaah dan memakmurkan rumah
                    Allah.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                {{-- Box Visi --}}
                <div
                    class="rounded-2xl border border-gray-800 bg-[#0B0B0B] p-8 transition-all hover:border-[#c49c4d]/30">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#c49c4d]/10 text-[#c49c4d] mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Visi</h3>
                    <p class="leading-relaxed text-gray-300 text-lg italic">
                        "Terwujudnya Masjid Al-Firdaus yang makmur, mandiri, unggul sebagai pusat ibadah, edukasi dakwah
                        Islam, serta pelopor transparansi ummat yang berlandaskan Al-Qur'an dan As-Sunnah."
                    </p>
                </div>

                {{-- Box Misi --}}
                <div
                    class="rounded-2xl border border-gray-800 bg-[#0B0B0B] p-8 transition-all hover:border-[#c49c4d]/30">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#c49c4d]/10 text-[#c49c4d] mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Misi</h3>
                    <ul class="space-y-4 text-gray-300">
                        <li class="flex items-start gap-3">
                            <span
                                class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#c49c4d]/20 text-xs font-bold text-[#c49c4d] mt-1">1</span>
                            <span>Menyelenggarakan ibadah sholat fardhu, jumat, dan hari raya secara tertib, nyaman, dan
                                khusyuk.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#c49c4d]/20 text-xs font-bold text-[#c49c4d] mt-1">2</span>
                            <span>Mengadakan kajian keislaman berkala yang inklusif demi meningkatkan wawasan dan
                                ukhuwah islamiyah warga.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#c49c4d]/20 text-xs font-bold text-[#c49c4d] mt-1">3</span>
                            <span>Mengelola keuangan infak, sedekah, dan wakaf umat secara profesional, jujur, dan 100%
                                transparan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Section: Struktur Pengurus --}}
    <div class="border-t border-gray-900 bg-[#0B0B0B] py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-[#c49c4d]/20 bg-[#c49c4d]/10 px-3 py-1 text-xs font-medium text-[#c49c4d] mb-4">
                    Susunan DKM
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Struktur Pengurus Masjid</h2>
                <p class="mt-3 text-gray-400">Amanah pengurus dalam melayani operasional dan administrasi Masjid
                    Al-Firdaus.</p>
            </div>

            {{-- Grid Kepengurusan --}}
            <div class="space-y-12">
                {{-- Top Management (Ketua) --}}
                <div class="flex justify-center">
                    <div
                        class="w-full max-w-xs text-center rounded-2xl border border-[#c49c4d]/30 bg-black p-6 shadow-xl shadow-black/40">
                        <div
                            class="mx-auto h-20 w-20 rounded-full border-2 border-[#c49c4d] bg-gray-900 flex items-center justify-center text-xl font-bold text-white">
                            K
                        </div>
                        <h4 class="mt-4 text-lg font-bold text-white">[ Nama Ketua DKM ]</h4>
                        <p class="text-xs font-semibold uppercase tracking-widest text-[#c49c4d] mt-1">Ketua Takmir</p>
                    </div>
                </div>

                {{-- Core Management (Wakil, Sekretaris, Bendahara) --}}
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto">
                    {{-- Wakil Ketua --}}
                    <div class="text-center rounded-xl border border-gray-800 bg-[#121212] p-5">
                        <div
                            class="mx-auto h-16 w-16 rounded-full bg-gray-800 flex items-center justify-center text-lg font-bold text-white">
                            W
                        </div>
                        <h4 class="mt-3 text-base font-bold text-white">[ Nama Wakil Ketua ]</h4>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d] mt-1">Wakil Ketua</p>
                    </div>

                    {{-- Sekretaris --}}
                    <div class="text-center rounded-xl border border-gray-800 bg-[#121212] p-5">
                        <div
                            class="mx-auto h-16 w-16 rounded-full bg-gray-800 flex items-center justify-center text-lg font-bold text-white">
                            S
                        </div>
                        <h4 class="mt-3 text-base font-bold text-white">[ Nama Sekretaris ]</h4>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d] mt-1">Sekretaris</p>
                    </div>

                    {{-- Bendahara --}}
                    <div class="text-center rounded-xl border border-gray-800 bg-[#121212] p-5">
                        <div
                            class="mx-auto h-16 w-16 rounded-full bg-gray-800 flex items-center justify-center text-lg font-bold text-white">
                            B
                        </div>
                        <h4 class="mt-3 text-base font-bold text-white">[ Nama Bendahara ]</h4>
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d] mt-1">Bendahara</p>
                    </div>
                </div>

                {{-- Bidang-Bidang / Divisi --}}
                <div class="border-t border-gray-900 pt-10">
                    <h3 class="text-center text-sm font-semibold uppercase tracking-widest text-gray-400 mb-6">Divisi &
                        Bidang Kerja</h3>
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                        <div class="rounded-lg border border-gray-800 bg-[#121212]/50 p-4 text-center">
                            <span class="block text-sm font-bold text-white">[ Nama Pengurus ]</span>
                            <span
                                class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mt-1 block">Seksi
                                Imarah (Ibadah & Kajian)</span>
                        </div>
                        <div class="rounded-lg border border-gray-800 bg-[#121212]/50 p-4 text-center">
                            <span class="block text-sm font-bold text-white">[ Nama Pengurus ]</span>
                            <span
                                class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mt-1 block">Seksi
                                Pembangunan & Sarpras</span>
                        </div>
                        <div class="rounded-lg border border-gray-800 bg-[#121212]/50 p-4 text-center">
                            <span class="block text-sm font-bold text-white">[ Nama Pengurus ]</span>
                            <span
                                class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mt-1 block">Seksi
                                Sosial & Ziswaf</span>
                        </div>
                        <div class="rounded-lg border border-gray-800 bg-[#121212]/50 p-4 text-center">
                            <span class="block text-sm font-bold text-white">[ Nama Pengurus ]</span>
                            <span
                                class="text-[11px] font-medium text-gray-400 uppercase tracking-wider mt-1 block">Seksi
                                Humas & Pemuda</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
