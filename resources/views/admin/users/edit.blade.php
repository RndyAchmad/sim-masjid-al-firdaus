<x-layouts.admin>
    <x-slot name="title">Edit Pengguna</x-slot>
    <x-slot name="backUrl">{{ route('admin.users.index') }}</x-slot>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-6 max-w-3xl">
        @csrf
        @method('PUT')

        <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Perbarui Data Akun</h3>

        {{-- Nama Pengguna --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Lengkap <span
                    class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alamat Email --}}
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">Alamat Email <span
                    class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                maxlength="255"
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role / Hak Akses --}}
        @php
            $currentRole = old(
                'role',
                $user->role instanceof \App\Enums\UserRole
                ? $user->role->value
                : $user->role
            );
        @endphp

        <div>
            <label for="role" class="mb-2 block text-sm font-semibold text-gray-700">
                Role / Hak Akses <span class="text-red-500">*</span>
            </label>

            <select id="role" name="role" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                @foreach (\App\Enums\UserRole::cases() as $role)
                    <option value="{{ $role->value }}" @selected($currentRole === $role->value)>
                        {{ $role->label() }}
                    </option>
                @endforeach
            </select>

            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Uji Ubah Password (Opsional) --}}
        <div class="border-t border-gray-100 pt-4 space-y-4">
            <div>
                <h4 class="text-sm font-bold text-gray-900">Ubah Kata Sandi (Opsional)</h4>
                <p class="text-xs text-gray-400">Biarkan kosong jika tidak ingin mengubah kata sandi pengguna ini.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Kata Sandi Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi baru"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
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
                Perbarui Data User
            </button>
        </div>
    </form>
</x-layouts.admin>