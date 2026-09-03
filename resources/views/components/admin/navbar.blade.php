@props(['title' => 'Dashboard', 'backUrl' => null])

<header
    class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 shadow-sm sm:px-6 lg:px-8">

    <!-- Sisi Kiri (Tombol Mobile, Back Button, & Judul Halaman) -->
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- Tombol Hamburger Mobile -->
        <button @click="sidebarOpen = !sidebarOpen"
            class="text-gray-500 transition hover:text-[#c49c4d] focus:outline-none lg:hidden">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        @if($backUrl)
            <a href="{{ $backUrl }}"
                class="group flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-gray-50 text-gray-600 transition-all hover:border-[#c49c4d] hover:bg-[#c49c4d] hover:text-white"
                title="Kembali">
                <svg class="h-5 w-5 transition-transform group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        @endif

        <!-- Judul Fitur / Halaman Dinamis -->
        <h1 class="text-lg font-bold text-gray-900 sm:text-xl">
            {{ $title }}
        </h1>
    </div>

    <!-- Sisi Kanan (Profil Admin & Logout) -->
    <div class="flex items-center gap-4">
        <button class="text-gray-400 transition-colors hover:text-[#c49c4d]">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <div class="h-6 w-px bg-gray-200"></div>

        <div class="flex items-center gap-3">
            <div class="hidden text-right sm:block">
                <p class="text-sm font-semibold text-gray-700">Takmir Masjid</p>
                <p class="text-xs text-gray-500">Super Admin</p>
            </div>
            <div
                class="flex h-9 w-9 items-center justify-center rounded-full bg-[#c49c4d] text-sm font-bold text-white shadow-sm shadow-[#c49c4d]/30">
                TA
            </div>
        </div>
    </div>
</header>