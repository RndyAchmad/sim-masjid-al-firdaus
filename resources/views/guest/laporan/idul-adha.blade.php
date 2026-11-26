<x-layouts.guest>
    @php
        $hijriYear = (string) ($hijriYear ?? ($latestHijriYear ?? '1448'));
        $availableHijriYears = $availableHijriYears ?? collect();
        $yearOptions = $availableHijriYears->isNotEmpty()
            ? $availableHijriYears
            : collect([$hijriYear]);
        $summary = $summary ?? [
            'sapi_count' => 0,
            'kambing_count' => 0,
            'group_count' => 0,
            'total_infaq' => 0,
        ];
        $cowGroups = $cowGroups ?? collect();
        $goatQurbans = $goatQurbans ?? collect();
        $maxMembers = \App\Models\IdulAdhaCowGroup::MAX_MEMBERS;
        $selfProcuredValue = \App\Enums\ProcurementType::SelfProcured->value;
        $masjidValue = \App\Enums\ProcurementType::Masjid->value;
        $showYearColumn = $hijriYear === 'all';
    @endphp

    {{-- Hero Header --}}
    <div class="relative border-b border-gray-800 bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Transparansi &amp; Syiar Qurban
            </span>

            <h1 class="mt-3 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl">
                Laporan Idul Adha
            </h1>

            <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-gray-400 sm:text-base">
                Rekapitulasi peserta qurban sapi dan kambing, pembagian kelompok sapi, serta infaq Idul Adha Masjid Al-Firdaus.
            </p>

            <div class="mx-auto mt-6 h-px w-20 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent"></div>
        </div>
    </div>

    <div class="min-h-screen bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-7xl space-y-10 px-4 sm:px-6 lg:px-8">

            {{-- Filter Tahun Hijriah & Pencarian --}}
            <form action="{{ url()->current() }}" method="GET"
                class="rounded-2xl border border-stone-200 bg-white p-4 shadow-sm sm:p-5">
                <div class="grid grid-cols-1 gap-3 md:grid-cols-[200px_minmax(0,1fr)_auto_auto]">
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
                                placeholder="Cari nama peserta atau blok/alamat..."
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
                        <a href="{{ url()->current() . ($hijriYear !== '' ? '?hijri_year=' . urlencode($hijriYear) : '') }}"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-stone-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-stone-50 md:w-auto">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- Ringkasan Idul Adha --}}
            <section>
                <div class="mx-auto mb-7 max-w-3xl text-center">
                    <span class="mb-3 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Periode {{ $hijriYear !== 'all' ? $hijriYear . ' H' : 'Semua Tahun' }}
                    </span>

                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Ringkasan Qurban &amp; Infaq
                    </h2>

                    <p class="mt-2 text-sm text-gray-600">
                        Rekapitulasi peserta qurban dan infaq Idul Adha yang tercatat.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Peserta Qurban Sapi
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#8c6b2d]/20 bg-[#8c6b2d]/10 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format((int) ($summary['sapi_count'] ?? 0), 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">orang</span>
                        </p>
                        <p class="mt-2 text-xs text-gray-500">Maks. {{ $maxMembers }} orang per ekor sapi</p>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Qurban Kambing
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format((int) ($summary['kambing_count'] ?? 0), 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">ekor</span>
                        </p>
                        <p class="mt-2 text-xs text-emerald-600">1 orang per ekor kambing</p>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Kelompok Sapi
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-amber-200/70 bg-amber-50 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-3xl font-bold text-gray-900">
                            {{ number_format((int) ($summary['group_count'] ?? 0), 0, ',', '.') }}
                            <span class="font-sans text-xs font-normal text-gray-500">kelompok</span>
                        </p>
                        <p class="mt-2 text-xs text-gray-500">Ekor sapi terdata</p>
                    </div>

                    <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                Total Infaq
                            </span>
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#8c6b2d]/20 bg-[#8c6b2d]/10 text-[#8c6b2d]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-5 font-mono text-2xl font-bold text-[#8c6b2d] sm:text-3xl">
                            Rp {{ number_format((int) ($summary['total_infaq'] ?? 0), 0, ',', '.') }}
                        </p>
                        <p class="mt-2 text-xs text-gray-500">Akumulasi infaq Idul Adha</p>
                    </div>
                </div>
            </section>

            <div class="border-t border-stone-200"></div>

            {{-- Kelompok Sapi --}}
            <section>
                <div class="mb-6">
                    <span class="mb-2 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Pembagian Kelompok Sapi
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Daftar Kelompok Qurban Sapi
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Susunan nama dan alamat peserta pada masing-masing kelompok sapi (maksimal {{ $maxMembers }} orang per kelompok).
                    </p>
                </div>

                @if ($cowGroups->isNotEmpty())
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($cowGroups as $group)
                            @php
                                $memberCount = $group->members->count();
                            @endphp
                            <div class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm">
                                <div class="flex items-start justify-between gap-2 border-b border-stone-100 pb-3">
                                    <div>
                                        <h3 class="font-serif text-lg font-bold text-gray-900">{{ $group->group_name }}</h3>
                                        @if ($showYearColumn)
                                            <p class="text-xs text-gray-400">{{ $group->hijri_year }} H</p>
                                        @endif
                                    </div>
                                    <span class="rounded-full border border-[#8c6b2d]/25 bg-[#8c6b2d]/10 px-3 py-1 text-xs font-semibold text-[#8c6b2d]">
                                        {{ $memberCount }} / {{ $maxMembers }} Orang
                                    </span>
                                </div>

                                <div class="mt-3.5">
                                    @if ($group->members->isNotEmpty())
                                        <ol class="space-y-2 text-sm text-gray-700">
                                            @foreach ($group->members as $member)
                                                <li class="rounded-lg bg-stone-50 px-3 py-2">
                                                    <p class="font-medium text-gray-900">
                                                        {{ $loop->iteration }}. {{ $member->qurban?->person_name ?? '-' }}
                                                    </p>
                                                    @if ($member->qurban?->address)
                                                        <p class="mt-0.5 pl-4 text-xs text-gray-500">
                                                            {{ $member->qurban->address }}
                                                        </p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <p class="py-4 text-center text-xs text-gray-400">Belum ada anggota terdaftar.</p>
                                    @endif
                                </div>

                                @if ($group->notes)
                                    <p class="mt-3.5 border-t border-stone-100 pt-2.5 text-xs text-gray-500">
                                        {{ $group->notes }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl border border-stone-200 bg-white p-8 text-center text-sm text-gray-500 shadow-sm">
                        Belum ada data kelompok sapi untuk periode yang dipilih.
                    </div>
                @endif
            </section>

            <div class="border-t border-stone-200"></div>

            {{-- Rekap Khusus Qurban Kambing --}}
            <section>
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="mb-2 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                            Qurban Kambing
                        </span>
                        <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            Rekap Qurban Kambing
                        </h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Daftar peserta qurban kambing per ekor (1 orang per ekor kambing) untuk periode {{ $hijriYear !== 'all' ? $hijriYear . ' H' : 'Semua Tahun' }}.
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-full border border-emerald-200 bg-emerald-50 px-3.5 py-1.5 text-xs font-semibold text-emerald-700">
                        {{ number_format($goatQurbans->count(), 0, ',', '.') }} Ekor Terdata
                    </span>
                </div>

                @if ($goatQurbans->isNotEmpty())
                    <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-160 text-left text-sm text-gray-600">
                                <thead class="border-b border-stone-200 bg-stone-100 text-xs font-bold uppercase tracking-wider text-gray-700">
                                    <tr>
                                        <th class="px-5 py-4">No</th>
                                        <th class="px-5 py-4">Nama Peserta</th>
                                        @if ($showYearColumn)
                                            <th class="px-5 py-4">Tahun H</th>
                                        @endif
                                        <th class="px-5 py-4">Pengadaan</th>
                                        <th class="px-5 py-4">Alamat / Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-stone-100">
                                    @foreach ($goatQurbans as $goat)
                                        @php
                                            $procType = $goat->procurement_type instanceof \App\Enums\ProcurementType
                                                ? $goat->procurement_type
                                                : ($goat->procurement_type ? \App\Enums\ProcurementType::tryFrom($goat->procurement_type) : null);

                                            $procStyle = match ($procType?->value) {
                                                $selfProcuredValue => 'border-amber-200 bg-amber-50 text-[#8c6b2d]',
                                                $masjidValue => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                                default => 'border-stone-200 bg-stone-100 text-gray-700',
                                            };
                                        @endphp
                                        <tr class="transition hover:bg-stone-50">
                                            <td class="whitespace-nowrap px-5 py-4 font-mono text-xs font-semibold text-gray-500">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-5 py-4 font-semibold text-gray-900">
                                                {{ $goat->person_name }}
                                            </td>
                                            @if ($showYearColumn)
                                                <td class="whitespace-nowrap px-5 py-4 font-mono text-xs font-semibold text-gray-700">
                                                    {{ $goat->hijri_year ? $goat->hijri_year . ' H' : '-' }}
                                                </td>
                                            @endif
                                            <td class="whitespace-nowrap px-5 py-4">
                                                @if ($procType)
                                                    <span class="inline-flex rounded-full border px-3 py-0.5 text-xs font-semibold {{ $procStyle }}">
                                                        {{ $procType->label() }}
                                                    </span>
                                                @else
                                                    <span class="text-xs text-gray-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-4 text-xs text-gray-500">
                                                {{ $goat->address ?: ($goat->notes ?: '-') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="rounded-2xl border border-stone-200 bg-white p-8 text-center text-sm text-gray-500 shadow-sm">
                        Belum ada data qurban kambing untuk periode yang dipilih.
                    </div>
                @endif
            </section>

            <div class="border-t border-stone-200"></div>

            {{-- Daftar Peserta & Infaq --}}
            <section>
                <div class="mb-6">
                    <span class="mb-2 inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white">
                        Data Terdaftar
                    </span>
                    <h2 class="font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Daftar Qurban &amp; Infaq Idul Adha
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Data peserta qurban sapi, kambing, dan penyumbang infaq yang telah tercatat.
                    </p>
                </div>

                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-180 text-left text-sm text-gray-600">
                            <thead class="border-b border-stone-200 bg-stone-100 text-xs font-bold uppercase tracking-wider text-gray-700">
                                <tr>
                                    <th class="px-5 py-4">Nama</th>
                                    @if ($showYearColumn)
                                        <th class="px-5 py-4">Tahun H</th>
                                    @endif
                                    <th class="px-5 py-4">Jenis</th>
                                    <th class="px-5 py-4 text-right">Infaq</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-stone-100">
                                @forelse ($qurbans as $qurban)
                                    @php
                                        $animalType = $qurban->animal_type instanceof \App\Enums\AnimalType
                                            ? $qurban->animal_type
                                            : ($qurban->animal_type ? \App\Enums\AnimalType::tryFrom($qurban->animal_type) : null);

                                        $badgeStyle = match ($animalType?->value) {
                                            \App\Enums\AnimalType::Sapi->value => 'border-amber-200 bg-amber-50 text-[#8c6b2d]',
                                            \App\Enums\AnimalType::Kambing->value => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                                            default => 'border-stone-200 bg-stone-100 text-gray-700',
                                        };
                                    @endphp
                                    <tr class="transition hover:bg-stone-50">
                                        <td class="px-5 py-4">
                                            <p class="font-semibold text-gray-900">{{ $qurban->person_name }}</p>
                                            @if ($qurban->address)
                                                <p class="mt-0.5 text-xs text-gray-500">{{ $qurban->address }}</p>
                                            @endif
                                        </td>
                                        @if ($showYearColumn)
                                            <td class="whitespace-nowrap px-5 py-4 font-mono text-xs font-semibold text-gray-700">
                                                {{ $qurban->hijri_year ? $qurban->hijri_year . ' H' : '-' }}
                                            </td>
                                        @endif
                                        <td class="whitespace-nowrap px-5 py-4">
                                            <span class="inline-flex rounded-full border px-3 py-0.5 text-xs font-semibold {{ $badgeStyle }}">
                                                {{ $animalType ? $animalType->label() : 'Infaq' }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4 text-right font-mono font-semibold text-gray-900">
                                            Rp {{ number_format((int) $qurban->infaq_amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $showYearColumn ? 4 : 3 }}" class="px-5 py-10 text-center text-sm text-gray-400">
                                            Belum ada data Idul Adha yang sesuai dengan filter.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($qurbans, 'links'))
                        <div class="border-t border-stone-100 px-5 py-4">
                            {{ $qurbans->links() }}
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layouts.guest>
