<header
    class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 shadow-sm sm:px-6 lg:px-8">

    <!-- Sisi Kiri (Tombol Mobile & Judul Halaman) -->
    <div class="flex items-center gap-4">
        <!-- Tombol Hamburger Mobile -->
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 transition hover:text-[#c49c4d] focus:outline-none lg:hidden">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Judul Fitur / Halaman Dinamis -->
        <h1 class="text-lg font-bold text-gray-900 sm:text-xl">
            {{ $title }}
        </h1>
    </div>

    <!-- Sisi Kanan (Profil Admin & Logout) -->
    <div class="flex items-center gap-4">
        <!-- Notifikasi (Opsional) -->
        <button class="text-gray-400 hover:text-[#c49c4d] transition-colors">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <div class="h-6 w-px bg-gray-200"></div> <!-- Garis Pemisah -->

        <!-- Info User & Dropdown (Bisa pakai x-data baru untuk dropdown profil jika diperlukan) -->
        <div class="flex items-center gap-3">
            <div class="hidden text-right sm:block">
                <p class="text-sm font-semibold text-gray-700">Takmir Masjid</p>
                <p class="text-xs text-gray-500">Super Admin</p>
            </div>
            <div
                class="flex h-9 w-9 items-center justify-center rounded-full bg-[#c49c4d] text-sm font-bold text-white">
                TA <!-- Inisial Admin -->
            </div>
        </div>
    </div>
</header>