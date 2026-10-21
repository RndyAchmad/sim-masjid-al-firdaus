<x-layouts.admin>
    <x-slot name="title">Detail Pengguna</x-slot>
    <x-slot name="backUrl">{{ route('admin.users.index') }}</x-slot>

    @php
        $role = $user->role instanceof \App\Enums\UserRole
            ? $user->role
            : \App\Enums\UserRole::tryFrom($user->role ?? '');

        $roleStyles = match ($role) {
            \App\Enums\UserRole::Superadmin =>
                'bg-purple-50 text-purple-700 border-purple-200',
            \App\Enums\UserRole::Admin =>
                'bg-gray-100 text-gray-700 border-gray-200',
            \App\Enums\UserRole::Bendahara =>
                'bg-emerald-50 text-emerald-700 border-emerald-200',
            \App\Enums\UserRole::Sekretaris =>
                'bg-blue-50 text-blue-700 border-blue-200',
            default => 'bg-gray-50 text-gray-500 border-gray-200',
        };

        $roleDescription = match ($role) {
            \App\Enums\UserRole::Superadmin =>
                'Memiliki hak akses penuh sesuai kebijakan sistem, termasuk pengelolaan pengguna dan seluruh modul administratif yang diizinkan.',
            \App\Enums\UserRole::Admin =>
                'Mengelola kegiatan, artikel, jadwal imam, berita, dan modul operasional lain sesuai hak akses yang diberikan.',
            \App\Enums\UserRole::Bendahara =>
                'Mengelola modul laporan keuangan dan pembangunan sesuai hak akses bendahara.',
            \App\Enums\UserRole::Sekretaris =>
                'Mengelola inventaris sesuai hak akses sekretaris.',
            default => 'Hak akses pengguna belum dapat dikenali.',
        };
    @endphp

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri: Informasi Akun --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">

                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-900">
                        Informasi Pengguna & Hak Akses
                    </h3>

                    <span
                        class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $roleStyles }}">
                        {{ $role?->label() ?? 'Tidak diketahui' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Nama Lengkap
                        </span>
                        <p class="mt-1 wrap-break-word text-base font-bold text-gray-900">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">
                            Alamat Email
                        </span>
                        <p class="mt-1 break-all font-mono text-sm font-semibold text-gray-800">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>

                {{-- Deskripsi Hak Akses --}}
                <div class="space-y-2 rounded-xl border border-gray-200/80 bg-gray-50 p-4">
                    <span class="text-xs font-semibold uppercase text-gray-400">
                        Cakupan Akses Sistem
                    </span>

                    <p class="text-sm leading-relaxed text-gray-600">
                        {{ $roleDescription }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Aksi --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Aksi Pengguna
                </h3>

                <div class="flex flex-col gap-3 pt-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-center text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Edit Data Pengguna
                    </a>

                    @if (!auth()->user()->is($user))
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" data-confirm
                            data-confirm-title="Hapus pengguna?"
                            data-confirm="Akun {{ $user->name }} akan dihapus. Tindakan ini tidak dapat dibatalkan.">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-full rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                                Hapus Pengguna
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('admin.users.index') }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
