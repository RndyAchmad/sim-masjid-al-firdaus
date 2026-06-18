<x-layouts.guest>
    <div class="relative h-screen w-full">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero.jpg') }}" alt="Hero Image" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
        <div class="relative z-10 flex h-full items-center justify-center">
            <h1 class="text-center text-4xl font-bold text-white md:text-6xl">Selamat Datang di Website Masjid Al-Firdaus</h1>
        </div>
    </div>
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg bg-white p-6 shadow-md transition hover:shadow-lg">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Profil</h2>
                <p class="text-gray-600">Pelajari lebih lanjut tentang sejarah, visi, misi, dan kegiatan Masjid Al-Firdaus.</p>
                <a href="/profil" class="mt-4 inline-block rounded bg-[#c49c4d] px-4 py-2 text-white font-medium transition hover:bg-[#b38c3f]">Selengkapnya</a>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-md transition hover:shadow-lg">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Kegiatan</h2>
                <p class="text-gray-600">Temukan berbagai kegiatan dan acara yang diselenggarakan oleh Masjid Al-Firdaus.</p>
                <a href="/kegiatan" class="mt-4 inline-block rounded bg-[#c49c4d] px-4 py-2 text-white font-medium transition hover:bg-[#b38c3f]">Selengkapnya</a>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-md transition hover:shadow-lg">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Artikel</h2>
                <p class="text-gray-600">Baca artikel dan informasi terbaru seputar Masjid Al-Firdaus dan kegiatan keagamaan.</p>
                <a href="/artikel" class="mt-4 inline-block rounded bg-[#c49c4d] px-4 py-2 text-white font-medium transition hover:bg-[#b38c3f]">Selengkapnya</a>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-md transition hover:shadow-lg">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Galeri</h2>
                <p class="text-gray-600">Lihat foto-foto kegiatan dan momen penting di Masjid Al-Firdaus.</p>
                <a href="/galeri" class="mt-4 inline-block rounded bg-[#c49c4d] px-4 py-2 text-white font-medium transition hover:bg-[#b38c3f]">Selengkapnya</a>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-md transition hover:shadow-lg">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Kontak</h2>
                <p class="text-gray-600">Hubungi kami untuk informasi lebih lanjut atau pertanyaan seputar Masjid Al-Firdaus.</p>
                <a href="/kontak" class="mt-4 inline-block rounded bg-[#c49c4d] px-4 py-2 text-white font-medium transition hover:bg-[#b38c3f]">Selengkapnya</a>
            </div>
        </div>
    </div>
</x-layouts.guest>