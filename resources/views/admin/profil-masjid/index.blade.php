<x-layouts.admin>
    <x-slot name="title">Profil Masjid</x-slot>

    <div class="space-y-6">
        {{-- Header Page Info --}}
        <div class="flex flex-col gap-1">
            <h2 class="text-xl font-bold text-gray-900">Pengaturan Profil Masjid</h2>
            <p class="text-sm text-gray-500">
                Perbarui informasi tentang masjid, visi, misi, dan struktur organisasi yang akan ditampilkan kepada
                jamaah.
            </p>
        </div>

        {{-- Form Container (Memenuhi Ruang Kanan-Kiri) --}}
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6 sm:p-8">
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- 1. Tentang Masjid --}}
                <div>
                    <label for="tentang" class="block text-sm font-semibold text-gray-800 mb-2">
                        1. Tentang Masjid
                    </label>
                    <textarea id="tentang" name="tentang" rows="5"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] transition-colors"
                        placeholder="Ceritakan sejarah atau profil singkat Masjid Al-Firdaus..."></textarea>
                </div>

                <hr class="border-gray-100">

                {{-- 2. Visi --}}
                <div>
                    <label for="visi" class="block text-sm font-semibold text-gray-800 mb-2">
                        2. Visi
                    </label>
                    <textarea id="visi" name="visi" rows="3"
                        class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] transition-colors"
                        placeholder="Contoh: Menjadi pusat ibadah dan pembinaan umat yang makmur..."></textarea>
                </div>

                <hr class="border-gray-100">

                {{-- 3. Misi (Dynamic Points) --}}
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-semibold text-gray-800">
                            3. Misi
                        </label>
                        <button type="button" onclick="tambahMisi()"
                            class="inline-flex items-center gap-1.5 text-sm font-medium text-[#c49c4d] hover:text-[#a8833e] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Poin
                        </button>
                    </div>

                    {{-- Container untuk list misi --}}
                    <div id="misi-container" class="space-y-3">
                        {{-- Row Input Default (Pertama) --}}
                        <div class="flex items-center gap-3">
                            <div class="flex-1">
                                <input type="text" name="misi[]"
                                    class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] transition-colors"
                                    placeholder="Masukkan poin misi...">
                            </div>
                            <button type="button" onclick="hapusMisi(this)"
                                class="rounded-xl p-3 text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors"
                                title="Hapus baris">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100">

                {{-- 4. Struktur Organisasi (Gambar) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        4. Struktur Organisasi
                    </label>
                    <div
                        class="mt-2 flex justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50/50 px-6 py-10 hover:bg-gray-50 transition-colors">
                        <div class="text-center w-full">
                            <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                                <label for="gambar_struktur"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-[#c49c4d] focus-within:outline-none focus-within:ring-2 focus-within:ring-[#c49c4d] focus-within:ring-offset-2 hover:text-[#a8833e]">
                                    <span>Unggah Gambar baru</span>
                                    <input id="gambar_struktur" name="gambar_struktur" type="file" class="sr-only"
                                        accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">atau tarik dan lepas di sini</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-500 mt-1">PNG, JPG, JPEG maksimal 2MB</p>

                            {{-- Image Preview Container (Hidden by default) --}}
                            <div id="image-preview-container" class="hidden mt-4">
                                <img id="image-preview" src="#" alt="Preview"
                                    class="mx-auto max-h-56 rounded-xl shadow-sm border border-gray-200">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button"
                        class="rounded-xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-[#c49c4d] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#a8833e] focus:outline-none focus:ring-2 focus:ring-[#c49c4d] focus:ring-offset-2 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script untuk interaksi form --}}
    <script>
        function tambahMisi() {
            const container = document.getElementById('misi-container');
            const rowHTML = `
                <div class="flex items-center gap-3 mt-3">
                    <div class="flex-1">
                        <input type="text" name="misi[]" 
                            class="block w-full rounded-xl border border-gray-300 bg-white p-3.5 text-sm text-gray-700 shadow-sm focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] transition-colors" 
                            placeholder="Masukkan poin misi...">
                    </div>
                    <button type="button" onclick="hapusMisi(this)" class="rounded-xl p-3 text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus baris">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', rowHTML);
        }

        function hapusMisi(button) {
            const container = document.getElementById('misi-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            } else {
                alert('Minimal harus ada 1 poin misi.');
            }
        }

        function previewImage(input) {
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                previewImage.src = '#';
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</x-layouts.admin>