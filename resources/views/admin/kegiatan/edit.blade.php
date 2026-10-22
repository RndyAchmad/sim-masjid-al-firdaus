<x-layouts.admin>
    <x-slot name="title">Edit Kegiatan</x-slot>
    <x-slot name="backUrl">{{ route('admin.kegiatan.index') }}</x-slot>

    @php
        $scheduleType = $kegiatan->schedule_type instanceof \BackedEnum
            ? $kegiatan->schedule_type->value
            : $kegiatan->schedule_type;

        $dayOfWeek = $kegiatan->day_of_week instanceof \BackedEnum
            ? $kegiatan->day_of_week->value
            : $kegiatan->day_of_week;

        $tanggal = $kegiatan->date
            ? \Illuminate\Support\Carbon::parse($kegiatan->date)->format('Y-m-d')
            : '';

        $jam = $kegiatan->time
            ? substr((string) $kegiatan->time, 0, 5)
            : '';
    @endphp

    <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3" x-data="{
            jadwal: @js(old('schedule_type', $scheduleType ?: 'once'))
        }">
        @csrf
        @method('PUT')

        {{-- Kolom utama --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Informasi Kegiatan
                </h3>

                {{-- Nama kegiatan --}}
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama / Judul Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $kegiatan->name) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tipe kegiatan --}}
                <div>
                    <label for="tipe" class="mb-2 block text-sm font-semibold text-gray-700">
                        Tipe Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="tipe" name="tipe" value="{{ old('tipe', $kegiatan->tipe) }}"
                        placeholder="Contoh: Kajian, Shalat Jumat, Event Akbar" required maxlength="100"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('tipe')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis jadwal --}}
                <div>
                    <label for="schedule_type" class="mb-2 block text-sm font-semibold text-gray-700">
                        Jenis Jadwal <span class="text-red-500">*</span>
                    </label>
                    <select id="schedule_type" name="schedule_type" x-model="jadwal" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <option value="once">Sekali</option>
                        <option value="weekly">Setiap Minggu</option>
                        <option value="biweekly">Setiap Dua Minggu</option>
                    </select>
                    @error('schedule_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal atau hari --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div x-show="jadwal === 'once'" x-cloak>
                        <label for="date" class="mb-2 block text-sm font-semibold text-gray-700">
                            Tanggal Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="date" name="date" value="{{ old('date', $tanggal) }}"
                            :required="jadwal === 'once'" :disabled="jadwal !== 'once'"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-show="jadwal === 'weekly' || jadwal === 'biweekly'" x-cloak>
                        <label for="day_of_week" class="mb-2 block text-sm font-semibold text-gray-700">
                            Hari Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <select id="day_of_week" name="day_of_week"
                            :required="jadwal === 'weekly' || jadwal === 'biweekly'"
                            :disabled="jadwal !== 'weekly' && jadwal !== 'biweekly'"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                            <option value="">Pilih hari</option>
                            @foreach (\App\Enums\ScheduleDay::cases() as $hari)
                                <option value="{{ $hari->value }}" @selected(old('day_of_week', $dayOfWeek) === $hari->value)>
                                    {{ $hari->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('day_of_week')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jam --}}
                    <div>
                        <label for="time" class="mb-2 block text-sm font-semibold text-gray-700">
                            Jam Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="time" name="time" value="{{ old('time', $jam) }}" required
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        @error('time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Pemateri --}}
                <div>
                    <label for="speaker" class="mb-2 block text-sm font-semibold text-gray-700">
                        Penceramah / Pengisi Acara
                    </label>
                    <input type="text" id="speaker" name="speaker" value="{{ old('speaker', $kegiatan->speaker) }}"
                        maxlength="255"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('speaker')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label for="location" class="mb-2 block text-sm font-semibold text-gray-700">
                        Lokasi / Tempat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="location" name="location" value="{{ old('location', $kegiatan->location) }}"
                        required maxlength="255"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ringkasan --}}
                <div>
                    <label for="excerpt" class="mb-2 block text-sm font-semibold text-gray-700">
                        Ringkasan Kegiatan
                    </label>
                    <textarea id="excerpt" name="excerpt" rows="2" maxlength="1000"
                        placeholder="Ringkasan singkat yang ditampilkan pada daftar kegiatan"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('excerpt', $kegiatan->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="mb-2 block text-sm font-semibold text-gray-700">
                        Deskripsi / Rincian Kegiatan
                    </label>
                    <textarea id="description" name="description" rows="5"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('description', $kegiatan->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom poster dan aksi --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Poster & Aksi
                </h3>

                <div>
                    <label for="image_poster" class="mb-2 block text-sm font-semibold text-gray-700">
                        Poster Kegiatan
                    </label>

                    @if ($kegiatan->image_poster)
                        <div class="mb-3 overflow-hidden rounded-xl border border-gray-200 bg-gray-50 p-2">
                            <img src="{{ asset('storage/' . $kegiatan->image_poster) }}" alt="Poster {{ $kegiatan->name }}"
                                class="max-h-80 w-full rounded-lg object-contain">
                            <p class="mt-2 text-center text-xs text-gray-500">
                                Poster saat ini
                            </p>
                        </div>
                    @else
                        <div
                            class="mb-3 flex h-36 items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50">
                            <div class="text-center text-gray-400">
                                <svg class="mx-auto mb-2 h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 16.5V19a2 2 0 002 2h14a2 2 0 002-2v-2.5M16 10l-4-4m0 0l-4 4m4-4v12" />
                                </svg>
                                <p class="text-xs">Belum ada poster</p>
                            </div>
                        </div>
                    @endif

                    <input type="file" id="image_poster" name="image_poster"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
                    <p class="mt-2 text-xs leading-relaxed text-gray-500">
                        Unggah hanya jika ingin mengganti poster. Format JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.
                    </p>
                    @error('image_poster')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 pt-2">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Perbarui Kegiatan
                    </button>

                    <a href="{{ route('admin.kegiatan.index')}}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
