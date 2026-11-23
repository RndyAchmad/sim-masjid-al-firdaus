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
    @endphp

    <div class="space-y-6">
        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Beras Fitrah</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    {{ number_format((float) ($summary['total_fitrah_rice_kg'] ?? 0), 2, ',', '.') }}
                    <span class="text-sm font-normal text-gray-500">Kg</span>
                </p>
                <p class="mt-1 text-xs text-gray-400">Fitrah khusus beras (tanpa uang)</p>
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

        {{-- Header Aksi --}}
        <div class="flex flex-col justify-between gap-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center">
            <div>
                <h2 class="text-base font-bold text-gray-900">Daftar Pencatatan Zakat</h2>
                <p class="text-xs text-gray-500">Diurutkan dari tanggal terbaru, lalu waktu input (`created_at`) terbaru jika tanggal sama.</p>
            </div>
            <a href="{{ route('admin.zakat.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Catat Zakat
            </a>
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-3.5">Tanggal</th>
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
                                        <a href="{{ route('admin.zakat.show', $registration) }}"
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
                                        <a href="{{ route('admin.zakat.edit', $registration) }}"
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="Edit {{ $registration->head_of_family }}">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.zakat.destroy', $registration) }}" method="POST"
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
                                <td colspan="7" class="px-5 py-10 text-center text-sm text-gray-400">
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
