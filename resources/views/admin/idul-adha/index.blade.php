<x-layouts.admin>
    <x-slot name="title">Pencatatan Idul Adha</x-slot>

    @php
        $summary = $summary ?? [
            'sapi_count' => 0,
            'kambing_count' => 0,
            'self_procured_count' => 0,
            'total_infaq' => 0,
        ];
        $hijriYear = (string) ($hijriYear ?? ($latestHijriYear ?? '1448'));
        $availableHijriYears = $availableHijriYears ?? collect();
        $yearOptions = $availableHijriYears->isNotEmpty()
            ? $availableHijriYears
            : collect([$hijriYear]);
        $activeHijriYear = $hijriYear !== 'all' && $hijriYear !== '' ? $hijriYear : ($latestHijriYear ?? '1448');
        $cowGroups = $cowGroups ?? collect();
    @endphp

    <div class="space-y-6">
        {{-- Filter Tahun Hijriah di Paling Atas --}}
        <div class="flex flex-col justify-between gap-4 rounded-xl border border-[#c49c4d]/30 bg-white p-4 shadow-sm sm:flex-row sm:items-center">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#c49c4d]/15 text-[#c49c4d]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d]">Periode Tahun Hijriah</p>
                    <p class="text-xs text-gray-500">Rekap, daftar qurban &amp; infaq, serta kelompok sapi dikelompokkan berdasarkan tahun Hijriah.</p>
                </div>
            </div>

            <form action="{{ route('admin.idul-adha.index') }}" method="GET" class="flex items-center gap-2">
                @if (!empty($search))
                    <input type="hidden" name="search" value="{{ $search }}">
                @endif
                @if (!empty($date))
                    <input type="hidden" name="date" value="{{ $date }}">
                @endif

                <label for="top_hijri_year" class="text-xs font-semibold text-gray-700">Tahun:</label>
                <select id="top_hijri_year" name="hijri_year" onchange="this.form.submit()"
                    class="rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm font-semibold text-gray-900 focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                    @foreach ($yearOptions as $yr)
                        <option value="{{ $yr }}" @selected($hijriYear === (string) $yr)>{{ $yr }} H</option>
                    @endforeach
                    <option value="all" @selected($hijriYear === 'all')>Semua Tahun</option>
                </select>
            </form>
        </div>

        {{-- 1. Card-Card Ringkasan Data Qurban & Infaq --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Qurban Sapi</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    {{ number_format((int) ($summary['sapi_count'] ?? 0), 0, ',', '.') }}
                    <span class="text-sm font-normal text-gray-500">Orang</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    Dikelompokkan maks. {{ \App\Models\IdulAdhaCowGroup::MAX_MEMBERS }} orang / sapi
                </p>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Qurban Kambing</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    {{ number_format((int) ($summary['kambing_count'] ?? 0), 0, ',', '.') }}
                    <span class="text-sm font-normal text-gray-500">Orang</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">1 orang / ekor kambing</p>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Pengadaan Sendiri</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    {{ number_format((int) ($summary['self_procured_count'] ?? 0), 0, ',', '.') }}
                    <span class="text-sm font-normal text-gray-500">Orang</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">Uang penyembelihan &amp; pemeliharaan</p>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Infaq</p>
                <p class="mt-2 text-2xl font-bold text-[#c49c4d]">
                    Rp {{ number_format((int) ($summary['total_infaq'] ?? 0), 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    Periode {{ $hijriYear !== 'all' && $hijriYear !== '' ? $hijriYear . ' H' : 'Semua Tahun' }}
                </p>
            </div>
        </div>

        {{-- 2. Div Tersendiri: Penjelasan Data Pengqurban & Tombol Tambah Data --}}
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div class="space-y-1">
                    <h2 class="text-base font-bold text-gray-900">Data Pengqurban &amp; Infaq</h2>
                    <p class="text-xs text-gray-500">
                        Pencatatan per orang untuk qurban sapi atau kambing (lewat masjid nominal kesepakatan sudah termasuk uang sembelih &amp; pemeliharaan; pengadaan sendiri bayar uang penyembelihan &amp; pemeliharaan) serta infaq Idul Adha.
                    </p>
                </div>

                <a href="{{ route('admin.idul-adha.create') }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Data
                </a>
            </div>
        </div>

        {{-- 3. Filter Pencarian & Tanggal + Tabel Data Pengqurban --}}
        <div class="space-y-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <form action="{{ route('admin.idul-adha.index') }}" method="GET"
                    class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">
                    <input type="hidden" name="hijri_year" value="{{ $hijriYear }}">

                    <div class="relative w-full sm:max-w-xs">
                        <input type="text" name="search" value="{{ request('search', $search ?? '') }}"
                            placeholder="Cari nama orang atau alamat..."
                            class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                        <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <input type="date" name="date" value="{{ request('date', $date ?? '') }}"
                        aria-label="Filter tanggal"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto">

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4h18M6 10h12m-9 6h6m-4 4h2" />
                        </svg>
                        Filter
                    </button>

                    @if (request()->filled('search') || request()->filled('date'))
                        <a href="{{ route('admin.idul-adha.index', ['hijri_year' => $hijriYear]) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-3.5">Tanggal</th>
                            <th class="px-5 py-3.5">Tahun H</th>
                            <th class="px-5 py-3.5">Nama</th>
                            <th class="px-5 py-3.5">Jenis &amp; Pengadaan</th>
                            <th class="px-5 py-3.5 text-right">Nominal Qurban</th>
                            <th class="px-5 py-3.5 text-right">Infaq</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($qurbans ?? [] as $qurban)
                            @php
                                $animalType = $qurban->animal_type instanceof \App\Enums\AnimalType
                                    ? $qurban->animal_type
                                    : ($qurban->animal_type ? \App\Enums\AnimalType::from($qurban->animal_type) : null);

                                $procurementType = $qurban->procurement_type instanceof \App\Enums\ProcurementType
                                    ? $qurban->procurement_type
                                    : ($qurban->procurement_type ? \App\Enums\ProcurementType::from($qurban->procurement_type) : null);

                                $isSelfProcured = $procurementType === \App\Enums\ProcurementType::SelfProcured;
                                $qurbanNominal = $animalType
                                    ? ($isSelfProcured ? (int) $qurban->slaughter_care_fee : (int) $qurban->agreed_amount)
                                    : 0;
                            @endphp
                            <tr class="hover:bg-gray-50/70">
                                <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-900">
                                    {{ $qurban->received_date?->translatedFormat('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($qurban->hijri_year)
                                        <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-1 text-xs font-semibold text-[#9c7832]">
                                            {{ $qurban->hijri_year }} H
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-gray-900">{{ $qurban->person_name }}</p>
                                    @if ($qurban->address)
                                        <p class="text-xs text-gray-400">{{ $qurban->address }}</p>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if ($animalType)
                                        <div class="flex flex-wrap items-center gap-1.5 text-xs">
                                            <span class="rounded-md px-2 py-0.5 font-semibold {{ $animalType->badgeClass() }}">
                                                {{ $animalType->label() }}
                                            </span>
                                            @if ($procurementType)
                                                <span class="rounded-md px-2 py-0.5 font-medium {{ $procurementType->badgeClass() }}">
                                                    {{ $procurementType->label() }}
                                                </span>
                                            @endif
                                            @if ($animalType === \App\Enums\AnimalType::Sapi && $qurban->cowGroupMember?->group)
                                                <span class="rounded-md bg-gray-100 px-2 py-0.5 font-medium text-gray-700">
                                                    {{ $qurban->cowGroupMember->group->group_name }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">Hanya Infaq</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-right">
                                    @if ($animalType)
                                        @if ($isSelfProcured)
                                            <span class="font-medium text-gray-700">
                                                Rp {{ number_format($qurbanNominal, 0, ',', '.') }}
                                            </span>
                                            <span class="block text-[11px] text-gray-400">Sembelih &amp; rawat</span>
                                        @else
                                            <span class="font-semibold text-[#c49c4d]">
                                                Rp {{ number_format($qurbanNominal, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-right font-semibold text-gray-900">
                                    Rp {{ number_format((int) $qurban->infaq_amount, 0, ',', '.') }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-right">
                                    <div class="inline-flex items-center gap-1">
                                        <a href="{{ route('admin.idul-adha.show', $qurban->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="Detail {{ $qurban->person_name }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.idul-adha.edit', $qurban->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit {{ $qurban->person_name }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.idul-adha.destroy', $qurban->id) }}" method="POST"
                                            data-confirm-title="Hapus data Idul Adha?"
                                            data-confirm="Data atas nama {{ $qurban->person_name }} akan dihapus.">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="Hapus {{ $qurban->person_name }}">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-10 text-center text-sm text-gray-400">
                                    Belum ada data pencatatan Idul Adha.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($qurbans ?? null, 'links'))
                <div class="border-t border-gray-100 px-5 py-4">
                    {{ $qurbans->links() }}
                </div>
            @endif
        </div>

        {{-- 4. Div Tersendiri: Kelola Data Kelompok Sapi --}}
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div class="space-y-1">
                    <h2 class="text-base font-bold text-gray-900">Kelola Data Kelompok Sapi</h2>
                    <p class="text-xs text-gray-500">
                        Atur pengelompokan peserta qurban sapi per ekor (maksimal {{ \App\Models\IdulAdhaCowGroup::MAX_MEMBERS }} orang per sapi). Kambing tidak dikelompokkan.
                    </p>
                </div>

                <a href="{{ route('admin.idul-adha.kelompok-sapi.index', ['hijri_year' => $activeHijriYear]) }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                    Kelola Kelompok Sapi
                </a>
            </div>
        </div>

        {{-- 5. Tabel Khusus Pengelompokan Sapi --}}
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-3.5">Kelompok Sapi</th>
                            <th class="px-5 py-3.5">Tahun H</th>
                            <th class="px-5 py-3.5">Jumlah Orang</th>
                            <th class="px-5 py-3.5">Daftar Nama</th>
                            <th class="px-5 py-3.5">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($cowGroups as $group)
                            @php
                                $memberCount = $group->members->count();
                                $maxMembers = \App\Models\IdulAdhaCowGroup::MAX_MEMBERS;
                            @endphp
                            <tr class="hover:bg-gray-50/70">
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-gray-900">
                                    {{ $group->group_name }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-1 text-xs font-semibold text-[#9c7832]">
                                        {{ $group->hijri_year }} H
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-gray-900">
                                    {{ $memberCount }} / {{ $maxMembers }} Orang
                                </td>
                                <td class="px-5 py-4">
                                    @if ($group->members->isNotEmpty())
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($group->members as $member)
                                                <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-800">
                                                    {{ $loop->iteration }}. {{ $member->qurban?->person_name ?? '-' }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">Belum ada anggota</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-xs text-gray-500">
                                    {{ $group->notes ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center text-sm text-gray-400">
                                    Belum ada data kelompok sapi untuk tahun Hijriah yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @php
            $goatQurbans = $goatQurbans ?? collect();
        @endphp

        {{-- Tabel Khusus Data Kambing --}}
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-2 border-b border-gray-100 px-5 py-4 sm:flex-row sm:items-center">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Rekap Qurban Kambing</h3>
                    <p class="text-xs text-gray-500">1 orang per ekor kambing (tidak dikelompokkan).</p>
                </div>
                <span class="inline-flex w-fit rounded-lg bg-[#c49c4d]/15 px-2.5 py-1 text-xs font-semibold text-[#9c7832]">
                    {{ $goatQurbans->count() }} Ekor / Orang
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-3.5">No</th>
                            <th class="px-5 py-3.5">Nama</th>
                            <th class="px-5 py-3.5">Tahun H</th>
                            <th class="px-5 py-3.5">Pengadaan</th>
                            <th class="px-5 py-3.5 text-right">Nominal / Biaya</th>
                            <th class="px-5 py-3.5">Alamat / Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($goatQurbans as $goat)
                            @php
                                $procType = $goat->procurement_type instanceof \App\Enums\ProcurementType
                                    ? $goat->procurement_type
                                    : ($goat->procurement_type ? \App\Enums\ProcurementType::from($goat->procurement_type) : null);
                                $isSelf = $procType === \App\Enums\ProcurementType::SelfProcured;
                                $nominal = $isSelf ? (int) $goat->slaughter_care_fee : (int) $goat->agreed_amount;
                            @endphp
                            <tr class="hover:bg-gray-50/70">
                                <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-4 font-semibold text-gray-900">
                                    {{ $goat->person_name }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($goat->hijri_year)
                                        <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-1 text-xs font-semibold text-[#9c7832]">
                                            {{ $goat->hijri_year }} H
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($procType)
                                        <span class="rounded-md px-2 py-0.5 text-xs font-medium {{ $procType->badgeClass() }}">
                                            {{ $procType->label() }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4 text-right">
                                    <span class="font-semibold {{ $isSelf ? 'text-gray-700' : 'text-[#c49c4d]' }}">
                                        Rp {{ number_format($nominal, 0, ',', '.') }}
                                    </span>
                                    @if ($isSelf)
                                        <span class="block text-[11px] text-gray-400">Sembelih &amp; rawat</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-xs text-gray-500">
                                    {{ $goat->address ?: ($goat->notes ?: '-') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">
                                    Belum ada data qurban kambing untuk tahun Hijriah yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
