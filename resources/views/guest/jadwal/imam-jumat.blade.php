<x-layouts.guest>
    {{-- Header Banner Halaman Jadwal Jumat --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Syiar & Pelayanan Ibadah
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Jadwal Imam & Muadzin Jumat
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Informasi petugas imam sholat jumat dan muadzin Masjid Al-Firdaus
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section (Background Krem Sejuk / Off-White) --}}
    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-12 sm:space-y-16">

            {{-- 1. SECTION HIGHLIGHT PETUGAS JUMAT MINGGU INI --}}
            <section>
                <div class="mb-8 text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-3">
                        Pekan Ini
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                        Petugas Sholat Jumat Terdekat
                    </h2>
                    <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                        Jadwal pelayanan sholat Jumat untuk tanggal 23 Oktober 2026.
                    </p>
                </div>

                {{-- Highlight Card --}}
                <div
                    class="overflow-hidden rounded-2xl border border-[#8c6b2d]/30 bg-linear-to-br from-white via-white to-[#F7F4EE] p-6 sm:p-8 shadow-md">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3 items-center">
                        <div class="border-b md:border-b-0 md:border-r border-stone-200 pb-4 md:pb-0 md:pr-6">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">Hari /
                                Tanggal</span>
                            <p class="mt-1 font-serif text-lg font-bold text-gray-900 sm:text-xl">
                                Jumat, 23 Okt 2026
                            </p>
                            <span
                                class="inline-flex mt-2 items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 border border-emerald-200">
                                Berlangsung Pekan Ini
                            </span>
                        </div>

                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Imam Sholat</span>
                            <p class="mt-1 text-sm sm:text-base font-bold text-gray-900">
                                Ust. H. Muhammad Ridwan
                            </p>
                        </div>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Muadzin</span>
                            <p class="mt-1 text-sm sm:text-base font-bold text-gray-900">
                                Bpk. M. Fajar Al-Fatih
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Separator Pembatas --}}
            <div class="border-t border-stone-200/80"></div>

            {{-- 2. SECTION TABEL JADWAL BULANAN --}}
            <section>
                {{-- Header & Filter Periode --}}
                <div class="mb-8 flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                            Agenda Bulanan
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Daftar Imam & Muadzin Jumat Bulan Ini
                        </h2>
                    </div>

                    {{-- Filter Bulan & Tahun --}}
                    <div class="flex items-center gap-2">
                        <select
                            class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            <option value="10">Oktober</option>
                            <option value="09">September</option>
                            <option value="08">Agustus</option>
                        </select>
                        <select
                            class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>

                {{-- Tabel Jadwal Responsif --}}
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs sm:text-sm text-gray-600">
                            <thead
                                class="bg-stone-100 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-stone-200">
                                <tr>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Tanggal</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Imam Sholat</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Muadzin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 bg-white font-sans">

                                {{-- Baris 1 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        02 Okt 2026
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Ust. H. Abdullah Faqih, Lc.
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-gray-600">
                                        Bpk. Zainal Arifin
                                    </td>
                                </tr>

                                {{-- Baris 2 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        09 Okt 2026
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Ust. Muhammad Ridwan
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-gray-600">
                                        Bpk. H. Sutrisno
                                    </td>
                                </tr>

                                {{-- Baris 3 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        16 Okt 2026
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Ust. Drs. H. M. Sholeh, M.Pd.I
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-gray-600">
                                        Bpk. Rahmat Hidayat
                                    </td>
                                </tr>

                                {{-- Baris 4 (Pekan Ini) --}}
                                <tr class="bg-amber-50/30 transition hover:bg-stone-50/80">
                                    <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-[#8c6b2d] font-bold">
                                        23 Okt 2026 <span
                                            class="text-[10px] uppercase bg-[#8c6b2d]/10 text-[#8c6b2d] px-1.5 py-0.5 rounded ml-1">Ini</span>
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Ust. H. Muhammad Ridwan
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-gray-600">
                                        Bpk. M. Fajar Al-Fatih
                                    </td>
                                </tr>

                                {{-- Baris 5 --}}
                                <tr class="transition hover:bg-stone-50/80">
                                    <td
                                        class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4 text-stone-500 font-medium">
                                        30 Okt 2026
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 font-semibold text-gray-900">
                                        Ust. H. Ahmad Fuzairi, S.Pd.I
                                    </td>
                                    <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-gray-600">
                                        Bpk. Wahyu Prasetyo
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
