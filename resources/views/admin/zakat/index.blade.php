<x-layouts.admin>
    <x-slot name="title">Pencatatan Zakat</x-slot>

    @php
        $summary = $summary ?? [
            'total_fitrah_rice_kg' => 0,
            'total_registrations' => 0,
            'total_souls' => 0,
            'total_mal_cash_amount' => 0,
            'total_infaq_cash_amount' => 0,
        ];
        $hijriYear = (string) ($hijriYear ?? ($latestHijriYear ?? '1448'));
        $availableHijriYears = $availableHijriYears ?? collect();
        $yearOptions = $availableHijriYears->isNotEmpty()
            ? $availableHijriYears
            : collect([$hijriYear]);
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
                    <p class="text-xs text-gray-500">Rekap dan daftar zakat dikelompokkan berdasarkan tahun Islam agar tidak tercampur antar-tahun.</p>
                </div>
            </div>

            <form action="{{ route('admin.zakat.index') }}" method="GET" class="flex items-center gap-2">
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

        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Beras Fitrah</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    {{ number_format((float) ($summary['total_fitrah_rice_kg'] ?? 0), 2, ',', '.') }}
                    <span class="text-sm font-normal text-gray-500">Kg</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    Fitrah khusus beras {{ $hijriYear !== 'all' && $hijriYear !== '' ? '(' . $hijriYear . ' H)' : '(Semua Tahun)' }}
                </p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Pendaftaran Tercatat</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    {{ number_format((int) ($summary['total_registrations'] ?? 0), 0, ',', '.') }}
                    <span class="text-sm font-normal text-gray-500">KK</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    Total {{ number_format((int) ($summary['total_souls'] ?? 0), 0, ',', '.') }} jiwa / orang tercatat
                </p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Zakat Mal (Uang)</p>
                <p class="mt-2 text-2xl font-bold text-[#c49c4d]">
                    Rp {{ number_format((int) ($summary['total_mal_cash_amount'] ?? 0), 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Dicatat per orang (Rupiah)</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Infaq (Uang)</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    Rp {{ number_format((int) ($summary['total_infaq_cash_amount'] ?? 0), 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Dicatat per orang (Rupiah)</p>
            </div>
        </div>

        {{-- Header Aksi & Filter Tanggal/Pencarian --}}
        <div class="space-y-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Daftar Pencatatan Zakat</h2>
                    <p class="text-xs text-gray-500">Diurutkan dari tanggal terbaru, lalu waktu input terbaru jika tanggal sama.</p>
                </div>
                <a href="{{ route('admin.zakat.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Catat Zakat
                </a>
            </div>

            <div class="flex flex-col gap-4 border-t border-gray-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                <form action="{{ route('admin.zakat.index') }}" method="GET"
                    class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">
                    <input type="hidden" name="hijri_year" value="{{ $hijriYear }}">

                    {{-- Input Pencarian --}}
                    <div class="relative w-full sm:max-w-xs">
                        <input type="text" name="search" value="{{ request('search', $search ?? '') }}"
                            placeholder="Cari kepala keluarga, jiwa, atau alamat..."
                            class="w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">

                        <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    {{-- Filter Tanggal --}}
                    <input type="date" name="date" value="{{ request('date', $date ?? '') }}"
                        aria-label="Filter tanggal"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-700 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d] sm:w-auto">

                    {{-- Tombol Filter --}}
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4h18M6 10h12m-9 6h6m-4 4h2" />
                        </svg>
                        Filter
                    </button>

                    {{-- Reset Filter --}}
                    @if (request()->filled('search') || request()->filled('date'))
                        <a href="{{ route('admin.zakat.index', ['hijri_year' => $hijriYear]) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-3.5">Tanggal</th>
                            <th class="px-5 py-3.5">Tahun H</th>
                            <th class="px-5 py-3.5">Kepala Keluarga / Pendaftar</th>
                            <th class="px-5 py-3.5">Jumlah Orang</th>
                            <th class="px-5 py-3.5">Fitrah (Beras)</th>
                            <th class="px-5 py-3.5">Zakat Mal</th>
                            <th class="px-5 py-3.5">Infaq</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($registrations ?? [] as $registration)
                            @php
                                $totalJiwa = $registration->transactions->count();
                                $totalFitrah = $registration->transactions->sum('fitrah_rice_kg');
                                $totalMal = $registration->transactions->sum('mal_cash_amount');
                                $totalInfaq = $registration->transactions->sum('infaq_cash_amount');
                            @endphp
                            <tr class="hover:bg-gray-50/70">
                                <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-900">
                                    {{ $registration->received_date->translatedFormat('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($registration->hijri_year)
                                        <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-1 text-xs font-semibold text-[#9c7832]">
                                            {{ $registration->hijri_year }} H
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-semibold text-gray-900">{{ $registration->head_of_family }}</p>
                                    @if ($registration->address)
                                        <p class="text-xs text-gray-400">{{ $registration->address }}</p>
                                    @endif
                                </td>
                                <td class="px-5 py-4">{{ $totalJiwa }} Orang</td>
                                <td class="px-5 py-4 font-semibold text-gray-900">
                                    {{ number_format((float) $totalFitrah, 2, ',', '.') }} Kg
                                </td>
                                <td class="px-5 py-4 font-medium text-[#c49c4d]">
                                    Rp {{ number_format((int) $totalMal, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-4 font-medium text-gray-900">
                                    Rp {{ number_format((int) $totalInfaq, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <div class="inline-flex items-center gap-1">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.zakat.show', $registration->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="Detail {{ $registration->head_of_family }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.zakat.edit', $registration->id) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit {{ $registration->head_of_family }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.zakat.destroy', $registration->id) }}" method="POST"
                                            data-confirm-title="Hapus data zakat?"
                                            data-confirm="Data pendaftaran atas nama {{ $registration->head_of_family }} beserta rinciannya akan dihapus.">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="Hapus {{ $registration->head_of_family }}">
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
                                <td colspan="8" class="px-5 py-10 text-center text-sm text-gray-400">
                                    Belum ada data pencatatan zakat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($registrations ?? null, 'links'))
                <div class="border-t border-gray-100 px-5 py-4">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
