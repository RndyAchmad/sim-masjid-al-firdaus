<x-layouts.guest>
    {{-- Header Banner Halaman Laporan Inventaris --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Aset & Fasilitas Masjid
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Laporan Inventaris Masjid
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Daftar sarana, prasarana, dan fasilitas barang milik Masjid Al-Firdaus
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Sejuk / Off-White) --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            {{-- 1. SECTION RINGKASAN ASET INVENTARIS --}}
            <section>
                {{-- Header Section (Rata Tengah) --}}
                <div class="mb-8 text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                        Pemeliharaan & Pengelolaan
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                        Ringkasan Kondisi Barang
                    </h2>
                    <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                        Statistik ketersediaan dan status kelayakan fasilitas pendukung jamaah.
                    </p>
                </div>

                {{-- Card Grid Ringkasan Barang --}}
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Card 1: Total Jenis Barang --}}
                    <div
                        class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md transition-all duration-300 hover:border-[#8c6b2d] hover:shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Jenis
                                Barang</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#8c6b2d]/10 text-[#8c6b2d] border border-[#8c6b2d]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            48 <span class="text-xs font-normal text-gray-500 font-sans">Item</span>
                        </p>
                        <p class="mt-2 text-xs text-gray-500 font-medium">
                            Barang terdata di sistem
                        </p>
                    </div>

                    {{-- Card 2: Kondisi Baik --}}
                    <div
                        class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md transition-all duration-300 hover:border-emerald-500 hover:shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Kondisi Baik</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            42 <span class="text-xs font-normal text-gray-500 font-sans">Item</span>
                        </p>
                        <p class="mt-2 text-xs text-emerald-600 font-medium">
                            Berfungsi secara optimal
                        </p>
                    </div>

                    {{-- Card 3: Perlu Perbaikan --}}
                    <div
                        class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md transition-all duration-300 hover:border-amber-500 hover:shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Perlu
                                Perbaikan</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 border border-amber-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            4 <span class="text-xs font-normal text-gray-500 font-sans">Item</span>
                        </p>
                        <p class="mt-2 text-xs text-amber-600 font-medium">
                            Membutuhkan pemeliharaan
                        </p>
                    </div>

                    {{-- Card 4: Rusak / Ganti --}}
                    <div
                        class="rounded-2xl border border-stone-200 bg-white p-6 shadow-md transition-all duration-300 hover:border-rose-500 hover:shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Rusak / Ganti</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600 border border-rose-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-4 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            2 <span class="text-xs font-normal text-gray-500 font-sans">Item</span>
                        </p>
                        <p class="mt-2 text-xs text-rose-600 font-medium">
                            Dalam proses pengadaan ulang
                        </p>
                    </div>

                </div>
            </section>

            {{-- Separator Pembatas --}}
            <div class="border-t border-stone-200/80"></div>

            {{-- 2. SECTION TABEL DAFTAR INVENTARIS --}}
            <section>
                {{-- Header & Filter --}}
                <div class="mb-8 flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                            Daftar Fasilitas
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Daftar Inventaris Terdata
                        </h2>
                    </div>

                    {{-- Filter Kategori --}}
                    <div class="flex items-center gap-2">
                        <select
                            class="rounded-xl border border-stone-200 bg-white px-3.5 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            <option value="">Semua Kategori</option>
                            <option value="elektronik">Elektronik & Sound System</option>
                            <option value="perlengkapan">Perlengkapan Salat & Karpet</option>
                            <option value="furnitur">Mebel & MMT</option>
                            <option value="kebersihan">Peralatan Kebersihan</option>
                        </select>
                    </div>
                </div>

                {{-- Tabel Inventaris Responsif (4 Kolom Utama) --}}
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs sm:text-sm text-gray-600">
                            <thead
                                class="bg-stone-100 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-stone-200">
                                <tr>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Nama Barang & Merk</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Kategori</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Jumlah</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4 text-center">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 bg-white font-sans">

                                {{-- Item 1 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                        <p class="font-semibold text-gray-900">Sound System & Amplifier Wireless</p>
                                        <p class="text-xs text-gray-400">Merk: TOA ZA-2128MW</p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-600">
                                        Elektronik & Sound
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 font-mono font-bold text-gray-800">
                                        2 Unit
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-center">
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 border border-emerald-200">
                                            Baik
                                        </span>
                                    </td>
                                </tr>

                                {{-- Item 2 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                        <p class="font-semibold text-gray-900">Karpet Sajadah Utama (Satu Shaf)</p>
                                        <p class="text-xs text-gray-400">Merk: Tebal Premium Turkey Green 6m</p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-600">
                                        Perlengkapan Salat
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 font-mono font-bold text-gray-800">
                                        12 Roll
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-center">
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 border border-emerald-200">
                                            Baik
                                        </span>
                                    </td>
                                </tr>

                                {{-- Item 3 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                        <p class="font-semibold text-gray-900">Air Conditioner (AC) Standing 5 PK</p>
                                        <p class="text-xs text-gray-400">Merk: Daikin Inverter</p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-600">
                                        Elektronik & Pendingin
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 font-mono font-bold text-gray-800">
                                        4 Unit
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-center">
                                        <span
                                            class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-[11px] font-bold text-amber-700 border border-amber-200">
                                            Perlu Service
                                        </span>
                                    </td>
                                </tr>

                                {{-- Item 4 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                        <p class="font-semibold text-gray-900">Vacuum Cleaner Basah & Kering</p>
                                        <p class="text-xs text-gray-400">Merk: Karcher WD 3</p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-600">
                                        Peralatan Kebersihan
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 font-mono font-bold text-gray-800">
                                        2 Unit
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-center">
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 border border-emerald-200">
                                            Baik
                                        </span>
                                    </td>
                                </tr>

                                {{-- Item 5 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                        <p class="font-semibold text-gray-900">Microphone Clip-On Wireless</p>
                                        <p class="text-xs text-gray-400">Merk: Shure SVX288</p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-xs font-medium text-gray-600">
                                        Elektronik & Sound
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 font-mono font-bold text-gray-800">
                                        2 Set
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-center">
                                        <span
                                            class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold text-rose-700 border border-rose-200">
                                            Rusak
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>
