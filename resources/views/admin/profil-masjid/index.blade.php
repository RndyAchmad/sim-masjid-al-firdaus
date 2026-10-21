<x-layouts.admin>
    <x-slot name="title">Profil Masjid</x-slot>

    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h2 class="text-xl font-bold text-gray-900">
                Pengaturan Profil Masjid
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi, gambar, visi, misi, dan struktur organisasi masjid.
                Semua informasi wajib diisi.
            </p>
        </div>

        {{-- Form Profil --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

            <form
                action="{{ route('admin.profile.update') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-8"
            >
                @csrf
                @method('PUT')

                {{-- Error Summary --}}
                @if ($errors->any())
                    <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                        <p class="font-semibold text-red-700">
                            Periksa kembali data berikut:
                        </p>

                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 1. Deskripsi Masjid --}}
                <div>
                    <label for="description" class="mb-2 block text-sm font-semibold text-gray-800">
                        Tentang Masjid <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        required
                        maxlength="10000"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm transition focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        placeholder="Ceritakan sejarah atau profil singkat Masjid Al-Firdaus..."
                    >{{ old('description', $profile?->description) }}</textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                {{-- 2. Gambar Masjid --}}
                <div>
                    <label for="images" class="mb-2 block text-sm font-semibold text-gray-800">
                        Gambar Masjid <span class="text-red-500">*</span>
                    </label>

                    @if ($profile?->images)
                        <div class="mb-4">
                            <p class="mb-2 text-sm text-gray-500">Gambar saat ini</p>

                            <img
                                src="{{ asset('storage/' . $profile->images) }}"
                                alt="Gambar Masjid Al-Firdaus"
                                class="max-h-64 w-auto rounded-xl border border-gray-200 bg-gray-50 object-contain shadow-sm"
                            >
                        </div>
                    @endif

                    <input
                        type="file"
                        id="images"
                        name="images"
                        accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                        @required(!$profile?->images)
                        onchange="previewUpload(this, 'images-preview-container', 'images-preview')"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:font-semibold file:text-gray-700 hover:file:bg-gray-200 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                        @if ($profile?->images)
                            Kosongkan jika tidak ingin mengganti gambar.
                        @else
                            Gambar wajib diunggah.
                        @endif
                    </p>

                    <div id="images-preview-container" class="mt-4 hidden">
                        <p class="mb-2 text-sm font-medium text-gray-700">
                            Preview gambar baru
                        </p>

                        <img
                            id="images-preview"
                            src=""
                            alt="Preview Gambar Masjid"
                            class="max-h-64 w-auto rounded-xl border border-gray-200 bg-gray-50 object-contain shadow-sm"
                        >
                    </div>

                    @error('images')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                {{-- 3. Visi --}}
                <div>
                    <label for="vision" class="mb-2 block text-sm font-semibold text-gray-800">
                        Visi Masjid <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="vision"
                        name="vision"
                        rows="3"
                        required
                        maxlength="5000"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm transition focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        placeholder="Masukkan visi masjid..."
                    >{{ old('vision', $profile?->vision) }}</textarea>

                    @error('vision')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                {{-- 4. Misi --}}
                <div>
                    <div class="mb-3 flex items-center justify-between gap-3">
                        <label class="block text-sm font-semibold text-gray-800">
                            Misi Masjid <span class="text-red-500">*</span>
                        </label>

                        <button
                            type="button"
                            onclick="tambahMisi()"
                            class="inline-flex shrink-0 items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-semibold text-[#a8833e] transition hover:bg-amber-50"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                            Tambah Poin
                        </button>
                    </div>

                    @php
                        $daftarMisi = old('mission', $profile?->mission ?? ['']);

                        if (!is_array($daftarMisi) || count($daftarMisi) === 0) {
                            $daftarMisi = [''];
                        }
                    @endphp

                    <div id="misi-container" class="space-y-3">
                        @foreach ($daftarMisi as $misi)
                            <div class="mission-row flex items-start gap-3">
                                <div class="flex-1">
                                    <input
                                        type="text"
                                        name="mission[]"
                                        value="{{ $misi }}"
                                        required
                                        maxlength="500"
                                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                                        placeholder="Masukkan poin misi..."
                                    >
                                </div>

                                <button
                                    type="button"
                                    onclick="hapusMisi(this)"
                                    class="rounded-xl p-3 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                    title="Hapus poin misi"
                                    aria-label="Hapus poin misi"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M6 7h12m-10 0 1 13h6l1-13M9 7V4h6v3m-5 4v5m4-5v5"
                                        />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        Minimal satu poin misi. Setiap poin wajib diisi dan maksimal 500 karakter.
                    </p>

                    @error('mission')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @error('mission.*')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                {{-- 5. Struktur Organisasi --}}
                <div>
                    <label for="gambar_struktur" class="mb-2 block text-sm font-semibold text-gray-800">
                        Struktur Organisasi <span class="text-red-500">*</span>
                    </label>

                    @if ($profile?->structure)
                        <div class="mb-4">
                            <p class="mb-2 text-sm text-gray-500">
                                Struktur organisasi saat ini
                            </p>

                            <img
                                src="{{ asset('storage/' . $profile->structure) }}"
                                alt="Struktur Organisasi Masjid Al-Firdaus"
                                class="max-h-72 w-auto rounded-xl border border-gray-200 bg-gray-50 object-contain shadow-sm"
                            >
                        </div>
                    @endif

                    <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-5 transition hover:border-[#c49c4d]">
                        <div class="flex flex-col items-center gap-3 text-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M12 16V4m0 0L7 9m5-5 5 5M4 16v4h16v-4"
                                />
                            </svg>

                            <div>
                                <p class="text-sm font-semibold text-gray-700">
                                    Unggah Struktur Organisasi
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                                </p>
                            </div>

                            <input
                                type="file"
                                id="gambar_struktur"
                                name="structure"
                                accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                @required(!$profile?->structure)
                                onchange="previewUpload(this, 'structure-preview-container', 'structure-preview')"
                                class="block w-full max-w-md rounded-xl border border-gray-300 bg-white p-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:font-semibold file:text-gray-700 hover:file:bg-gray-200 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                            >

                            @if ($profile?->structure)
                                <p class="mt-2 text-xs text-gray-500">
                                    Kosongkan jika tidak ingin mengganti gambar saat ini.
                                </p>
                            @else
                                <p class="mt-2 text-xs text-red-500">
                                    Gambar struktur organisasi wajib diunggah.
                                </p>
                            @endif
                        </div>
                    </div>

                    <div id="structure-preview-container" class="mt-4 hidden">
                        <p class="mb-2 text-sm font-medium text-gray-700">
                            Preview gambar baru
                        </p>

                        <img
                            id="structure-preview"
                            src=""
                            alt="Preview Struktur Organisasi"
                            class="max-h-72 w-auto rounded-xl border border-gray-200 bg-gray-50 object-contain shadow-sm"
                        >
                    </div>

                    @error('structure')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                {{-- 6. Alamat --}}
                <div>
                    <label for="address" class="mb-2 block text-sm font-semibold text-gray-800">
                        Alamat Masjid <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        required
                        maxlength="1000"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        placeholder="Masukkan alamat lengkap masjid..."
                    >{{ old('address', $profile?->address) }}</textarea>

                    @error('address')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 7. Nomor Kontak --}}
                <div>
                    <label for="contact_number" class="mb-2 block text-sm font-semibold text-gray-800">
                        Nomor Kontak <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="tel"
                        inputmode="numeric"
                        pattern="[0-9]+"
                        id="contact_number"
                        name="contact_number"
                        value="{{ old('contact_number', $profile?->contact_number) }}"
                        required
                        maxlength="25"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        placeholder="Contoh: 081234567890"
                        title="Nomor kontak hanya boleh berisi angka."
                    >

                    @error('contact_number')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:justify-end">
                    <a
                        href="{{ route('admin.profile') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-[#c49c4d] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2"
                    >
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Script Form --}}
    <script>
        function tambahMisi() {
            const container = document.getElementById('misi-container');

            const row = document.createElement('div');
            row.className = 'mission-row flex items-start gap-3';

            row.innerHTML = `
                <div class="flex-1">
                    <input
                        type="text"
                        name="mission[]"
                        required
                        maxlength="500"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                        placeholder="Masukkan poin misi..."
                    >
                </div>

                <button
                    type="button"
                    class="rounded-xl p-3 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                    title="Hapus poin misi"
                    aria-label="Hapus poin misi"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 7h12m-10 0 1 13h6l1-13M9 7V4h6v3m-5 4v5m4-5v5" />
                    </svg>
                </button>
            `;

            row.querySelector('button').addEventListener('click', function () {
                hapusMisi(this);
            });

            container.appendChild(row);
            row.querySelector('input').focus();
        }

        function hapusMisi(button) {
            const container = document.getElementById('misi-container');

            if (container.querySelectorAll('.mission-row').length <= 1) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Misi wajib diisi',
                        text: 'Minimal harus ada satu poin misi.',
                        confirmButtonColor: '#c49c4d'
                    });
                } else {
                    alert('Minimal harus ada satu poin misi.');
                }

                return;
            }

            button.closest('.mission-row').remove();
        }

        function previewUpload(input, containerId, imageId) {
            const previewContainer = document.getElementById(containerId);
            const preview = document.getElementById(imageId);

            if (!input.files || !input.files[0]) {
                preview.src = '';
                previewContainer.classList.add('hidden');
                return;
            }

            const file = input.files[0];
            const allowedTypes = ['image/jpeg', 'image/png'];
            const maxSize = 2 * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                input.value = '';
                preview.src = '';
                previewContainer.classList.add('hidden');

                Swal.fire({
                    icon: 'error',
                    title: 'Format Tidak Valid',
                    text: 'Pilih gambar berformat JPG, JPEG, atau PNG.',
                    confirmButtonColor: '#c49c4d'
                });

                return;
            }

            if (file.size > maxSize) {
                input.value = '';
                preview.src = '';
                previewContainer.classList.add('hidden');

                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran Terlalu Besar',
                    text: 'Ukuran gambar maksimal 2 MB.',
                    confirmButtonColor: '#c49c4d'
                });

                return;
            }

            if (preview.dataset.objectUrl) {
                URL.revokeObjectURL(preview.dataset.objectUrl);
            }

            const objectUrl = URL.createObjectURL(file);

            preview.src = objectUrl;
            preview.dataset.objectUrl = objectUrl;
            previewContainer.classList.remove('hidden');
        }
    </script>
</x-layouts.admin>
