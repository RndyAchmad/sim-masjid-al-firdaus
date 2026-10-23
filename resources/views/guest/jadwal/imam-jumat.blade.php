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
                <div class="mx-auto mb-8 max-w-3xl text-center">
                    <span
                        class="mb-3 inline-flex items-center gap-2 rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm">
                        Pekan Ini
                    </span>

                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                        Petugas Sholat Jumat Terdekat
                    </h2>

                    <p class="mt-2 text-xs text-gray-600 sm:text-sm md:text-base">
                        Informasi petugas Jumat berdasarkan jadwal yang telah ditetapkan.
                    </p>
                </div>

                <div
                    class="overflow-hidden rounded-2xl border border-[#8c6b2d]/30 bg-gradient-to-br from-white via-white to-[#F7F4EE] p-6 shadow-md sm:p-8">
                    @if ($jadwalTerdekat)
                        <div class="grid grid-cols-1 items-center gap-6 md:grid-cols-3">
                            <div class="border-b border-stone-200 pb-4 md:border-b-0 md:border-r md:pb-0 md:pr-6">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">
                                    Hari / Tanggal
                                </span>

                                <p class="mt-1 font-serif text-lg font-bold text-gray-900 sm:text-xl">
                                    {{ \Carbon\Carbon::parse($jadwalTerdekat->date)->locale('id')->translatedFormat('l, d F Y') }}
                                </p>

                                <span
                                    class="mt-2 inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700">
                                    Jadwal Terdekat
                                </span>
                            </div>

                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                    Imam Sholat
                                </span>
                                <p class="mt-1 text-sm font-bold text-gray-900 sm:text-base">
                                    {{ $jadwalTerdekat->imam }}
                                </p>
                            </div>

                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                    Muadzin
                                </span>
                                <p class="mt-1 text-sm font-bold text-gray-900 sm:text-base">
                                    {{ $jadwalTerdekat->muadzin ?: 'Belum ditentukan' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="py-6 text-center">
                            <p class="font-semibold text-gray-800">
                                Belum ada jadwal Jumat mendatang.
                            </p>
                            <p class="mt-1 text-sm text-gray-500">
                                Silakan periksa kembali di lain waktu.
                            </p>
                        </div>
                    @endif
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
                            Daftar Imam & Muadzin Jumat Bulan
                            {{ $namaBulan }} {{ $tahun }}
                        </h2>
                    </div>

                    {{-- Filter Bulan & Tahun --}}
                    <form action="{{ url()->current() }}" method="GET"
                        class="flex flex-wrap items-center justify-center gap-2 sm:justify-end">
                        <select name="bulan" onchange="this.form.submit()"
                            class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm"
                            aria-label="Pilih bulan">
                            @foreach ([
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ] as $nomorBulan => $labelBulan)
                                <option value="{{ $nomorBulan }}" @selected($bulan === $nomorBulan)>
                                    {{ $labelBulan }}
                                </option>
                            @endforeach
                        </select>

                        <select name="tahun" onchange="this.form.submit()"
                            class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm"
                            aria-label="Pilih tahun">
                            @foreach ($tahunTersedia as $opsiTahun)
                                <option value="{{ $opsiTahun }}" @selected((int) $tahun === (int) $opsiTahun)>
                                    {{ $opsiTahun }}
                                </option>
                            @endforeach
                        </select>

                        <noscript>
                            <button type="submit"
                                class="rounded-xl bg-[#8c6b2d] px-4 py-2 text-sm font-semibold text-white">
                                Tampilkan
                            </button>
                        </noscript>
                    </form>
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
                                @forelse ($jadwalImam as $jadwal)
                                    @php
                                        $tanggalJadwal = \Carbon\Carbon::parse($jadwal->date);
                                        $adalahHariIni = $tanggalJadwal->isToday();
                                    @endphp

                                    <tr
                                        class="transition hover:bg-stone-50/80 {{ $adalahHariIni ? 'bg-amber-50/50' : '' }}">
                                        <td
                                            class="whitespace-nowrap px-4 py-3.5 font-medium sm:px-6 sm:py-4 {{ $adalahHariIni ? 'text-[#8c6b2d] font-bold' : 'text-stone-500' }}">
                                            {{ $tanggalJadwal->locale('id')->translatedFormat('d M Y') }}

                                            @if ($adalahHariIni)
                                                <span
                                                    class="ml-1 rounded bg-[#8c6b2d]/10 px-1.5 py-0.5 text-[10px] font-bold uppercase text-[#8c6b2d]">
                                                    Hari Ini
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3.5 font-semibold text-gray-900 sm:px-6 sm:py-4">
                                            {{ $jadwal->imam }}
                                        </td>

                                        <td class="px-4 py-3.5 text-gray-600 sm:px-6 sm:py-4">
                                            {{ $jadwal->muadzin ?: 'Belum ditentukan' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-10 text-center">
                                            <p class="font-semibold text-gray-700">
                                                Belum ada jadwal untuk {{ $namaBulan }} {{ $tahun }}.
                                            </p>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Silakan pilih bulan atau tahun lainnya.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>