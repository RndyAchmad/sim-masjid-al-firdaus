<div>
    <!-- Backdrop Hitam Transparan untuk Mode Mobile (Muncul saat sidebar terbuka di HP) -->
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-cloak>
    </div>

    <!-- Sidebar Menu -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-gray-800 bg-[#0B0B0B] text-white transition-transform duration-300 lg:translate-x-0">

        <!-- Bagian Logo -->
        <div class="flex h-16 shrink-0 items-center justify-center border-b border-gray-800 px-4">
            <a href="/admin" class="flex items-center gap-3 transition hover:opacity-80">
                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-br from-[#c49c4d] to-[#c1a447] text-sm font-bold text-white shadow-lg shadow-[#c49c4d]/20">
                    AF
                </div>
                <h1 class="text-base font-bold tracking-wide text-white">Admin Panel</h1>
            </a>
        </div>

        <!-- Bagian Link Menu -->
        <nav class="flex-1 space-y-1 overflow-y-auto p-4 custom-scrollbar">

            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>

            <div class="my-4 border-t border-gray-800"></div>
            <p class="mb-2 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Kelola Data</p>

            <a href="{{ route('admin.profile') }}"
                class="{{ request()->routeIs('admin.profile') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Profil Masjid
            </a>

            <a href=""
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-400 transition-colors hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Kegiatan & Acara
            </a>

            <a href="{{ route('admin.articles.index') }}"
                class="{{ request()->routeIs('admin.articles.*') ? 'bg-[#c49c4d] text-white' : 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]' }} flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                </svg>
                Artikel Keislaman
            </a>

            <a href=""
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-400 transition-colors hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Laporan Keuangan
            </a>

            <div class="my-4 border-t border-gray-800"></div>

            <!-- Tombol Kembali ke Web Publik -->
            <a href="/" target="_blank"
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-400 transition-colors hover:bg-gray-800 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                Lihat Web Publik
            </a>

        </nav>
    </aside>
</div>