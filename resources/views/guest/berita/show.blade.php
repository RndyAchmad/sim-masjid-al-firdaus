<x-layouts.guest>
    {{-- Header Banner Halaman Detail (Tetap Gelap Elegan) --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-10 sm:py-14 border-b border-gray-800">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            {{-- Tombol Kembali --}}
            <div class="mb-4 flex justify-center sm:mb-6">
                <a href="{{ route('berita.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-gray-700 bg-black/50 px-4 py-1.5 text-xs font-semibold text-gray-300 transition hover:border-[#d8b76a] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Berita
                </a>
            </div>

            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Kabar & Liputan Masjid
            </span>

            {{-- Judul Berita --}}
            <h1
                class="mt-2 font-serif text-2xl font-bold tracking-tight text-white sm:text-3xl md:text-4xl lg:text-5xl leading-tight">
                Penyaluran Santunan Anak Yatim dan Dhuafa Bulan Ini
            </h1>

            {{-- Metadata Berita --}}
            <div
                class="mt-4 flex flex-wrap items-center justify-center gap-3 text-xs text-gray-400 sm:gap-6 sm:text-sm">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d8b76a]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Oleh: <strong class="text-gray-200">Redaksi Al-Firdaus</strong></span>
                </div>
                <span class="hidden sm:inline text-gray-600">•</span>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d8b76a]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>18 Oktober 2026</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Article (Background Krem Warm Sand) --}}
    <div class="bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Gambar Utama (Featured Image) --}}
            <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-lg">
                <div class="relative aspect-video w-full overflow-hidden bg-stone-100">
                    <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1200"
                        alt="Penyaluran Santunan Anak Yatim" class="h-full w-full object-cover">
                </div>
            </div>

            {{-- Isi Artikel / Konten Berita --}}
            <div
                class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 sm:p-10 shadow-sm space-y-6 text-gray-700 leading-relaxed text-sm sm:text-base">

                <p class="font-medium text-gray-900 leading-relaxed">
                    <strong>Taman Puspa Sari, Sidoarjo</strong> — Pengurus DKM Masjid Al-Firdaus kembali menyalurkan
                    program kepedulian sosial berupa santunan dan bantuan perlengkapan sekolah bagi anak-anak yatim
                    serta keluarga dhuafa di lingkungan Perumahan Taman Puspa Sari dan sekitarnya pada Ahad (18/10).
                </p>

                <p>
                    Kegiatan yang berlangsung ba'da sholat Ashar ini diawali dengan pembacaan doa bersama dan nasihat
                    singkat oleh Ketua Takmir Masjid Al-Firdaus. Sebanyak 30 anak penerima manfaat hadir menerima paket
                    santunan tunai beserta perlengkapan alat tulis sekolah.
                </p>

                <div class="my-6 rounded-xl border-l-4 border-[#8c6b2d] bg-[#FBF9F5] p-4 italic text-gray-800">
                    "Alhamdulillah, berkat konsistensi infak dan sedekah dari para jamaah, program santunan ini dapat
                    berjalan rutin setiap bulannya. Semoga bantuan ini membawa keberkahan dan meringankan kebutuhan
                    pendidikan anak-anak kita," ujar perwakilan Pengurus DKM.
                </div>

                <p>
                    Sumber dana kegiatan ini berasal dari alokasi khusus Kas Sosial DKM serta donasi langsung para
                    donatur yang disalurkan melalui rekening khusus sosial masjid. Pengurus menguraikan transparansi
                    bahwa seluruh dana terpeta dan tersalurkan tepat sasaran.
                </p>

                <p>
                    DKM Masjid Al-Firdaus mengucapkan jazakumullah khairan katsiran kepada seluruh jamaah dan donatur
                    yang senantiasa mendukung program-program kepedulian umat ini.
                </p>

                {{-- Bagian Bagikan (Share Buttons) --}}
                <div
                    class="mt-10 border-t border-stone-100 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                        Bagikan Kabar Ini:
                    </span>
                    <div class="flex items-center gap-3">
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                            WhatsApp
                        </a>
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">
                            Facebook
                        </a>
                    </div>
                </div>

            </div>

            {{-- Rekomendasi Berita Lainnya --}}
            <div class="mt-12 sm:mt-16">
                <div class="mb-6 text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                        Informasi Lainnya
                    </span>
                    <h3 class="font-serif text-xl font-bold text-gray-900 sm:text-2xl">
                        Kabar Masjid Lainnya
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    {{-- Card Rekomendasi 1 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm transition hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-[#8c6b2d]">12 Oktober 2026</span>
                            <h4 class="mt-1 font-serif text-base font-bold text-gray-900 line-clamp-2">
                                Pemeliharaan dan Servis Rutin Sound System Ruang Utama
                            </h4>
                            <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                Perbaikan mic wireless dan pemeliharaan kualitas suara speaker untuk kenyamanan ibadah
                                jamaah.
                            </p>
                            <a href="#"
                                class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#8c6b2d] hover:underline">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>

                    {{-- Card Rekomendasi 2 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-md transition hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-[#8c6b2d]">05 Oktober 2026</span>
                            <h4 class="mt-1 font-serif text-base font-bold text-gray-900 line-clamp-2">
                                Kerja Bakti Pembersihan Area Serambi dan Wudhu Masjid
                            </h4>
                            <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                Gotong royong warga dan remaja masjid dalam menjaga kebersihan fasilitas wudhu dan
                                serambi.
                            </p>
                            <a href="#"
                                class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#8c6b2d] hover:underline">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layouts.guest>
