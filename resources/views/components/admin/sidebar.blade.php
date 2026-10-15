<div>
    <!-- Backdrop Hitam Transparan untuk Mode Mobile -->
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-cloak>
    </div>

    <!-- Sidebar Menu -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex h-dvh w-64 flex-col border-r border-gray-800 bg-[#0B0B0B] text-white transition-transform duration-300 lg:translate-x-0">

        <!-- Bagian Logo: Tetap di Atas -->
        <div class="flex h-16 shrink-0 items-center justify-center border-b border-gray-800 px-4">
            <a href="/admin/dashboard" class="flex items-center gap-3 transition hover:opacity-80">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-br from-[#c49c4d] to-[#c1a447] text-sm font-bold text-white shadow-lg shadow-[#c49c4d]/20">
                    AF
                </div>

                <h1 class="text-base font-bold tracking-wide text-white">
                    Admin Panel
                </h1>
            </a>
        </div>

        <!-- Area Navigasi -->
        <div class="flex min-h-0 flex-1 flex-col p-4">

            <!-- Dashboard: Tidak Ikut Scroll -->
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex shrink-0 items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>

                Dashboard
            </a>

            <div class="my-4 shrink-0 border-t border-gray-800"></div>

            <!-- Kelola Data: Hanya Bagian Ini yang Bisa Scroll -->
            <div class="min-h-0 flex-1 space-y-1 overflow-y-auto custom-scrollbar">

                <p class="mb-2 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Kelola Data
                </p>

                <!-- Profil Masjid -->
                <a href="{{ route('admin.profile') }}"
                    class="{{ request()->routeIs('admin.profile') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>

                    Profil Masjid
                </a>

                <!-- Kegiatan & Acara -->
                <a href=""
                    class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-400 transition-colors hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    Kegiatan & Acara
                </a>

                <!-- Artikel Keislaman -->
                <a href="{{ route('admin.articles.index') }}"
                    class="{{ request()->routeIs('admin.articles.*') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                    </svg>

                    Artikel Keislaman
                </a>

                <!-- Inventaris Masjid -->
                <a href="{{ route('admin.inventaris.index') }}"
                    class="{{ request()->routeIs('admin.inventaris.*') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>

                    Inventaris Masjid
                </a>

                <!-- Laporan Keuangan -->
                <a href="{{ route('admin.laporan-keuangan.index') }}"
                    class="{{ request()->routeIs('admin.laporan-keuangan.*') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Laporan Keuangan
                </a>

                <!-- Pembangunan Masjid -->
                <a href="{{ route('admin.pembangunan.index') }}"
                    class="{{ request()->routeIs('admin.pembangunan.*') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>

                    Pembangunan Masjid
                </a>

                <!-- Jadwal Imam Jumat -->
                <a href="{{ route('admin.jadwal-imam.index') }}"
                    class="{{ request()->routeIs('admin.jadwal-imam.*') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    Jadwal Imam Jumat
                </a>

            </div>

            <!-- Pembatas Menu Bawah -->
            <div class="my-4 shrink-0 border-t border-gray-800"></div>

            <!-- Lihat Web Publik: Tidak Ikut Scroll -->
            <a href="/" target="_blank"
                class="flex shrink-0 items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-400 transition-colors hover:bg-gray-800 hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>

                Lihat Web Publik
            </a>

        </div>

        <!-- Footer Sidebar: Logout Tetap di Bawah -->
        <div class="shrink-0 border-t border-gray-800/80 p-4">

            <form method="POST" action="">
                @csrf

                <button type="submit"
                    class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-red-400 transition-colors hover:bg-red-500/10 hover:text-red-300 focus:outline-none">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>

                    Keluar / Logout
                </button>
            </form>

        </div>

    </aside>
</div>
