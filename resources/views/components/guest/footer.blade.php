<footer class="border-t border-gray-800 bg-[#0B0B0B] pt-16 pb-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-4">

            {{-- Kolom 1: Logo & Deskripsi --}}
            <div class="space-y-6 lg:col-span-1">
                <a href="/" class="flex items-center gap-4 transition hover:opacity-80">
                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br from-[#c49c4d] to-[#c1a447] text-white font-bold shadow-lg shadow-[#c49c4d]/20">
                        AF
                    </div>
                    <div>
                        <h2 class="text-lg font-bold tracking-wide text-white">
                            Masjid Al Firdaus
                        </h2>
                    </div>
                </a>
                <p class="text-sm leading-relaxed text-gray-400">
                    Sistem Informasi Masjid Al-Firdaus. Menjadi pusat ibadah, informasi, dan transparansi kegiatan
                    serta laporan keuangan jamaah.
                </p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h3 class="mb-6 text-sm font-semibold tracking-wider text-white uppercase">Tautan Cepat</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('beranda') }}" class="text-sm text-gray-400 transition hover:text-[#c49c4d]">Beranda</a></li>
                    <li><a href="{{ route('profile') }}" class="text-sm text-gray-400 transition hover:text-[#c49c4d]">Profil Kami</a>
                    </li>
                    <li><a href="/kegiatan" class="text-sm text-gray-400 transition hover:text-[#c49c4d]">
                            Kegiatan</a></li>
                    <li><a href="/artikel" class="text-sm text-gray-400 transition hover:text-[#c49c4d]">
                            Artikel</a></li>
                    <li><a href="/laporan-keuangan"
                            class="text-sm text-gray-400 transition hover:text-[#c49c4d]">Laporan Keuangan</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Hubungi Kami --}}
            <div>
                <h3 class="mb-6 text-sm font-semibold tracking-wider text-white uppercase">Hubungi Kami</h3>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-[#c49c4d]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Taman Puspa Sari, Candi, Sidoarjo, Jawa Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-[#c49c4d]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:info@masjidalfirdaus.com"
                            class="transition hover:text-[#c49c4d]">info@masjidalfirdaus.com</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-[#c49c4d]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="transition hover:text-[#c49c4d]">+62 812-3456-7890</a>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4: Media Sosial --}}
            <div>
                <h3 class="mb-6 text-sm font-semibold tracking-wider text-white uppercase">Ikuti Kami</h3>
                <p class="mb-4 text-sm text-gray-400">Dapatkan update terbaru seputar kajian dan kegiatan kami di media
                    sosial.</p>
                <div class="flex gap-4">
                    {{-- Instagram --}}
                    <a href="#" aria-label="Instagram"
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-900 text-gray-400 transition hover:bg-[#c49c4d] hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    {{-- YouTube --}}
                    <a href="#" aria-label="YouTube"
                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-900 text-gray-400 transition hover:bg-[#c49c4d] hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- Baris Hak Cipta --}}
        <div class="mt-12 border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500">
                &copy; {{ now()->year }} Masjid Al-Firdaus. All rights reserved.
            </p>
            <div class="flex gap-4 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-300">Kebijakan Privasi</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-gray-300">Syarat & Ketentuan</a>
            </div>
        </div>

    </div>
</footer>
