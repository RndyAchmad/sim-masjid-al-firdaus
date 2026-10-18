<x-layouts.admin>
    <x-slot name="title">Tambah Kegiatan Baru</x-slot>
    <x-slot name="backUrl">{{ route('admin.kegiatan.index') }}</x-slot>

    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3" x-data="{ jenis: 'event' }">
        @csrf

        {{-- Kolom Kiri: Form Utama Konten --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Informasi Kegiatan</h3>

                {{-- Tipe Kegiatan --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Tipe Kegiatan <span
                            class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center gap-3 border rounded-xl p-3.5 cursor-pointer transition"
                            :class="jenis === 'event' ? 'border-[#c49c4d] bg-[#c49c4d]/5' : 'border-gray-300'">
                            <input type="radio" name="type" value="event" x-model="jenis"
                                class="text-[#c49c4d] focus:ring-[#c49c4d]">
                            <span class="text-sm font-semibold text-gray-900">Event Khusus / PHBI</span>
                        </label>
                        <label class="flex items-center gap-3 border rounded-xl p-3.5 cursor-pointer transition"
                            :class="jenis === 'rutin' ? 'border-[#c49c4d] bg-[#c49c4d]/5' : 'border-gray-300'">
                            <input type="radio" name="type" value="rutin" x-model="jenis"
                                class="text-[#c49c4d] focus:ring-[#c49c4d]">
                            <span class="text-sm font-semibold text-gray-900">Kegiatan Rutin</span>
                        </label>
                    </div>
                </div>

                {{-- Nama Kegiatan --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Nama / Judul Kegiatan <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" placeholder="Contoh: Peringatan Maulid Nabi Muhammad SAW 1448 H"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                {{-- Dynamic Field (Tanggal VS Jadwal Rutin) + Penceramah --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div x-show="jenis === 'event'">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Tanggal Pelaksanaan</label>
                        <input type="date" name="event_date"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div x-show="jenis === 'rutin'">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Keterangan Jadwal Rutin</label>
                        <input type="text" name="routine_day" placeholder="Contoh: Setiap Ahad Ke-2"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Penceramah / Pengisi Acara</label>
                        <input type="text" name="speaker" placeholder="Contoh: KH. Anwar Zahid"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                {{-- Jam Mulai & Lokasi --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Jam Mulai</label>
                        <input type="time" name="start_time"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Lokasi / Tempat</label>
                        <input type="text" name="location" value="Ruang Utama Masjid Al-Firdaus"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Deskripsi / Rincian Acara</label>
                    <textarea rows="4" name="description" placeholder="Tuliskan rincian kegiatan..."
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"></textarea>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Pamflet & Aksi Simpan --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Pamflet & Aksi</h3>

                {{-- Upload Gambar Pamflet / Banner --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Pamflet / Poster Kegiatan</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full rounded-xl border border-gray-300 p-2 text-sm text-gray-600 focus:border-[#c49c4d] focus:outline-none">
                    <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP (Maks 2MB)</p>
                </div>

                {{-- Aksi Simpan --}}
                <div class="pt-2 flex flex-col gap-3">
                    <button type="submit"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Simpan & Publikasikan
                    </button>
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
