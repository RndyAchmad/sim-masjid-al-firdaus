<x-layouts.guest>
    {{-- Header Banner Halaman Detail Kegiatan (Gelap Elegan) --}}
    <div class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-10 sm:py-14 border-b border-gray-800">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            {{-- Tombol Kembali --}}
            <div class="mb-4 flex justify-center sm:mb-6">
                <a href="{{ route('activities.index') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-gray-700 bg-black/50 px-4 py-1.5 text-xs font-semibold text-gray-300 transition hover:border-[#d8b76a] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Kegiatan
                </a>
            </div>

            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                @if(($event->type ?? 'event') === 'event')
                    Event Khusus & PHBI
                @else
                    Kajian & Program Rutin
                @endif
            </span>

            {{-- Judul Kegiatan --}}
            <h1 class="mt-2 font-serif text-2xl font-bold tracking-tight text-white sm:text-3xl md:text-4xl lg:text-5xl leading-tight">
                {{ $event->title ?? 'Peringatan Maulid Nabi Muhammad SAW 1448 H' }}
            </h1>

            {{-- Metadata Kegiatan --}}
            <div class="mt-4 flex flex-wrap items-center justify-center gap-3 text-xs text-gray-400 sm:gap-6 sm:text-sm">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d8b76a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Penceramah: <strong class="text-gray-200">{{ $event->speaker ?? 'KH. Anwar Zahid' }}</strong></span>
                </div>
                <span class="hidden sm:inline text-gray-600">•</span>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d8b76a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Pukul {{ substr($event->start_time ?? '19:30', 0, 5) }} WIB</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Warm Sand) --}}
    <div class="bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Pamflet / Banner Utama --}}
            @if(isset($event->image) && $event->image)
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-lg">
                    <div class="relative aspect-video w-full overflow-hidden bg-stone-100">
                        <img src="{{ asset('storage/' . $event->image) }}"
                            alt="{{ $event->title }}" class="h-full w-full object-cover">
                    </div>
                </div>
            @endif

            {{-- Card Ringkasan Jadwal & Lokasi --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 rounded-2xl border border-stone-200 bg-white p-6 shadow-sm {{ isset($event->image) && $event->image ? 'mt-8' : '' }}">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">Jadwal Pelaksanaan</span>
                    <p class="mt-1 font-mono text-sm font-bold text-gray-900">
                        @if(($event->type ?? 'event') === 'event')
                            {{ \Carbon\Carbon::parse($event->event_date ?? '2026-10-24')->translatedFormat('d F Y') }}
                        @else
                            {{ $event->routine_day ?? 'Setiap Ahad Ke-2' }}
                        @endif
                    </p>
                </div>

                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">Waktu Mulai</span>
                    <p class="mt-1 font-mono text-sm font-bold text-gray-900">
                        {{ substr($event->start_time ?? '19:30', 0, 5) }} WIB
                    </p>
                </div>

                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">Lokasi Tempat</span>
                    <p class="mt-1 text-sm font-semibold text-gray-900">
                        {{ $event->location ?? 'Ruang Utama Masjid Al-Firdaus' }}
                    </p>
                </div>
            </div>

            {{-- Isi Deskripsi / Rincian Kegiatan --}}
            <div class="mt-8 rounded-2xl border border-stone-200 bg-white p-6 sm:p-10 shadow-sm space-y-6 text-gray-700 leading-relaxed text-sm sm:text-base">
                
                <h3 class="font-serif text-xl font-bold text-gray-900 border-b border-stone-100 pb-3">
                    Rincian & Informasi Acara
                </h3>

                <div class="prose prose-stone leading-relaxed text-gray-700">
                    {!! nl2br(e($event->description ?? 'Mari hadiri Peringatan Maulid Nabi Muhammad SAW bersama jamaah Masjid Al-Firdaus. Acara akan diawali dengan pembacaan Diba, dilanjutkan tausiyah agama oleh penceramah, serta doa bersama untuk keberkahan lingkungan warga.')) !!}
                </div>

                <div class="my-6 rounded-xl border-l-4 border-[#8c6b2d] bg-[#FBF9F5] p-4 italic text-gray-800">
                    "Barangsiapa yang menempuh jalan untuk mencari ilmu, maka Allah akan mudahkan baginya jalan menuju surga." (HR. Muslim)
                </div>

                <p>
                    Pengurus DKM Masjid Al-Firdaus mengundang seluruh jamaah dan warga Perumahan Taman Puspa Sari beserta sekitarnya untuk dapat hadir meramaikan kegiatan ini secara bersama-sama.
                </p>

                {{-- Bagian Bagikan (Share Buttons) --}}
                <div class="mt-10 border-t border-stone-100 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                        Bagikan Info Kegiatan Ini:
                    </span>
                    <div class="flex items-center gap-3">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode('Hadirilah ' . ($event->title ?? 'Kegiatan Masjid') . ' di Masjid Al-Firdaus: ' . url()->current()) }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">
                            WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">
                            Facebook
                        </a>
                    </div>
                </div>

            </div>

            {{-- Rekomendasi Agenda / Kegiatan Lainnya --}}
            <div class="mt-12 sm:mt-16">
                <div class="mb-6 text-center">
                    <span class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                        Agenda Lainnya
                    </span>
                    <h3 class="font-serif text-xl font-bold text-gray-900 sm:text-2xl">
                        Kegiatan Masjid Mendatang
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    {{-- Card Rekomendasi 1 --}}
                    <div class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm transition hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-[#8c6b2d]">Setiap Ahad Ke-2 • 04:30 WIB</span>
                            <h4 class="mt-1 font-serif text-base font-bold text-gray-900 line-clamp-2">
                                Kajian Kitab Riyadhus Shalihin
                            </h4>
                            <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                Kajian rutin Ba'da Subuh bersama Ust. H. Abdullah Faqih, Lc. membahas hadits-hadits keutamaan amal.
                            </p>
                            <a href="#" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#8c6b2d] hover:underline">
                                Lihat Rincian →
                            </a>
                        </div>
                    </div>

                    {{-- Card Rekomendasi 2 --}}
                    <div class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm transition hover:border-[#8c6b2d] hover:shadow-md">
                        <div class="p-5">
                            <span class="text-xs font-semibold text-[#8c6b2d]">15 November 2026 • 18:30 WIB</span>
                            <h4 class="mt-1 font-serif text-base font-bold text-gray-900 line-clamp-2">
                                Tabligh Akbar & Doa Bersama Akhir Tahun
                            </h4>
                            <p class="mt-2 text-xs text-gray-600 line-clamp-2">
                                Dzikir dan syiar Islam bersama seluruh jamaah masjid dan tokoh masyarakat Sidoarjo.
                            </p>
                            <a href="#" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-[#8c6b2d] hover:underline">
                                Lihat Rincian →
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layouts.guest>
