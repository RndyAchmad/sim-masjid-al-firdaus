<x-layouts.admin>
    <x-slot name="title">Detail Pencatatan Zakat</x-slot>
    <x-slot name="backUrl">{{ route('admin.zakat.index', $registration->hijri_year ? ['hijri_year' => $registration->hijri_year] : []) }}</x-slot>

    @php
        $transactions = $registration->transactions;
        $totalPeople = $transactions->count();
        $totalFitrahKg = (float) $transactions->sum('fitrah_rice_kg');
        $totalMalRp = (int) $transactions->sum('mal_cash_amount');
        $totalInfaqRp = (int) $transactions->sum('infaq_cash_amount');
        $totalCashRp = $totalMalRp + $totalInfaqRp;
    @endphp

    <div class="space-y-6">
        {{-- Header & Tombol Aksi --}}
        <div
            class="flex flex-col justify-between gap-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:flex-row sm:items-center">
            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d]">Informasi Pendaftaran</p>
                    @if ($registration->hijri_year)
                        <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-0.5 text-xs font-semibold text-[#9c7832]">
                            {{ $registration->hijri_year }} H
                        </span>
                    @endif
                </div>
                <h2 class="mt-1 text-xl font-bold text-gray-900">{{ $registration->head_of_family }}</h2>
                <p class="mt-1 text-xs text-gray-500">
                    Tanggal Penerimaan: <span
                        class="font-semibold text-gray-700">{{ $registration->received_date->translatedFormat('d M Y') }}</span>
                    @if ($registration->hijri_year)
                        <span class="mx-1.5">•</span>
                        Tahun Hijriah: <span class="font-semibold text-gray-700">{{ $registration->hijri_year }} H</span>
                    @endif
                    @if ($registration->address)
                        <span class="mx-1.5">•</span>
                        Alamat: <span class="font-semibold text-gray-700">{{ $registration->address }}</span>
                    @endif
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.zakat.edit', $registration->id) }}"
                    class="inline-flex items-center gap-1.5 rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data
                </a>

                <form action="{{ route('admin.zakat.destroy', $registration->id) }}" method="POST"
                    data-confirm-title="Hapus data zakat?"
                    data-confirm="Data pendaftaran atas nama {{ $registration->head_of_family }} beserta seluruh rinciannya akan dihapus.">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-600 hover:text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Ringkasan Pendaftaran --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Jumlah Jiwa / Orang</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalPeople }} <span
                        class="text-sm font-normal text-gray-500">Orang</span></p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Fitrah (Beras)</p>
                <p class="mt-2 text-2xl font-bold text-[#c49c4d]">
                    {{ number_format($totalFitrahKg, 2, ',', '.') }} <span
                        class="text-sm font-normal text-gray-500">Kg</span>
                </p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Zakat Mal</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    Rp {{ number_format($totalMalRp, 0, ',', '.') }}
                </p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Infaq</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    Rp {{ number_format($totalInfaqRp, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Tabel Rincian Per Jiwa / Per Orang --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="border-b border-gray-100 p-6">
                <h3 class="text-base font-bold text-gray-900">Rincian Per Jiwa / Per Orang</h3>
                <p class="mt-0.5 text-xs text-gray-500">Zakat fitrah dalam bentuk beras (Kg), sedangkan zakat mal dan
                    infaq dalam Rupiah (Rp).</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-175 text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="w-14 px-4 py-3 text-center">#</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="w-40 px-4 py-3">Zakat Fitrah (Kg)</th>
                            <th class="w-48 px-4 py-3">Mal (Rp)</th>
                            <th class="w-48 px-4 py-3">Infaq (Rp)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($transactions as $index => $trx)
                            <tr class="hover:bg-gray-50/60">
                                <td class="px-4 py-3.5 text-center font-medium text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-3.5 font-semibold text-gray-900">{{ $trx->person_name }}</td>
                                <td class="px-4 py-3.5 font-semibold text-[#c49c4d]">
                                    {{ number_format((float) $trx->fitrah_rice_kg, 2, ',', '.') }} Kg
                                </td>
                                <td class="px-4 py-3.5 font-medium text-gray-900">
                                    Rp {{ number_format((int) $trx->mal_cash_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3.5 font-medium text-gray-900">
                                    Rp {{ number_format((int) $trx->infaq_cash_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-400">
                                    Tidak ada rincian transaksi pada pendaftaran ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="border-t border-gray-200 bg-[#c49c4d]/10 text-sm font-bold text-gray-900">
                        <tr>
                            <td colspan="2" class="px-4 py-3.5">Total ({{ $totalPeople }} orang)</td>
                            <td class="px-4 py-3.5 text-[#c49c4d]">{{ number_format($totalFitrahKg, 2, ',', '.') }} Kg
                            </td>
                            <td class="px-4 py-3.5 text-[#c49c4d]">Rp {{ number_format($totalMalRp, 0, ',', '.') }}</td>
                            <td class="px-4 py-3.5">Rp {{ number_format($totalInfaqRp, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="flex flex-col justify-between gap-3 border-t border-gray-100 p-6 sm:flex-row sm:items-center">
                <p class="text-xs text-gray-500">
                    Total Uang (Mal + Infaq): <span class="font-bold text-gray-900">Rp
                        {{ number_format($totalCashRp, 0, ',', '.') }}</span>
                </p>
                <a href="{{ route('admin.zakat.index', $registration->hijri_year ? ['hijri_year' => $registration->hijri_year] : []) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
