<x-layouts.guest>
    @php
        $hijriYear = (string) ($hijriYear ?? ($latestHijriYear ?? '1448'));
        $availableHijriYears = $availableHijriYears ?? collect();
        $yearOptions = $availableHijriYears->isNotEmpty()
            ? $availableHijriYears
            : collect([$hijriYear]);
        $summary = $summary ?? [
            'total_fitrah_rice_kg' => 0,
            'total_registrations' => 0,
            'total_souls' => 0,
            'total_mal_cash_amount' => 0,
            'total_infaq_cash_amount' => 0,
        ];
        $registrations = $registrations ?? collect();
        $showYearColumn = $hijriYear === 'all';
    @endphp

    {{-- Hero Header --}}
    <div class="relative border-b border-gray-800 bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Transparansi &amp; Amanah Jamaah
            </span>

            <h1 class="mt-3 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl">
                Laporan Zakat
            </h1>

            <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-gray-400 sm:text-base">
                Rekapitulasi penerimaan zakat fitrah (beras), zakat mal, dan infaq yang dikelompokkan per tahun Hijriah di Masjid Al-Firdaus.
            </p>

            <div class="mx-auto mt-6 h-px w-20 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent"></div>
        </div>
    </div>

    <div class="min-h-screen bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-7xl space-y-10 px-4 sm:px-6 lg:px-8">

            {{-- Filter Tahun Hijriah, Tanggal & Pencarian --}}
            <form action="{{ route('laporan.zakat') }}" method="GET"
                class="rounded-2xl border border-stone-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-[180px_180px_minmax(0,1fr)_auto_auto]">
                    <div>
                        <label for="hijri_year" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Tahun Hijriah
                        </label>
                        <select id="hijri_year" name="hijri_year" onchange="this.form.submit()"
                            class="w-full rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-sm font-semibold text-gray-800 focus:border-[#8c6b2d] focus:outline-none focus:ring-2 focus:ring-[#8c6b2d]/20">
                            @foreach ($yearOptions as $yr)
                                <option value="{{ $yr }}" @selected($hijriYear === (string) $yr)>{{ $yr }} H</option>
                            @endforeach
                            <option value="all" @selected($hijriYear === 'all')>Semua Tahun</option>
                        </select>
                    </div>

                    <div>
                        <label for="date" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Tanggal
                        </label>
                        <input type="date" id="date" name="date" value="{{ $date ?? request('date') }}"
                            class="w-full rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-sm text-gray-800 focus:border-[#8c6b2d] focus:outline-none focus:ring-2 focus:ring-[#8c6b2d]/20">
                    </div>

                    <div>
                        <label for="search" class="mb-1.5 block text-xs font-semibold text-gray-700">
                            Cari Nama / Alamat
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-4.35-4.35M19 10.5a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z" />
                            </svg>
                            <input type="text" id="search" name="search" value="{{ $search ?? request('search') }}"
                                placeholder="Cari kepala keluarga, nama jiwa, atau alamat..."
                                class="w-full rounded-xl border border-stone-200 py-2.5 pl-10 pr-3 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#8c6b2d] focus:outline-none focus:ring-2 focus:ring-[#8c6b2d]/20">
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full rounded-xl bg-[#8c6b2d] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#6e5321]">
                            Terapkan
                        </button>
                    </div>

                    <div class="flex items-end">
                        <a href="{{ route('laporan.zakat', ['hijri_year' => $hijriYear]) }}"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-stone-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-stone-50 md:w-auto">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- Ringkasan Zakat --}}
            <section>
                <div class="mx-auto mb-7 max-w-3xl text-center">
                    <span class="mb-3 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Periode {{ $hijriYear !== 'all' ? $hijriYear . ' H' : 'Semua Tahun' }}
                    </span>

                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Ringkasan Penerimaan Zakat &amp; Infaq
                    </h2>

                    <p class="mt-2 text-sm text-gray-600">
                        Akumulasi beras fitrah, jumlah pendaftaran dan jiwa, zakat mal, serta infaq sesuai periode terpilih.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Total Beras Fitrah
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#8c6b2d]/20 bg-[#8c6b2d]/10 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format((float) ($summary['total_fitrah_rice_kg'] ?? 0), 2, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">Kg</span>
                        </p>
                        <p class="mt-2 text-xs text-gray-500">Zakat fitrah dalam bentuk beras</p>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Pendaftaran Tercatat
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format((int) ($summary['total_registrations'] ?? 0), 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">KK</span>
                        </p>
                        <p class="mt-2 text-xs text-emerald-600">
                            Total {{ number_format((int) ($summary['total_souls'] ?? 0), 0, ',', '.') }} jiwa / orang
                        </p>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Total Zakat Mal
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-amber-200/70 bg-amber-50 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-2xl font-bold text-[#8c6b2d] sm:text-3xl">
                            Rp {{ number_format((int) ($summary['total_mal_cash_amount'] ?? 0), 0, ',', '.') }}
                        </p>
                        <p class="mt-2 text-xs text-gray-500">Dicatat per orang (Rupiah)</p>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Total Infaq
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#8c6b2d]/20 bg-[#8c6b2d]/10 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                            Rp {{ number_format((int) ($summary['total_infaq_cash_amount'] ?? 0), 0, ',', '.') }}
                        </p>
                        <p class="mt-2 text-xs text-gray-500">Dicatat per orang (Rupiah)</p>
                    </div>
                </div>
            </section>

            <div class="border-t border-stone-200"></div>

            {{-- Daftar Pencatatan Zakat --}}
            <section>
                <div class="mb-6">
                    <span class="mb-2 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Rincian Data
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Daftar Penerimaan Zakat &amp; Infaq
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Klik tombol <span class="font-semibold text-gray-800">Rincian</span> untuk melihat pembagian per jiwa / per orang.
                    </p>
                </div>

                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="border-b border-stone-200 bg-stone-50 text-xs font-semibold uppercase text-gray-500">
                                <tr>
                                    <th class="px-5 py-3.5">Tanggal</th>
                                    @if ($showYearColumn)
                                        <th class="px-5 py-3.5">Tahun H</th>
                                    @endif
                                    <th class="px-5 py-3.5">Kepala Keluarga / Pendaftar</th>
                                    <th class="px-5 py-3.5">Jumlah Orang</th>
                                    <th class="px-5 py-3.5">Fitrah (Beras)</th>
                                    <th class="px-5 py-3.5">Zakat Mal</th>
                                    <th class="px-5 py-3.5">Infaq</th>
                                    <th class="px-5 py-3.5 text-right">Rincian</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @forelse ($registrations as $registration)
                                    @php
                                        $totalJiwa = $registration->transactions->count();
                                        $totalFitrah = $registration->transactions->sum('fitrah_rice_kg');
                                        $totalMal = $registration->transactions->sum('mal_cash_amount');
                                        $totalInfaq = $registration->transactions->sum('infaq_cash_amount');
                                    @endphp
                                    <tbody x-data="{ open: false }" class="divide-y divide-stone-100">
                                        <tr class="transition hover:bg-stone-50/80">
                                            <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-900">
                                                {{ $registration->received_date->translatedFormat('d M Y') }}
                                            </td>
                                            @if ($showYearColumn)
                                                <td class="whitespace-nowrap px-5 py-4">
                                                    @if ($registration->hijri_year)
                                                        <span class="inline-flex rounded-lg bg-[#8c6b2d]/10 px-2.5 py-1 text-xs font-semibold text-[#8c6b2d]">
                                                            {{ $registration->hijri_year }} H
                                                        </span>
                                                    @else
                                                        <span class="text-xs text-gray-400">-</span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td class="px-5 py-4">
                                                <p class="font-semibold text-gray-900">{{ $registration->head_of_family }}</p>
                                                @if ($registration->address)
                                                    <p class="text-xs text-gray-500">{{ $registration->address }}</p>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-5 py-4">{{ $totalJiwa }} Orang</td>
                                            <td class="whitespace-nowrap px-5 py-4 font-semibold text-gray-900">
                                                {{ number_format((float) $totalFitrah, 2, ',', '.') }} Kg
                                            </td>
                                            <td class="whitespace-nowrap px-5 py-4 font-medium text-[#8c6b2d]">
                                                Rp {{ number_format((int) $totalMal, 0, ',', '.') }}
                                            </td>
                                            <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-900">
                                                Rp {{ number_format((int) $totalInfaq, 0, ',', '.') }}
                                            </td>
                                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                                <button type="button" @click="open = !open"
                                                    class="inline-flex items-center gap-1 rounded-lg border border-stone-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:border-[#8c6b2d] hover:text-[#8c6b2d]">
                                                    <span x-text="open ? 'Tutup' : 'Rincian'"></span>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr x-show="open" x-cloak class="bg-[#FBF9F5]">
                                            <td colspan="{{ $showYearColumn ? 8 : 7 }}" class="px-5 py-4">
                                                <div class="rounded-xl border border-stone-200 bg-white p-4">
                                                    <p class="mb-2.5 text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">
                                                        Rincian Per Jiwa — {{ $registration->head_of_family }}
                                                    </p>
                                                    <div class="overflow-x-auto">
                                                        <table class="w-full text-left text-xs text-gray-600">
                                                            <thead class="border-b border-stone-100 text-gray-500">
                                                                <tr>
                                                                    <th class="py-2 pr-4">#</th>
                                                                    <th class="py-2 pr-4">Nama</th>
                                                                    <th class="py-2 pr-4">Fitrah (Kg)</th>
                                                                    <th class="py-2 pr-4">Zakat Mal (Rp)</th>
                                                                    <th class="py-2">Infaq (Rp)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="divide-y divide-stone-100">
                                                                @foreach ($registration->transactions as $idx => $trx)
                                                                    <tr>
                                                                        <td class="py-2 pr-4 text-gray-400">{{ $idx + 1 }}</td>
                                                                        <td class="py-2 pr-4 font-semibold text-gray-900">{{ $trx->person_name }}</td>
                                                                        <td class="py-2 pr-4 font-semibold text-[#8c6b2d]">
                                                                            {{ number_format((float) $trx->fitrah_rice_kg, 2, ',', '.') }} Kg
                                                                        </td>
                                                                        <td class="py-2 pr-4">
                                                                            Rp {{ number_format((int) $trx->mal_cash_amount, 0, ',', '.') }}
                                                                        </td>
                                                                        <td class="py-2">
                                                                            Rp {{ number_format((int) $trx->infaq_cash_amount, 0, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <tr>
                                        <td colspan="{{ $showYearColumn ? 8 : 7 }}" class="px-5 py-10 text-center text-sm text-gray-400">
                                            Belum ada data pencatatan zakat untuk periode atau filter ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($registrations, 'links'))
                        <div class="border-t border-stone-200 px-5 py-4">
                            {{ $registrations->links() }}
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </div>
</x-layouts.guest>
