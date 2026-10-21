<x-layouts.admin>
    <x-slot name="title">Tambah Pengguna Baru</x-slot>
    <x-slot name="backUrl">{{ route('admin.users.index') }}</x-slot>

    <form action="{{ route('admin.users.store') }}" method="POST"
        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-6 max-w-3xl">
        @csrf

        <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Data Akun & Hak Akses</h3>

        {{-- Nama Pengguna --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Lengkap <span
                    class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required maxlength="255" autocomplete="name"
                placeholder="Contoh: H. Syaiful Bahri, S.Ag."
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat Email --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">Alamat Email <span
                    class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="255" autocomplete="email"
                placeholder="contoh: syaiful@masjidalfirdaus.or.id" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role / Hak Akses --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Role / Hak Akses <span class="text-red-500">*</span>
            </label>

            <select name="role" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                <option value="">-- Pilih Role --</option>

                <option value="superadmin" @selected(old('role') === 'superadmin')>
                    Superadmin — Akses Penuh
                </option>

                <option value="admin" @selected(old('role') === 'admin')>
                    Admin — Kegiatan, Artikel, Jadwal Imam, dan Berita
                </option>

                <option value="bendahara" @selected(old('role') === 'bendahara')>
                    Bendahara — Laporan Keuangan dan Pembangunan
                </option>

                <option value="sekretaris" @selected(old('role') === 'sekretaris')>
                    Sekretaris — Inventaris
                </option>
            </select>

            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Grid Kata Sandi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Kata Sandi <span
                        class="text-red-500">*</span></label>
                <input type="password" id="password" name="password" minlength="8" autocomplete="new-password"
                    placeholder="Minimal 8 karakter" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Konfirmasi Kata Sandi <span
                        class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                Batal
            </a>
            <button type="submit"
                class="rounded-xl bg-[#c49c4d] px-6 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                Simpan User Baru
            </button>
        </div>
    </form>
</x-layouts.admin>