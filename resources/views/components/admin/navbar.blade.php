@props(['title' => 'Dashboard', 'backUrl' => null])

@php
    $user = auth()->user();

    $name = $user?->name ?? 'Pengguna';
    $email = $user?->email ?? '-';

    $role = $user?->role instanceof \App\Enums\UserRole
        ? $user->role->label()
        : (\App\Enums\UserRole::tryFrom($user?->role ?? '')?->label() ?? 'Pengguna');

    $initials = collect(explode(' ', trim($name)))
        ->filter()
        ->take(2)
        ->map(fn($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->implode('');
@endphp

<header x-data="{ profileOpen: false }" @click.outside="profileOpen = false"
    @keydown.escape.window="profileOpen = false" class="sticky top-0 z-30 flex h-16 items-center justify-between
           border-b border-gray-200 bg-white px-4 shadow-sm
           sm:px-6 lg:px-8">
    {{-- Sisi Kiri --}}
    <div class="flex min-w-0 items-center gap-3 sm:gap-4">
        {{-- Hamburger Mobile --}}
        <button type="button" @click="sidebarOpen = !sidebarOpen" aria-label="Buka navigasi" class="shrink-0 text-gray-500 transition hover:text-[#c49c4d]
                   focus:outline-none lg:hidden">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        @if ($backUrl)
            <a href="{{ $backUrl }}" title="Kembali" class="group flex h-9 w-9 shrink-0 items-center justify-center
                               rounded-lg border border-gray-200 bg-gray-50
                               text-gray-600 transition-all hover:border-[#c49c4d]
                               hover:bg-[#c49c4d] hover:text-white">
                <svg class="h-5 w-5 transition-transform
                                    group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        @endif

        <h1 class="truncate text-lg font-bold text-gray-900 sm:text-xl">
            {{ $title }}
        </h1>
    </div>

    {{-- Sisi Kanan --}}
    <div class="flex shrink-0 items-center gap-3 sm:gap-4">
        {{-- Notifikasi --}}
        <button type="button" aria-label="Notifikasi" class="text-gray-400 transition-colors hover:text-[#c49c4d]">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>

        <div class="h-6 w-px bg-gray-200"></div>

        {{-- Trigger Profil: Desktop dan Mobile --}}
        <button type="button" @click="profileOpen = !profileOpen" :aria-expanded="profileOpen.toString()"
            aria-label="Menu profil pengguna" aria-haspopup="true" class="flex items-center gap-2 rounded-lg
                   transition hover:opacity-80 focus:outline-none
                   focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2">
            {{-- Nama dan Role Desktop --}}
            <div class="hidden text-right sm:block">
                <p class="max-w-48 truncate text-sm font-semibold text-gray-700">
                    {{ $name }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ $role }}
                </p>
            </div>

            {{-- Avatar --}}
            <span class="flex h-9 w-9 shrink-0 items-center justify-center
                       rounded-full bg-[#c49c4d] text-sm font-bold
                       text-white shadow-sm shadow-[#c49c4d]/30">
                {{ $initials ?: 'U' }}
            </span>

            {{-- Panah Dropdown --}}
            <svg class="h-4 w-4 text-gray-500 transition-transform" :class="{ 'rotate-180': profileOpen }" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
            </svg>
        </button>

        {{-- Dropdown Profil --}}
        <div x-cloak x-show="profileOpen" x-transition.origin.top.right class="absolute right-4 top-full mt-2 w-72
                   overflow-hidden rounded-xl border border-gray-200
                   bg-white shadow-lg sm:right-6 lg:right-8">
            {{-- Identitas Pengguna --}}
            <div class="border-b border-gray-100 bg-gray-50/70 px-4 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center
                               rounded-full bg-[#c49c4d] font-bold text-white">
                        {{ $initials ?: 'U' }}
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-gray-800">
                            {{ $name }}
                        </p>
                        <p class="truncate text-xs text-gray-500">
                            {{ $role }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Detail Email --}}
            <div class="px-4 py-3">
                <p class="mb-1 text-xs font-medium text-gray-500">
                    Alamat Email
                </p>

                <div class="flex items-start gap-2 text-sm text-gray-700">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>

                    <span class="break-all">{{ $email }}</span>
                </div>
            </div>
            {{-- Logout --}}
            <div class="border-t border-gray-100 p-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5
                   text-sm font-medium text-red-600
                   transition hover:bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6
                       a2.25 2.25 0 00-2.25 2.25v13.5A2.25
                       2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15
                       M18 15l3-3m0 0l-3-3m3 3H9" />
                        </svg>

                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
