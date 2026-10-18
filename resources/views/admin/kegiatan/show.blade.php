<x-layouts.admin>
    <x-slot name="title">Detail Kegiatan</x-slot>
    <x-slot name="backUrl">{{ route('admin.kegiatan.index') }}</x-slot>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri: Informasi Utama Konten --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-5">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-900">Informasi Lengkap Kegiatan</h3>
                    @if(($event->type ?? 'event') === 'event')
                        <span
                            class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-[#c49c4d] border border-[#c49c4d]/20">
                            Event Khusus / PHBI
                        </span>
                    @else
                        <span
                            class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-200">
                            Kajian Rutin
                        </span>
                    @endif
                </div>

                {{-- Judul Kegiatan --}}
                <div>
                    <span class="text-xs font-semibold uppercase text-gray-400">Nama / Judul Kegiatan</span>
                    <h2 class="text-xl font-bold text-gray-900 mt-1">
                        {{ $event->title ?? 'Peringatan Maulid Nabi Muhammad SAW 1448 H' }}
                    </h2>
                </div>

                {{-- Detail Jadwal & Pengisi Acara --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 rounded-xl bg-gray-50 p-4 border border-gray-200/80">
                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">Jadwal & Waktu</span>
                        <p class="text-sm font-semibold text-gray-800 mt-0.5 font-mono">
                            @if(($event->type ?? 'event') === 'event')
                                {{ \Carbon\Carbon::parse($event->event_date ?? '2026-10-24')->translatedFormat('d F Y') }}
                            @else
                                {{ $event->routine_day ?? 'Setiap Ahad Ke-2' }}
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 font-sans mt-0.5">
                            Jam Mulai: {{ substr($event->start_time ?? '19:30', 0, 5) }} WIB
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold uppercase text-gray-400">Penceramah / Pengisi Acara</span>
                        <p class="text-sm font-semibold text-gray-800 mt-0.5">
                            {{ $event->speaker ?? 'KH. Anwar Zahid' }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5">Narasumber Utama</p>
                    </div>

                    <div class="sm:col-span-2 border-t border-gray-200/60 pt-3">
                        <span class="text-xs font-semibold uppercase text-gray-400">Lokasi / Tempat</span>
                        <p class="text-sm font-semibold text-gray-800 mt-0.5">
                            {{ $event->location ?? 'Ruang Utama Masjid Al-Firdaus' }}
                        </p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <span class="text-xs font-semibold uppercase text-gray-400">Deskripsi / Rincian Acara</span>
                    <div
                        class="mt-2 text-sm text-gray-700 leading-relaxed bg-white rounded-xl border border-gray-200 p-4">
                        {!! nl2br(e($event->description ?? 'Mari hadiri peringatan Maulid Nabi Muhammad SAW bersama jamaah Masjid Al-Firdaus. Acara akan diisi dengan pembacaan Diba, ceramah agama, serta doa bersama.')) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Pamflet & Aksi --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Poster / Pamflet</h3>

                {{-- Preview Pamflet --}}
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                    @if(isset($event->image) && $event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-auto object-cover">
                    @else
                        <div class="p-8 text-center text-gray-400 text-xs">
                            Tidak ada gambar pamflet diunggah
                        </div>
                    @endif
                </div>

                {{-- Aksi Edit & Hapus --}}
                <div class="pt-2 flex flex-col gap-3">
                    <a href="{{ route('admin.kegiatan.edit', $event->id ?? 1) }}"
                        class="w-full text-center rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        Edit Kegiatan
                    </a>

                    <form action="{{ route('admin.kegiatan.destroy', $event->id ?? 1) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            Hapus Kegiatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
