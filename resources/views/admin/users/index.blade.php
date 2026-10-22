<x-layouts.admin>
    <x-slot name="title">Manajemen Pengguna</x-slot>

    <div class="space-y-6">
        {{-- Header Actions & Search --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form action="{{ route('admin.users.index') }}" method="GET"
                class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">

                {{-- Input Pencarian --}}
                <div class="relative w-full sm:max-w-xs">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Filter Role --}}
                <select name="role"
                    class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto">

                    <option value="">Semua Role</option>
                    <option value="superadmin" @selected(request('role') === 'superadmin')>
                        Superadmin
                    </option>
                    <option value="admin" @selected(request('role') === 'admin')>
                        Admin
                    </option>
                    <option value="bendahara" @selected(request('role') === 'bendahara')>
                        Bendahara
                    </option>
                    <option value="sekretaris" @selected(request('role') === 'sekretaris')>
                        Sekretaris
                    </option>
                </select>

                {{-- Tombol Filter --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4h18M6 10h12m-9 6h6m-4 4h2" />
                    </svg>
                    Filter
                </button>

                {{-- Reset Filter --}}
                @if (request()->filled('search') || request()->filled('role'))
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Tombol Tambah User --}}
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs shadow-[#c49c4d]/30 transition hover:bg-[#a8833e] sm:w-auto">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Tambah Pengguna Baru
            </a>
        </div>

        {{-- Tabel Data Pengguna --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-175 text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Nama Pengguna</th>
                            <th class="px-6 py-4">Alamat Email</th>
                            <th class="px-6 py-4">Role / Hak Akses</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="transition hover:bg-gray-50/50">
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4 font-mono text-xs text-gray-700 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex rounded-full border border-gray-200 bg-gray-50 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                        {{ $user->role?->label() ?? 'Tidak diketahui' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right whitespace-nowrap">

                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="Detail pengguna {{ $user->name }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit pengguna {{ $user->name }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            data-confirm data-confirm-title="Hapus pengguna?"
                                            data-confirm="Pengguna {{ $user->name }} akan dihapus. Tindakan ini tidak dapat dibatalkan.">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="Hapus pengguna {{ $user->name }}">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data pengguna.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div
                class="flex flex-col gap-3 border-t border-gray-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                {{-- Informasi Jumlah Data --}}
                <p class="text-sm text-gray-500">
                    Menampilkan
                    <span class="font-semibold text-gray-700">
                        {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-semibold text-gray-700">
                        {{ $users->total() }}
                    </span>
                    user
                </p>

                {{-- Navigasi Halaman --}}
                <div>
                    {{ $users->links() }}
                </div>

            </div>

        </div>
    </div>
</x-layouts.admin>