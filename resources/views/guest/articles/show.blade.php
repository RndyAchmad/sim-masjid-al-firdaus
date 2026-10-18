<x-layouts.guest>
    {{-- Header Banner Detail Artikel (Gelap Elegan) --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-10 sm:py-14 border-b border-gray-800">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">

            {{-- Tombol Kembali --}}
            <div class="mb-4 flex justify-center sm:mb-6">
                <a href="{{ route('articles.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-gray-700 bg-black/50 px-4 py-1.5 text-xs font-semibold text-gray-300 transition hover:border-[#d8b76a] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Artikel Keislaman
                </a>
            </div>

            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Kajian & Risalah
            </span>

            {{-- Judul Artikel --}}
            <h1
                class="mt-2 font-serif text-2xl font-bold tracking-tight text-white sm:text-3xl md:text-4xl lg:text-5xl leading-tight">
                Keutamaan Menjaga Salat Berjamaah di Masjid
            </h1>

            {{-- Metadata Artikel --}}
            <div
                class="mt-4 flex flex-wrap items-center justify-center gap-3 text-xs text-gray-400 sm:gap-6 sm:text-sm">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d8b76a]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Penulis: <strong class="text-gray-200">Ust. Ahmad Fuzairi</strong></span>
                </div>
                <span class="hidden sm:inline text-gray-600">•</span>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d8b76a]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>02 September 2026</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Warm Sand) --}}
    <div class="bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Gambar Utama (Cover Artikel) --}}
            <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-lg">
                <div class="relative aspect-video w-full overflow-hidden bg-stone-100">
                    <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=1200"
                        alt="Salat Berjamaah" class="h-full w-full object-cover">
                </div>
            </div>

            {{-- Isi Artikel --}}
            <div
                class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 sm:p-10 shadow-sm space-y-6 text-gray-700 leading-relaxed text-sm sm:text-base">

                <p class="font-medium text-gray-900 leading-relaxed">
                    Salat fardhu merupakan tiang agama bagi setiap muslim. Di antara amalan utama yang sangat dianjurkan
                    oleh Rasulullah SAW bagi kaum laki-laki adalah menegakkan salat secara berjamaah di masjid.
                </p>

                <p>
                    Keutamaan salat berjamaah amatlah besar. Rasulullah SAW bersabda dalam sebuah hadits shahih yang
                    diriwayatkan oleh Imam Bukhari dan Muslim:
                </p>

                {{-- Quote Box Hadits / Hikmah --}}
                <div
                    class="my-6 rounded-xl border-l-4 border-[#8c6b2d] bg-[#FBF9F5] p-5 italic text-gray-800 space-y-2">
                    <p class="font-serif text-base sm:text-lg text-gray-900 not-italic font-bold">
                        "Salat berjamaah lebih utama daripada salat sendirian dengan dua puluh tujuh derajat."
                    </p>
                    <p class="text-xs text-gray-500 not-italic">— HR. Bukhari no. 645 dan Muslim no. 650</p>
                </div>

                <p>
                    Selain dilipatgandakannya pahala hingga 27 kali lipat, setiap langkah kaki seorang muslim menuju
                    masjid untuk melaksanakan salat berjamaah akan dihitung sebagai kebaikan dan penghapus dosa-dosa
                    kecilnya.
                </p>

                <h3 class="font-serif text-lg sm:text-xl font-bold text-gray-900 pt-2">
                    Manfaat Sosial dan Ukhuwah Islamiyah
                </h3>

                <p>
                    Tidak hanya bernilai pahala spiritual, salat berjamaah di masjid juga menjadi sarana untuk
                    mempererat tali silaturahmi antar warga perumahan dan jamaah sekitar. Melalui pertemuan rutin lima
                    waktu di rumah Allah, rasa kepedulian, kebersamaan, dan rasa saling mengenal sesama muslim akan
                    senantiasa terjaga.
                </p>

                <p>
                    Marilah kita senantiasa memakmurkan Masjid Al-Firdaus dengan melangkahkan kaki menuju sholat
                    berjamaah serta mengajak keluarga dan putra-putri kita untuk mencintai rumah Allah SWT.
                </p>

                {{-- Bagian Bagikan (Share Buttons) --}}
                <div
                    class="mt-10 border-t border-stone-100 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                        Bagikan Artikel Ini:
                    </span>
                    <div class="flex items-center gap-3">
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                            WhatsApp
                        </a>
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">
                            Facebook
                        </a>
                    </div>
                </div>

            </div>

            {{-- Rekomendasi Artikel Lainnya --}}
            <div class="mt-12 sm:mt-16">
                <div class="mb-6 text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                        Risalah Lainnya
                    </span>
                    <h3 class="font-serif text-xl font-bold text-gray-900 sm:text-2xl">
                        Artikel Keislaman Lainnya
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    {{-- Card Rekomendasi 1 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm transition hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-[#8c6b2d]">15 Agustus 2026</span>
                            <h4 class="mt-1 font-serif text-base font-bold text-gray-900 line-clamp-2">
                                Adab Menyambut Bulan Suci Ramadan
                            </h4>
                            <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                Persiapan ruhani dan fisik sangat diperlukan agar dapat memaksimalkan ibadah saat bulan
                                suci tiba.
                            </p>
                            <a href="#"
                                class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#8c6b2d] hover:underline">
                                Baca Artikel →
                            </a>
                        </div>
                    </div>

                    {{-- Card Rekomendasi 2 --}}
                    <div
                        class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm transition hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-[#8c6b2d]">28 Juli 2026</span>
                            <h4 class="mt-1 font-serif text-base font-bold text-gray-900 line-clamp-2">
                                Manfaat Mengamalkan Al-Qur'an dalam Kehidupan Sehari-hari
                            </h4>
                            <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                Al-Qur'an bukan hanya petunjuk ibadah, tetapi juga penerang jalan hidup dan solusi
                                berbagai masalah.
                            </p>
                            <a href="#"
                                class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#8c6b2d] hover:underline">
                                Baca Artikel →
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layouts.guest>
