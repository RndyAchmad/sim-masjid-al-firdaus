<x-layouts.admin>
    <x-slot name="title">Edit Profil</x-slot>
    <x-slot name="backUrl">{{ route('admin.dashboard') }}</x-slot>

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-7">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#c49c4d]/15 text-[#a8833e]">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.1a7.5 7.5 0 0115 0A17.9 17.9 0 0112 22.5c-2.7 0-5.25-.6-7.5-2.4z"/>
                    </svg>
                </div>

                <div class="min-w-0">
                    <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">
                        Pengaturan Profil
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Perbarui informasi akun dan keamanan password kamu.
                    </p>
                </div>
            </div>
        </div>

        {{-- Form Profil --}}
        <form
            action="{{ route('admin.account.update') }}"
            method="POST"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            {{-- Informasi Akun --}}
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4 sm:px-7">
                    <h3 class="font-bold text-gray-900">Informasi Akun</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Informasi dasar akun yang digunakan untuk masuk ke dashboard.
                    </p>
                </div>

                <div class="space-y-5 p-5 sm:p-7">

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            maxlength="255"
                            autocomplete="name"
                            class="w-full rounded-xl border px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-[#c49c4d] focus:ring-2 focus:ring-[#c49c4d]/20 @error('name') border-red-500 @else @enderror"
                            placeholder="Masukkan nama lengkap"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">
                            Alamat Email <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            maxlength="255"
                            autocomplete="email"
                            class="w-full rounded-xl border px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-[#c49c4d] focus:ring-2 focus:ring-[#c49c4d]/20 @error('email') border-red-500 @else @enderror"
                            placeholder="nama@email.com"
                        >

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Role Pengguna
                        </label>

                        @php
                            $userRole = $user->role instanceof \App\Enums\UserRole
                                ? $user->role
                                : \App\Enums\UserRole::tryFrom($user->role ?? '');
                        @endphp

                        <input
                            type="text"
                            value="{{ $userRole?->label() ?? 'Pengguna' }}"
                            disabled
                            class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-500"
                        >

                        <p class="mt-2 text-xs text-gray-500">
                            Role dikelola oleh administrator dan tidak dapat diubah melalui halaman ini.
                        </p>
                    </div>
                </div>
            </section>

            {{-- Keamanan Password --}}
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4 sm:px-7">
                    <h3 class="font-bold text-gray-900">Keamanan Password</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Kosongkan bagian password jika tidak ingin menggantinya.
                    </p>
                </div>

                <div class="space-y-5 p-5 sm:p-7">

                    {{-- Password Saat Ini --}}
                    <div>
                        <label for="current_password" class="mb-2 block text-sm font-semibold text-gray-700">
                            Password Saat Ini
                        </label>

                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            autocomplete="current-password"
                            class="w-full rounded-xl border px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-[#c49c4d] focus:ring-2 focus:ring-[#c49c4d]/20 @error('current_password') border-red-500 @else @enderror"
                            placeholder="Masukkan password saat ini"
                        >

                        @error('current_password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            minlength="8"
                            autocomplete="new-password"
                            class="w-full rounded-xl border px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-[#c49c4d] focus:ring-2 focus:ring-[#c49c4d]/20 @error('password') border-red-500 @else @enderror"
                            placeholder="Minimal 8 karakter"
                        >

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-gray-700">
                            Konfirmasi Password Baru
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            minlength="8"
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-800 outline-none transition focus:border-[#c49c4d] focus:ring-2 focus:ring-[#c49c4d]/20"
                            placeholder="Ulangi password baru"
                        >
                    </div>

                </div>
            </section>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
