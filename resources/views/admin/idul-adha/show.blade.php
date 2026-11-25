<x-layouts.admin>
    <x-slot name="title">Detail Idul Adha — {{ $qurban->person_name }}</x-slot>
    <x-slot name="backUrl">{{ route('admin.idul-adha.index') }}</x-slot>
    
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
        $totalBayar = $qurbanNominal + (int) $qurban->infaq_amount;
    @endphp

    <div class="space-y-6">
        {{-- Header & Aksi --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $qurban->person_name }}</h2>
                    @if ($qurban->hijri_year)
                        <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-1 text-xs font-semibold text-[#9c7832]">
                            {{ $qurban->hijri_year }} H
                        </span>
                    @endif
                </div>
                <p class="mt-1 text-sm text-gray-500">
                    Rincian pencatatan Idul Adha diterima pada {{ $qurban->received_date?->translatedFormat('d F Y') }}.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.idul-adha.index', ['hijri_year' => $qurban->hijri_year]) }}"
                    class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Kembali ke Daftar
                </a>

                <a href="{{ route('admin.idul-adha.edit', $qurban->id) }}"
                    class="inline-flex items-center gap-1.5 rounded-xl bg-[#c49c4d] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Data
                </a>

                <form action="{{ route('admin.idul-adha.destroy', $qurban->id) }}" method="POST"
                    data-confirm-title="Hapus data Idul Adha?"
                    data-confirm="Data atas nama {{ $qurban->person_name }} akan dihapus secara permanen.">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Ringkasan Nominal --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">
                    @if ($animalType && $isSelfProcured)
                        Uang Penyembelihan &amp; Pemeliharaan
                    @else
                        Nominal Qurban
                    @endif
                </p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    @if ($animalType)
                        Rp {{ number_format($qurbanNominal, 0, ',', '.') }}
                    @else
                        <span class="text-base font-normal text-gray-400">Tidak ada qurban</span>
                    @endif
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    @if (!$animalType)
                        Hanya mencatatkan infaq
                    @elseif ($isSelfProcured)
                        Pengadaan sendiri
                    @else
                        Sudah termasuk uang sembelih &amp; pemeliharaan
                    @endif
                </p>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Infaq Idul Adha</p>
                <p class="mt-2 text-2xl font-bold text-[#c49c4d]">
                    Rp {{ number_format((int) $qurban->infaq_amount, 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Nominal infaq tercatat</p>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Tercatat</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">
                    Rp {{ number_format($totalBayar, 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Qurban / biaya layanan + infaq</p>
            </div>
        </div>

        {{-- Detail Informasi Orang & Qurban --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-gray-900">Informasi Orang</h3>

                <dl class="divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Nama Lengkap</dt>
                        <dd class="col-span-2 font-semibold text-gray-900">{{ $qurban->person_name }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Tahun Hijriah</dt>
                        <dd class="col-span-2 text-gray-800">{{ $qurban->hijri_year ? $qurban->hijri_year . ' H' : '-' }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Tanggal Terima</dt>
                        <dd class="col-span-2 text-gray-800">{{ $qurban->received_date?->translatedFormat('d M Y') ?? '-' }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">No. HP / WA</dt>
                        <dd class="col-span-2 text-gray-800">{{ $qurban->phone ?: '-' }}</dd>
                    </div>
                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Alamat</dt>
                        <dd class="col-span-2 text-gray-800">{{ $qurban->address ?: '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-gray-900">Rincian Qurban &amp; Catatan</h3>

                <dl class="divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Jenis Hewan</dt>
                        <dd class="col-span-2">
                            @if ($animalType)
                                <span class="rounded-md px-2.5 py-1 text-xs font-semibold {{ $animalType->badgeClass() }}">
                                    {{ $animalType->label() }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400">Hanya Infaq</span>
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Jenis Pengadaan</dt>
                        <dd class="col-span-2">
                            @if ($procurementType)
                                <span class="rounded-md px-2.5 py-1 text-xs font-medium {{ $procurementType->badgeClass() }}">
                                    {{ $procurementType->label() }}
                                </span>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">
                            @if ($animalType && $isSelfProcured)
                                Biaya Sembelih &amp; Rawat
                            @else
                                Nominal Kesepakatan
                            @endif
                        </dt>
                        <dd class="col-span-2 font-semibold text-gray-900">
                            @if ($animalType)
                                Rp {{ number_format($qurbanNominal, 0, ',', '.') }}
                            @else
                                <span class="text-xs font-normal text-gray-400">-</span>
                            @endif
                        </dd>
                    </div>

                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Infaq</dt>
                        <dd class="col-span-2 font-semibold text-[#9c7832]">
                            Rp {{ number_format((int) $qurban->infaq_amount, 0, ',', '.') }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-3 gap-4 py-3">
                        <dt class="text-xs font-semibold text-gray-500">Catatan</dt>
                        <dd class="col-span-2 whitespace-pre-line text-gray-700">{{ $qurban->notes ?: '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-layouts.admin>