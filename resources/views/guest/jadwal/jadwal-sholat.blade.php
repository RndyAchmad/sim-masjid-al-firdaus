<x-layouts.guest>
    {{-- Header Banner --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Waktu Ibadah Resmi Kemenag RI
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Jadwal Sholat {{ $lokasi }}
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Jadwal waktu sholat fardhu, imsakiyah, dan dhuha untuk wilayah Kabupaten Sidoarjo
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-10 sm:space-y-14">

            {{-- 1. HIGHLIGHT SHOLAT HARI INI --}}
            @if($jadwalHariIni)
                <section>
                    <div class="mb-6 text-center max-w-3xl mx-auto">
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            {{ $jadwalHariIni['tanggal'] ?? date('d M Y') }}
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Waktu Sholat Hari Ini
                        </h2>
                    </div>

                    {{-- Grid Cards Waktu Sholat --}}
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">

                        @php
                            $prayers = [
                                'imsak' => ['label' => 'Imsak', 'val' => $jadwalHariIni['imsak'] ?? '-'],
                                'subuh' => ['label' => 'Subuh', 'val' => $jadwalHariIni['subuh'] ?? '-'],
                                'dzuhur' => ['label' => 'Dzuhur', 'val' => $jadwalHariIni['dzuhur'] ?? '-'],
                                'ashar' => ['label' => 'Ashar', 'val' => $jadwalHariIni['ashar'] ?? '-'],
                                'maghrib' => ['label' => 'Maghrib', 'val' => $jadwalHariIni['maghrib'] ?? '-'],
                                'isya' => ['label' => 'Isya', 'val' => $jadwalHariIni['isya'] ?? '-'],
                            ];
                        @endphp

                        @foreach($prayers as $key => $p)
                            @php $isActive = ($activePrayer === $key); @endphp
                            <div
                                class="rounded-2xl border p-4 text-center transition-all duration-300 {{ $isActive ? 'border-[#8c6b2d] bg-[#F7F4EE] shadow-md ring-1 ring-[#8c6b2d]' : 'border-stone-200 bg-white shadow-sm hover:border-[#8c6b2d]' }}">
                                <span
                                    class="text-[11px] font-bold uppercase tracking-wider {{ $isActive ? 'text-[#8c6b2d]' : 'text-gray-400' }}">
                                    {{ $p['label'] }}
                                </span>
                                <p
                                    class="mt-1.5 font-mono text-xl sm:text-2xl font-bold {{ $isActive ? 'text-[#8c6b2d]' : 'text-gray-800' }}">
                                    {{ $p['val'] }}
                                </p>
                                <span
                                    class="text-[10px] {{ $isActive ? 'text-[#8c6b2d] font-semibold' : 'text-gray-400 font-medium' }}">
                                    WIB
                                </span>
                            </div>
                        @endforeach

                    </div>
                </section>
            @endif

            {{-- 2. TABEL SHOLAT BULANAN --}}
            <section class="space-y-6">

                {{-- Form Filter Periode --}}
                <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm border border-[#6e5321] mb-2">
                            Agenda Bulanan
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Jadwal Sholat Sebulan
                        </h2>
                    </div>

                    <form method="GET" action="{{ route('jadwal.sholat') }}" class="flex items-center gap-2">
                        <select name="month" onchange="this.form.submit()"
                            class="rounded-xl border border-stone-200 bg-white px-3.5 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            @foreach([
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember'
                                ] as $num => $title)
                                <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>

                        <select name="year" onchange="this.form.submit()"
                            class="rounded-xl border border-stone-200 bg-white px-3.5 py-2 text-xs font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:text-sm">
                            @foreach([date('Y') - 1, date('Y'), date('Y') + 1] as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                {{-- Tabel Data --}}
                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md">
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-center text-xs sm:text-sm text-gray-600">

                            <thead
                                class="bg-stone-100 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-gray-700 border-b border-stone-200">
                                <tr>
                                    <th
                                        class="sticky left-0 z-20 bg-stone-100 px-4 py-3.5 text-left shadow-sm sm:px-6 sm:py-4">
                                        Tanggal</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Imsak</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Subuh</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Terbit</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Dhuha</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Dzuhur</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Ashar</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Maghrib</th>
                                    <th class="px-3 py-3.5 sm:px-4 sm:py-4">Isya</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-stone-100 font-mono">
                                @forelse($jadwalBulanan as $item)
                                                                    @php
                                                                        $today = now('Asia/Jakarta')->toDateString();

                                                                        $itemDate = $item['date'] ?? null;

                                                                        // Jika API menggunakan format tanggal DD/MM/YYYY
                                                                        if (empty($itemDate) && !empty($item['tanggal'])) {
                                                                            if (preg_match('/(\d{2})\/(\d{2})\/(\d{4})/', $item['tanggal'], $matches)) {
                                                                                $itemDate = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
                                                                            }
                                                                        }

                                                                        $isToday = $itemDate === $today;
                                                                    @endphp
                                                                    <tr class="{{ $isToday
                                                                                ? 'bg-amber-100 font-bold'
                                                                                : 'bg-white hover:bg-stone-50'
                                                                        }} transition-colors duration-200">
                                                                        <td class="sticky left-0 z-10 whitespace-nowrap {{ $isToday
                                                                                ? 'bg-amber-100 text-amber-900 border-l-4 border-amber-600'
                                                                                : 'bg-white text-gray-900'
                                                                            }} px-4 py-3.5 text-left font-sans font-semibold shadow-sm sm:px-6">
                                                                            <div class="flex items-center gap-1.5">
                                                                                @if($isToday)
                                                                                    <span class="h-2 w-2 rounded-full bg-amber-600"></span>
                                                                                @endif
                                                                                <span>{{ $item['tanggal'] ?? '' }}</span>
                                                                            </div>
                                                                        </td>

                                                                        <td class="px-3 py-3.5 text-gray-400">{{ $item['imsak'] ?? '-' }}</td>
                                                                        <td class="px-3 py-3.5 font-semibold text-gray-800">{{ $item['subuh'] ?? '-' }}</td>
                                                                        <td class="px-3 py-3.5 text-gray-400">{{ $item['terbit'] ?? '-' }}</td>
                                                                        <td class="px-3 py-3.5 text-gray-600">{{ $item['dhuha'] ?? '-' }}</td>
                                                                        <td class="px-3 py-3.5 font-bold text-[#8c6b2d]">{{ $item['dzuhur'] ?? '-' }}</td>
                                                                        <td class="px-3 py-3.5 font-semibold text-gray-800">{{ $item['ashar'] ?? '-' }}</td>
                                                                        <td class="px-3 py-3.5 font-bold text-emerald-700">{{ $item['maghrib'] ?? '-' }}
                                                                        </td>
                                                                        <td class="px-3 py-3.5 font-semibold text-gray-800">{{ $item['isya'] ?? '-' }}</td>
                                                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="py-12 text-center text-gray-500 font-sans">
                                            <span>Gagal memuat data jadwal sholat. Silakan muat ulang halaman.</span>
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