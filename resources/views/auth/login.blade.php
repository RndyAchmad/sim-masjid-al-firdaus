<x-layouts.auth>
    <x-slot name="title">Login Panel Admin</x-slot>

    {{-- Header Logo / Judul --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <!-- Anda bisa mengganti SVG ini dengan tag <img> logo masjid jika ada -->
        <svg class="mx-auto h-12 w-12 text-[#c49c4d]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 21v-4m22 4v-4M5 21V5a2 2 0 012-2h14a2 2 0 012 2v16M9 21v-4m6 4v-4M9 8h6m-6 4h6m-6 4h6" />
        </svg>
        <h2 class="mt-4 text-3xl font-bold tracking-tight text-gray-900">
            SIM Masjid Al-Firdaus
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Silakan masuk untuk mengakses panel admin.
        </p>
    </div>

    {{-- Form Container --}}
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-sm border border-gray-100 sm:rounded-2xl sm:px-10">

            <form class="space-y-6" action="{{ route('login.authenticate') }}" method="POST">
                @csrf

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-900 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] transition-colors"
                            placeholder="admin@al-firdaus.com">
                    </div>
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Kata Sandi</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-900 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-[#c49c4d] focus:ring-[#c49c4d]">
                        <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-600">Ingat saya</label>
                    </div>

                    <div class="text-sm leading-6">
                        <a href="#" class="font-medium text-[#c49c4d] hover:text-[#a8833e]">Lupa sandi?</a>
                    </div>
                </div>

                {{-- Tombol Login --}}
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-xl bg-[#c49c4d] px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#a8833e] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#c49c4d] transition-all">
                        Masuk
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.auth>