<x-layouts.guest>
    {{-- Header Banner Halaman Kontak --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Silaturahmi & Layanan
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Hubungi Pengurus Masjid
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Layanan informasi, konsultasi, pendaftaran kegiatan, dan konfirmasi infak/wakaf
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Warm Sand) --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            {{-- 1. GRID INFORMASI KONTAK & FORM PESAN --}}
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-12">

                {{-- Kolom Kiri: Informasi Kontak & Alamat (5 Kolom) --}}
                <div class="space-y-6 lg:col-span-5">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                            Informasi Sekretariat
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Sekretariat DKM
                        </h2>
                        <p class="mt-2 text-xs text-gray-600 sm:text-sm">
                            Pengurus Masjid Al-Firdaus siap melayani pertanyaan, konsultasi agama, dan informasi seputar
                            kegiatan jamaah.
                        </p>
                    </div>

                    {{-- Card Detail Alamat & Kontak --}}
                    <div class="space-y-4 rounded-2xl border border-stone-200 bg-white p-6 shadow-md">

                        {{-- Alamat --}}
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#8c6b2d]/10 text-[#8c6b2d] border border-[#8c6b2d]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500">Alamat Masjid</h3>
                                <p class="mt-1 text-xs sm:text-sm font-semibold text-gray-900">
                                    Perumahan Taman Puspa Sari, Klurak, Candi, Sidoarjo, Jawa Timur
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-stone-100"></div>

                        {{-- WhatsApp / Telepon --}}

                        @php
                            $nomorKontak = $profile?->contact_number;
                            $nomorWhatsApp = $nomorKontak
                                ? preg_replace('/\D/', '', $nomorKontak)
                                : null;

                            if ($nomorWhatsApp && str_starts_with($nomorWhatsApp, '0')) {
                                $nomorWhatsApp = '62' . substr($nomorWhatsApp, 1);
                            } elseif ($nomorWhatsApp && str_starts_with($nomorWhatsApp, '8')) {
                                $nomorWhatsApp = '62' . $nomorWhatsApp;
                            }
                        @endphp

                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                    WhatsApp Call Center / Takmir
                                </h3>

                                @if ($nomorKontak)
                                    <p class="mt-1 font-mono text-xs font-bold text-gray-900 sm:text-sm">
                                        {{ $nomorKontak }}
                                    </p>

                                    @if ($nomorWhatsApp)
                                        <a href="https://wa.me/{{ $nomorWhatsApp }}" target="_blank" rel="noopener noreferrer"
                                            class="mt-1 inline-block text-xs font-medium text-emerald-600 hover:text-emerald-700">
                                            Hubungi melalui WhatsApp
                                        </a>
                                    @endif
                                @else
                                    <p class="mt-1 text-xs text-gray-500 sm:text-sm">
                                        Nomor kontak belum tersedia.
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="border-t border-stone-100"></div>

                        {{-- Email Sekretariat --}}
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 border border-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500">Email Resmi</h3>
                                <p class="mt-1 text-xs sm:text-sm font-semibold text-gray-900">
                                    takmir@masjidalfirdaus.or.id
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Kolom Kanan: Form Pesan / Pertanyaan (7 Kolom) --}}
                <div class="lg:col-span-7">
                    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md sm:p-8">
                        <h3 class="font-serif text-xl font-bold text-gray-900 sm:text-2xl">
                            Kirim Pesan atau Pertanyaan
                        </h3>
                        <p class="mt-1 text-xs text-gray-600 sm:text-sm">
                            Sampaikan pertanyaan, masukan, atau konfirmasi donasi Anda melalui formulir di bawah ini:
                        </p>

                        <form action="#" method="POST" class="mt-6 space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                {{-- Nama --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700">Nama Lengkap *</label>
                                    <input type="text" placeholder="Masukkan nama Anda" required
                                        class="mt-1.5 w-full rounded-xl border border-stone-200 bg-[#FBF9F5] px-4 py-2.5 text-xs text-gray-900 shadow-sm focus:border-[#8c6b2d] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                                </div>

                                {{-- Nomor Telepon / WA --}}
                                <div>
                                    <label class="block text-xs font-semibold text-gray-700">Nomor WhatsApp *</label>
                                    <input type="tel" placeholder="08123456789" required
                                        class="mt-1.5 w-full rounded-xl border border-stone-200 bg-[#FBF9F5] px-4 py-2.5 text-xs text-gray-900 shadow-sm focus:border-[#8c6b2d] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                                </div>
                            </div>

                            {{-- Subjek / Perihal --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-700">Perihal / Subjek *</label>
                                <select required
                                    class="mt-1.5 w-full rounded-xl border border-stone-200 bg-[#FBF9F5] px-4 py-2.5 text-xs text-gray-900 shadow-sm focus:border-[#8c6b2d] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                                    <option value="">-- Pilih Perihal --</option>
                                    <option value="konfirmasi_donasi">Konfirmasi Infak / Wakaf</option>
                                    <option value="kegiatan">Pertanyaan Kegiatan / Kajian</option>
                                    <option value="saran">Saran & Masukan Takmir</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            {{-- Isi Pesan --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-700">Pesan / Masukan *</label>
                                <textarea rows="4" placeholder="Tuliskan pesan Anda secara jelas..." required
                                    class="mt-1.5 w-full rounded-xl border border-stone-200 bg-[#FBF9F5] p-4 text-xs text-gray-900 shadow-sm focus:border-[#8c6b2d] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm"></textarea>
                            </div>

                            {{-- Tombol Kirim --}}
                            <div class="pt-2">
                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#8c6b2d] px-6 py-3 text-xs font-semibold text-white shadow-md transition hover:bg-[#6e5321] sm:text-sm">
                                    Kirim Pesan
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {{-- Separator Pembatas --}}
            <div class="border-t border-stone-200/80"></div>

            {{-- 2. SECTION PETA LOKASI GOOGLE MAPS --}}
            <section class="space-y-6">
                <div class="text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                        Peta Lokasi
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Lokasi Masjid Al-Firdaus
                    </h2>
                    <p class="mt-2 text-xs text-gray-600 sm:text-sm">
                        Kunjungi lokasi masjid kami melalui peta penunjuk jalan Google Maps di bawah ini.
                    </p>
                </div>

                {{-- Responsive Google Maps Embed --}}
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md">
                    <div class="aspect-video w-full h-87.5 sm:h-112.5">
                        <iframe class="h-full w-full border-0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3!2d112.7319!3d-7.4868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e73ee16db655%3A0xdf37fc83c797a5bb!2sMasjid%20TPS!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>