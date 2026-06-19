<x-layouts.guest>
    {{-- Hero Section --}}
    <div class="relative h-screen w-full">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpg') }}" alt="Hero Image" class="h-full w-full object-cover">
            {{-- Opacity disesuaikan sedikit agar teks lebih terbaca --}}
            <div class="absolute inset-0 bg-black/60"></div> 
        </div>
        <div class="relative z-10 flex h-full flex-col items-center justify-center px-4">
            <h1 class="text-center text-4xl font-bold tracking-tight text-white md:text-6xl lg:text-7xl">
                Selamat Datang di Website <br> 
                <span class="text-[#c49c4d]">Masjid Al-Firdaus</span>
            </h1>
            <p class="mt-6 max-w-2xl text-center text-lg text-gray-300">
                Pusat informasi, ibadah, dan transparansi kegiatan jamaah.
            </p>
        </div>
    </div>

    {{-- Jadwal Sholat Section (Floating Box) --}}
    <div class="relative z-20 mx-auto -mt-16 max-w-7xl px-4 sm:px-6 lg:px-8" 
         x-data="jadwalSholat()" 
         x-init="initJadwal()">
        
        <div class="rounded-2xl border border-gray-800 bg-[#0B0B0B] p-6 shadow-2xl shadow-black/50 lg:p-8">
            {{-- Header Jadwal --}}
            <div class="mb-6 flex flex-col items-center justify-between gap-4 border-b border-gray-800 pb-4 md:flex-row">
                <div class="text-center md:text-left">
                    <h2 class="text-xl font-bold tracking-wide text-white">Jadwal Sholat Hari Ini</h2>
                    <p class="text-sm text-[#c49c4d]" x-text="lokasi + ' • ' + tanggal">Memuat lokasi...</p>
                </div>
                
                {{-- Jam Real-time --}}
                <div class="flex items-center gap-2 rounded-lg bg-gray-900 px-4 py-2 text-[#c49c4d]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-mono text-lg font-bold tracking-widest" x-text="currentTime">00:00:00</span>
                </div>
            </div>

            {{-- Grid Waktu Sholat --}}
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                <template x-for="(waktu, nama) in jadwal" :key="nama">
                    <div class="group flex flex-col items-center justify-center rounded-xl border border-gray-800 bg-[#121212] p-4 transition-all hover:border-[#c49c4d] hover:bg-black">
                        <span class="text-xs font-semibold uppercase tracking-widest text-gray-400 transition-colors group-hover:text-[#c49c4d]" x-text="nama"></span>
                        <span class="mt-2 text-2xl font-bold text-white" x-text="waktu">--:--</span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Menu Cards Section --}}
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            
            <div class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">Profil</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Pelajari lebih lanjut tentang sejarah, visi, misi, dan susunan kepengurusan Masjid Al-Firdaus.</p>
                <a href="/profil" class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">Kegiatan</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Temukan berbagai jadwal kajian, acara rutin, dan kegiatan yang diselenggarakan oleh masjid.</p>
                <a href="/kegiatan" class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">Artikel</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Baca artikel inspiratif dan informasi terbaru seputar dakwah serta kegiatan keagamaan.</p>
                <a href="/artikel" class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">Galeri</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Lihat dokumentasi foto-foto kegiatan dan momen penting jamaah di Masjid Al-Firdaus.</p>
                <a href="/galeri" class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="rounded-xl bg-white p-8 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#c49c4d]/10">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">Kontak</h2>
                <p class="mb-6 leading-relaxed text-gray-600">Hubungi pengurus untuk informasi lebih lanjut, pertanyaan, atau pendaftaran kegiatan masjid.</p>
                <a href="/kontak" class="inline-flex items-center gap-2 rounded-lg bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                    this.currentTime = now.toLocaleTimeString('id-ID', { hour12: false });
                },

                async fetchJadwalAPI() {
                    try {
                        const today = new Date();
                        const year = today.getFullYear();
                        const month = String(today.getMonth() + 1).padStart(2, '0');
                        const day = String(today.getDate()).padStart(2, '0');
                        
                        // ID 1628 adalah kode untuk Kab. Sidoarjo di API MyQuran Kemenag
                        const response = await fetch(`https://api.myquran.com/v2/sholat/jadwal/1628/${year}/${month}/${day}`);
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