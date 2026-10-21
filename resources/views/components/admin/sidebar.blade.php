@php
    $user = auth()->user();

    $role = $user?->role instanceof \App\Enums\UserRole
        ? $user->role->value
        : $user?->role;

    $isSuperadmin = $role === 'superadmin';
    $isAdmin = in_array($role, ['superadmin', 'admin']);
    $isSekretaris = in_array($role, ['superadmin', 'sekretaris']);
    $isBendahara = in_array($role, ['superadmin', 'bendahara']);

    $activeClass = 'bg-[#c49c4d] text-white';
    $inactiveClass = 'text-gray-400 hover:bg-[#c49c4d]/10 hover:text-[#c49c4d]';
    $menuClass = 'flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors';
@endphp

<div>
    {{-- Backdrop Mobile --}}
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-cloak>
    </div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex h-dvh w-64 flex-col border-r border-gray-800 bg-[#0B0B0B] text-white transition-transform duration-300 lg:translate-x-0">

        {{-- Logo --}}
        <div class="flex h-16 shrink-0 items-center justify-center border-b border-gray-800 px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 transition hover:opacity-80">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-br from-[#c49c4d] to-[#c1a447] text-sm font-bold text-white shadow-lg shadow-[#c49c4d]/20">
                    AF
                </div>

                <h1 class="text-base font-bold tracking-wide text-white">
                    Admin Panel
                </h1>
            </a>
        </div>

        {{-- Navigasi --}}
        <div class="flex min-h-0 flex-1 flex-col p-4">

            {{-- Dashboard: Semua Role --}}
            <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false"
                class="{{ request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass }} {{ $menuClass }} shrink-0">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>

                Dashboard
            </a>

            <div class="my-4 shrink-0 border-t border-gray-800"></div>

            {{-- Menu yang Dapat Di-scroll --}}
            <div class="min-h-0 flex-1 space-y-1 overflow-y-auto custom-scrollbar">

                <p class="mb-2 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Kelola Data
                </p>

                {{-- Profil Masjid: Superadmin, Admin, Sekretaris --}}
                @if ($isAdmin || $role === 'sekretaris')
                    <a href="{{ route('admin.profile') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.profile') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>

                        Profil Masjid
                    </a>
                @endif

                {{-- Kegiatan & Acara: Superadmin, Admin --}}
                @if ($isAdmin)
                    <a href="{{ route('admin.kegiatan.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.kegiatan.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                        Kegiatan & Acara
                    </a>

                    {{-- Berita & Pengumuman --}}
                    <a href="{{ route('admin.berita.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.berita.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13V7m0 13a2 2 0 002-2V9.5A2.5 2.5 0 0017.5 7H15" />
                        </svg>

                        Berita & Pengumuman
                    </a>

                    {{-- Artikel Keislaman --}}
                    <a href="{{ route('admin.articles.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.articles.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13V7m0 13a2 2 0 002-2V9.5A2.5 2.5 0 0017.5 7H15" />
                        </svg>

                        Artikel Keislaman
                    </a>

                    {{-- Jadwal Imam Jumat --}}
                    <a href="{{ route('admin.jadwal-imam.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.jadwal-imam.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                        Jadwal Imam Jumat
                    </a>
                @endif

                {{-- Inventaris: Superadmin, Sekretaris --}}
                @if ($isSekretaris)
                    <a href="{{ route('admin.inventaris.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.inventaris.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>

                        Inventaris Masjid
                    </a>
                @endif

                {{-- Laporan Keuangan: Superadmin, Bendahara --}}
                @if ($isBendahara)
                    <a href="{{ route('admin.laporan-keuangan.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.laporan-keuangan.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        Laporan Keuangan
                    </a>

                    {{-- Pembangunan: Superadmin, Bendahara --}}
                    <a href="{{ route('admin.pembangunan.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.pembangunan.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Pembangunan Masjid
                    </a>
                @endif

                {{-- Manajemen Pengguna: Superadmin --}}
                @if ($isSuperadmin)
                    <a href="{{ route('admin.users.index') }}" @click="sidebarOpen = false"
                        class="{{ request()->routeIs('admin.users.*') ? $activeClass : $inactiveClass }} {{ $menuClass }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>

                        Manajemen Pengguna
                    </a>
                @endif

            </div>

            {{-- Pembatas Menu Bawah --}}
            <div class="my-4 shrink-0 border-t border-gray-800"></div>

            {{-- Web Publik --}}
            <a href="/" target="_blank" rel="noopener noreferrer"
                class="flex shrink-0 items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-400 transition-colors hover:bg-gray-800 hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>

                Lihat Web Publik
            </a>
        </div>

        {{-- Footer: Logout --}}
        <div class="shrink-0 border-t border-gray-800/80 p-4">
            <form class="logoutForm" method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="button"
                    class="logoutButton flex w-full items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-red-400 transition-colors hover:bg-red-500/10 hover:text-red-300 focus:outline-none">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24"
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
