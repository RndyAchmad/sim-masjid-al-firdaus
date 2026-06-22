<nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 border-b border-gray-800 bg-black/95 backdrop-blur-md">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('beranda') }}" class="flex items-center gap-4 transition hover:opacity-80">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-linear-to-br from-[#c49c4d] to-[#c1a447] text-white font-bold shadow-lg shadow-[#c49c4d]/20">
                    AF
                </div>
                <div class="flex flex-col justify-center">
                    <h1 class="font-serif text-l font-bold leading-tight text-white">
                        Masjid Al Firdaus
                    </h1>
                    {{-- Tambahan Teks Taman Puspa Sari --}}
                    <span class="text-xs font-medium tracking-wider text-gray-400">
                        Perumahan Taman Puspa Sari
                    </span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex lg:items-center lg:gap-8">
                <a href="{{ route('beranda') }}" class="text-sm font-medium tracking-wide text-gray-300 transition-all hover:text-[#c49c4d]">
                    Beranda
                </a>
                <a href="{{ route('profile') }}" class="text-sm font-medium tracking-wide text-gray-300 transition-all hover:text-[#c49c4d]">
                    Profil
                </a>

                {{-- Kegiatan --}}
                <a href="/kegiatan" class="text-sm font-medium tracking-wide text-gray-300 transition-all hover:text-[#c49c4d]">
                    Kegiatan
                </a>

                {{-- Artikel --}}
                <a href="/artikel" class="text-sm font-medium tracking-wide text-gray-300 transition-all hover:text-[#c49c4d]">
                    Artikel
                </a>

                <a href="/laporan-keuangan" class="text-sm font-medium tracking-wide text-gray-300 transition-all hover:text-[#c49c4d]">
                    Laporan Keuangan
                </a>
                <a href="/kontak" class="text-sm font-medium tracking-wide text-gray-300 transition-all hover:text-[#c49c4d]">
                    Kontak
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="rounded-lg p-2.5 text-gray-400 transition hover:bg-gray-800 hover:text-white lg:hidden">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2" 
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2" 
         x-cloak 
         class="border-t border-gray-800 bg-[#0B0B0B] lg:hidden">

        <div class="space-y-1 px-4 py-6">
            <a href="/" class="block rounded-lg px-4 py-3 text-sm font-medium tracking-wide text-gray-300 transition hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                Beranda
            </a>
            <a href="/profil" class="block rounded-lg px-4 py-3 text-sm font-medium tracking-wide text-gray-300 transition hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                Profil
            </a>

            <a href="/kegiatan" class="block rounded-lg px-4 py-3 text-sm font-medium tracking-wide text-gray-300 transition hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                Kegiatan
            </a>

            {{-- Artikel --}}
            <a href="/artikel" class="block rounded-lg px-4 py-3 text-sm font-medium tracking-wide text-gray-300 transition hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                Artikel
            </a>

            <a href="/laporan-keuangan" class="block rounded-lg px-4 py-3 text-sm font-medium tracking-wide text-gray-300 transition hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                Laporan Keuangan
            </a>
            <a href="/kontak" class="block rounded-lg px-4 py-3 text-sm font-medium tracking-wide text-gray-300 transition hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                Kontak
            </a>
        </div>
    </div>
</nav>
