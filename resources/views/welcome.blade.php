<x-layouts.guest>
    {{-- Hero Section --}}
    <section
        class="relative isolate flex min-h-[calc(100vh-5rem)] items-center justify-center overflow-hidden bg-[#080806] px-4 py-20 text-white sm:px-6 sm:py-24 lg:px-8">
        <img src="{{ asset('storage/images/hero.png') }}" alt="Masjid Al-Firdaus"
            class="absolute inset-0 -z-20 h-full w-full object-cover object-center">

        <div class="absolute inset-0 -z-10 bg-black/65"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/70 via-black/35 to-[#080806]"></div>
        <div class="absolute inset-x-0 bottom-0 -z-10 h-40 bg-gradient-to-t from-[#080806] to-transparent"></div>

        <div class="mx-auto flex max-w-4xl flex-col items-center text-center">
            <p class="mb-4 text-[0.7rem] font-semibold uppercase leading-5 tracking-[0.22em] text-[#d8b76a] sm:mb-5 sm:text-xs md:text-sm">
                Bismillahirrahmanirrahim
            </p>

            <h1 class="max-w-3xl font-serif text-4xl font-bold leading-[1.05] text-white sm:text-5xl md:text-6xl lg:text-7xl">
                Selamat Datang
                <span
                    class="mt-2 block bg-gradient-to-r from-[#c49c4d] via-[#f4dc9b] to-[#c49c4d] bg-clip-text text-transparent sm:mt-3">
                    Di Masjid Al-Firdaus
                </span>
            </h1>

            <p class="mt-5 max-w-xl text-sm leading-7 text-gray-200 sm:mt-6 sm:text-base md:max-w-2xl md:text-lg md:leading-8">
                Pusat ibadah, silaturahmi, dan informasi jamaah Perumahan Taman Puspa Sari.
            </p>

            <div class="mt-8 h-px w-20 bg-gradient-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-10 sm:w-24"></div>
        </div>
    </section>

    {{-- Jadwal Sholat Section (Floating Box) --}}
    <div class="relative z-20 mx-auto -mt-16 max-w-7xl px-4 sm:px-6 lg:px-8" x-data="jadwalSholat()"
        x-init="initJadwal()">

        <div class="rounded-2xl border border-gray-800 bg-[#0B0B0B] p-5 shadow-2xl shadow-black/50 sm:p-6 lg:p-8">
            {{-- Header Jadwal --}}
            <div
                class="mb-5 flex flex-col items-center justify-between gap-4 border-b border-gray-800 pb-5 md:flex-row">
                <div class="text-center md:text-left">
                    <p class="mb-1 text-[0.68rem] font-semibold uppercase leading-5 tracking-[0.22em] text-[#c49c4d] sm:text-xs">
                        Waktu Ibadah
                    </p>
                    <h2 class="font-serif text-2xl font-bold leading-tight text-white sm:text-3xl">
                        Jadwal Sholat Hari Ini
                    </h2>
                    <p class="mt-2 text-xs font-medium leading-6 text-gray-400 sm:text-sm" x-text="lokasi + ' - ' + tanggal">Memuat lokasi...</p>
                </div>

                {{-- Jam Real-time --}}
                <div class="flex items-center gap-2 rounded-lg bg-gray-900 px-3 py-2 text-[#c49c4d] sm:px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-mono text-base font-semibold tracking-[0.12em] sm:text-lg" x-text="currentTime">00:00:00</span>
                </div>
            </div>

            {{-- Grid Waktu Sholat --}}
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 lg:grid-cols-6">
                <template x-for="(waktu, nama) in jadwal" :key="nama">
                    <div
                        class="group flex min-h-24 flex-col items-center justify-center rounded-xl border border-gray-800 bg-[#121212] p-4 transition-all hover:border-[#c49c4d] hover:bg-black">
                        <span
                            class="text-[0.68rem] font-semibold uppercase leading-5 tracking-[0.18em] text-gray-400 transition-colors group-hover:text-[#c49c4d] sm:text-xs"
                            x-text="nama"></span>
                        <span class="mt-2 font-mono text-xl font-semibold tracking-wide text-white sm:text-2xl" x-text="waktu">--:--</span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Menu Cards Section --}}
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

            <div
                class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 font-serif text-3xl font-bold text-gray-900">Profil</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Pelajari lebih lanjut tentang sejarah, visi, misi, dan
                    susunan kepengurusan Masjid Al-Firdaus.</p>
                <a href="/profil"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div
                class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 font-serif text-3xl font-bold text-gray-900">Kegiatan</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Temukan berbagai jadwal kajian, acara rutin, dan kegiatan
                    yang diselenggarakan oleh masjid.</p>
                <a href="/kegiatan"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div
                class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 font-serif text-3xl font-bold text-gray-900">Artikel</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Baca artikel inspiratif dan informasi terbaru seputar
                    dakwah serta kegiatan keagamaan.</p>
                <a href="/artikel"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div
                class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 font-serif text-3xl font-bold text-gray-900">Galeri</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Lihat dokumentasi foto-foto kegiatan dan momen penting
                    jamaah di Masjid Al-Firdaus.</p>
                <a href="/galeri"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div
                class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 font-serif text-3xl font-bold text-gray-900">Kontak</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Hubungi pengurus untuk informasi lebih lanjut, pertanyaan,
                    atau pendaftaran kegiatan masjid.</p>
                <a href="/kontak"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    {{-- Script Alpine untuk API Jadwal Sholat --}}
    <script>
        function jadwalSholat() {
            return {
                jadwal: {
                    'Imsak': '--:--',
                    'Subuh': '--:--',
                    'Dzuhur': '--:--',
                    'Ashar': '--:--',
                    'Maghrib': '--:--',
                    'Isya': '--:--'
                },
                tanggal: 'Memuat...',
                lokasi: 'Kab. Sidoarjo',
                currentTime: '00:00:00',

                initJadwal() {
                    this.updateClock();
                    setInterval(() => this.updateClock(), 1000);
                    this.fetchJadwalAPI();
                },

                updateClock() {
                    const now = new Date();
                    // Format jam agar selalu 2 digit (00:00:00)
                    this.currentTime = now.toLocaleTimeString('id-ID', {
                        hour12: false
                    });
                },

                async fetchJadwalAPI() {
                    try {
                        const today = new Date();
                        const year = today.getFullYear();
                        const month = String(today.getMonth() + 1).padStart(2, '0');
                        const day = String(today.getDate()).padStart(2, '0');

                        // ID 1628 adalah kode untuk Kab. Sidoarjo di API MyQuran Kemenag
                        const response = await fetch(
                            `https://api.myquran.com/v2/sholat/jadwal/1628/${year}/${month}/${day}`);
                        const data = await response.json();

                        if (data.status) {
                            this.tanggal = data.data.jadwal.tanggal;
                            this.jadwal = {
                                'Imsak': data.data.jadwal.imsak,
                                'Subuh': data.data.jadwal.subuh,
                                'Dzuhur': data.data.jadwal.dzuhur,
                                'Ashar': data.data.jadwal.ashar,
                                'Maghrib': data.data.jadwal.maghrib,
                                'Isya': data.data.jadwal.isya
                            };
                        }
                    } catch (error) {
                        console.error('Gagal mengambil jadwal sholat', error);
                        this.tanggal = 'Gagal memuat jadwal';
                    }
                }
            }
        }
    </script>
</x-layouts.guest>
