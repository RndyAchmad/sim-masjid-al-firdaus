<x-layouts.admin>
    <x-slot name="title">Detail Pengguna</x-slot>
    <x-slot name="backUrl">{{ route('admin.users.index') }}</x-slot>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri: Informasi Akun --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-5">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-900">Informasi Pengguna & Hak Akses</h3>

                    @if(($user->role ?? 'super_admin') === 'super_admin')
                        <span
                            class="inline-flex items-center rounded-full bg-purple-50 px-3 py-1 text-xs font-semibold text-purple-700 border border-purple-200">
                            Super Admin
                        </span>
                    @elseif(($user->role ?? '') === 'sekretaris')
                        <span
                            class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-200">
                            Sekretaris
                        </span>
                    @elseif(($user->role ?? '') === 'bendahara')
                        <span
                            class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 border border-emerald-200">
                            Bendahara
                        </span>
                    @else
                        <span
                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 border border-gray-200">
                            Pengurus / Admin
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">Nama Lengkap</span>
                        <p class="text-base font-bold text-gray-900 mt-1">
                            {{ $user->name ?? 'H. Syaiful Bahri, S.Ag.' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">Alamat Email</span>
                        <p class="text-sm font-semibold text-gray-800 mt-1 font-mono">
                            {{ $user->email ?? 'syaiful.bahri@masjidalfirdaus.or.id' }}
                        </p>
                    </div>
                </div>

                {{-- Deskripsi Hak Akses Role --}}
                <div class="rounded-xl bg-gray-50 p-4 border border-gray-200/80 space-y-2">
                    <span class="text-xs font-semibold uppercase text-gray-400">Cakupan Akses Sistem</span>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        @if(($user->role ?? 'super_admin') === 'super_admin')
                            Pengguna ini memiliki hak akses **Super Admin** penuh untuk mengelola pengguna, berita, jadwal
                            sholat, petugas Jumat, kegiatan, serta seluruh modul administratif portal.
                        @elseif(($user->role ?? '') === 'sekretaris')
                            Pengguna ini memiliki akses **Sekretaris** untuk menulis dan mempublikasikan Berita, Pengumuman,
                            serta Manajemen Kegiatan masjid.
                        @elseif(($user->role ?? '') === 'bendahara')
                            Pengguna ini memiliki akses **Bendahara** khusus untuk modul Keuangan & Kas Masjid.
                        @else
                            Pengguna ini memiliki akses **Pengurus Umum** untuk memperbarui data operasional harian.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Aksi --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Aksi Pengguna</h3>

                <div class="pt-2 flex flex-col gap-3">
                    <a href="{{ route('admin.users.edit', $user->id ?? 1) }}"
                        class="w-full text-center rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Edit Data Pengguna
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id ?? 1) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            Hapus Pengguna
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
