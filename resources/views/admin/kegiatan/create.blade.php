<x-layouts.admin>
    <x-slot name="title">Tambah Kegiatan</x-slot>
    <x-slot name="backUrl">{{ route('admin.kegiatan.index') }}</x-slot>

    <div class="max-w-3xl space-y-6">
        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" x-data="{
                nama: @js(old('name', '')),
                jadwal: @js(old('schedule_type', 'once')),
                get slug() {
                    return this.nama
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                }
            }" class="space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf

            {{-- Nama Kegiatan --}}
            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                    Nama Kegiatan <span class="text-red-500">*</span>
                </label>

                <input type="text" id="name" name="name" x-model="nama" required maxlength="255"
                    placeholder="Contoh: Kajian Rutin Ahad Pagi" value="{{ old('name') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('name') @enderror">

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Slug
                </label>

                <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">
                    <p class="break-all text-sm text-gray-600" x-text="slug || 'slug-kegiatan'"></p>
                </div>

                <p class="mt-1 text-xs text-gray-500">
                    Slug dibuat otomatis berdasarkan nama kegiatan.
                </p>
            </div>

            {{-- Jenis Kegiatan --}}
            <div>
                <label for="tipe" class="mb-2 block text-sm font-medium text-gray-700">
                    Jenis Kegiatan <span class="text-red-500">*</span>
                </label>

                <input type="text" id="tipe" name="tipe" list="daftar-tipe" required maxlength="100"
                    value="{{ old('tipe') }}" placeholder="Contoh: kajian, shalat jumat, event akbar"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('tipe') @enderror">

                <datalist id="daftar-tipe">
                    <option value="kajian">
                    <option value="shalat jumat">
                    <option value="event akbar">
                </datalist>

                @error('tipe')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Excerpt --}}
            <div>
                <label for="excerpt" class="mb-2 block text-sm font-medium text-gray-700">
                    Ringkasan Kegiatan
                </label>

                <textarea id="excerpt" name="excerpt" rows="3" maxlength="1000"
                    placeholder="Tuliskan ringkasan singkat kegiatan..."
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('excerpt') @enderror">{{ old('excerpt') }}</textarea>

                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pola Jadwal --}}
            <div>
                <label for="schedule_type" class="mb-2 block text-sm font-medium text-gray-700">
                    Pola Jadwal <span class="text-red-500">*</span>
                </label>

                <select id="schedule_type" name="schedule_type" x-model="jadwal" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('schedule_type') @enderror">
                    @foreach (\App\Enums\ActivityScheduleType::cases() as $jenisJadwal)
                        <option value="{{ $jenisJadwal->value }}" @selected(old('schedule_type', 'once') === $jenisJadwal->value)>
                            {{ $jenisJadwal->label() }}
                        </option>
                    @endforeach
                </select>

                @error('schedule_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Kegiatan --}}
            <div x-show="jadwal === 'once'" x-cloak>
                <label for="date" class="mb-2 block text-sm font-medium text-gray-700">
                    Tanggal Kegiatan <span class="text-red-500">*</span>
                </label>

                <input type="date" id="date" name="date" value="{{ old('date') }}" x-bind:required="jadwal === 'once'"
                    x-bind:disabled="jadwal !== 'once'"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('date') @enderror">

                @error('date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            {{-- Hari Kegiatan --}}
            <div x-show="jadwal === 'weekly' || jadwal === 'biweekly'" x-cloak>
                <label for="day_of_week" class="mb-2 block text-sm font-medium text-gray-700">
                    Hari Kegiatan <span class="text-red-500">*</span>
                </label>

                <select id="day_of_week" name="day_of_week"
                    x-bind:required="jadwal === 'weekly' || jadwal === 'biweekly'"
                    x-bind:disabled="jadwal !== 'weekly' && jadwal !== 'biweekly'"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('day_of_week') @enderror">
                    <option value="">Pilih hari</option>

                    @foreach (\App\Enums\ScheduleDay::cases() as $hari)
                        <option value="{{ $hari->value }}" @selected(old('day_of_week') === $hari->value)>
                            {{ $hari->label() }}
                        </option>
                    @endforeach
                </select>

                @error('day_of_week')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pemateri --}}
            <div>
                <label for="speaker" class="mb-2 block text-sm font-medium text-gray-700">
                    Pemateri
                </label>

                <input type="text" id="speaker" name="speaker" maxlength="255" value="{{ old('speaker') }}"
                    placeholder="Nama ustaz atau pemateri"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('speaker') @enderror">

                @error('speaker')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Waktu --}}
            <div>
                <label for="time" class="mb-2 block text-sm font-medium text-gray-700">
                    Waktu Kegiatan <span class="text-red-500">*</span>
                </label>

                <input type="time" id="time" name="time" value="{{ old('time') }}" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('time') @enderror">

                @error('time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div>
                <label for="location" class="mb-2 block text-sm font-medium text-gray-700">
                    Lokasi <span class="text-red-500">*</span>
                </label>

                <input type="text" id="location" name="location" maxlength="255" value="{{ old('location') }}" required
                    placeholder="Contoh: Masjid Al-Firdaus"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('location') @enderror">

                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-gray-700">
                    Deskripsi Lengkap
                </label>

                <textarea id="description" name="description" rows="5"
                    placeholder="Informasi lengkap mengenai kegiatan..."
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20 @error('description') @enderror">{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Poster --}}
            <div>
                <label for="image_poster" class="mb-2 block text-sm font-medium text-gray-700">
                    Poster Kegiatan
                </label>

                <input type="file" id="image_poster" name="image_poster"
                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-gray-700 @error('image_poster') @enderror">

                <p class="mt-1 text-xs text-gray-500">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </p>

                @error('image_poster')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.kegiatan.index') }}"
                    class="rounded-xl border border-gray-300 px-5 py-3 text-center text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                    Batal
                </a>

                <button type="submit"
                    class="rounded-xl bg-[#c49c4d] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>