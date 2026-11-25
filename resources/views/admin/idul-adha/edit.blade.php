<x-layouts.admin>
    <x-slot name="title">Edit Idul Adha — {{ $qurban->person_name }}</x-slot>
    <x-slot name="backUrl">{{ route('admin.idul-adha.index') }}</x-slot>

    @php
        $hijriYear = (string) ($qurban->hijri_year ?? '1448');

        $currentAnimalType = $qurban->animal_type instanceof \App\Enums\AnimalType
            ? $qurban->animal_type->value
            : ($qurban->animal_type ?? '');

        $currentProcurementType = $qurban->procurement_type instanceof \App\Enums\ProcurementType
            ? $qurban->procurement_type->value
            : ($qurban->procurement_type ?? \App\Enums\ProcurementType::Masjid->value);

        $initialAnimalType = old('animal_type', $currentAnimalType);
        $initialProcurementType = old('procurement_type', $currentProcurementType);
        $initialAgreedAmount = old('agreed_amount', (int) ($qurban->agreed_amount ?? 0));
        $initialSlaughterCareFee = old('slaughter_care_fee', (int) ($qurban->slaughter_care_fee ?? 0));
    @endphp

    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Data Idul Adha</h2>
                <p class="text-sm text-gray-500">
                    Perbarui data orang, rincian qurban sapi atau kambing, maupun infaq.
                </p>
            </div>
            @if ($qurban->hijri_year)
                <span class="inline-flex w-fit items-center rounded-lg bg-[#c49c4d]/15 px-3 py-1.5 text-xs font-semibold text-[#9c7832]">
                    Periode {{ $hijriYear }} H
                </span>
            @endif
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-xs">
                <p class="font-semibold">Periksa kembali isian form:</p>
                <ul class="mt-1.5 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.idul-adha.update', $qurban->id) }}" method="POST"
            x-data="idulAdhaEditForm({
                animalType: @js($initialAnimalType),
                procurementType: @js($initialProcurementType),
                agreedAmount: @js($initialAgreedAmount),
                slaughterCareFee: @js($initialSlaughterCareFee)
            })"
            class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="hijri_year" value="{{ old('hijri_year', $hijriYear) }}">

            {{-- 1. Data Orang --}}
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-gray-900">Data Orang</h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label for="received_date" class="block text-xs font-semibold text-gray-700">
                            Tanggal Terima <span class="text-red-500">*</span>
                        </label>
                        <input id="received_date" type="date" name="received_date"
                            value="{{ old('received_date', $qurban->received_date?->toDateString() ?? now()->toDateString()) }}" required
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="person_name" class="block text-xs font-semibold text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input id="person_name" type="text" name="person_name"
                            value="{{ old('person_name', $qurban->person_name) }}" required
                            placeholder="Nama orang / pengqurban / penyumbang infaq"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="phone" class="block text-xs font-semibold text-gray-700">
                            No. HP / WA (Opsional)
                        </label>
                        <input id="phone" type="text" name="phone"
                            value="{{ old('phone', $qurban->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div>
                        <label for="address" class="block text-xs font-semibold text-gray-700">
                            Alamat (Opsional)
                        </label>
                        <input id="address" type="text" name="address"
                            value="{{ old('address', $qurban->address) }}"
                            placeholder="Contoh: Blok A / RT 02"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>
            </div>

            {{-- 2. Qurban & Infaq --}}
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-4">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Qurban &amp; Infaq</h3>
                    <p class="text-xs text-gray-500">
                        Kosongkan jenis hewan jika hanya mencatat infaq. Untuk qurban lewat masjid, nominal kesepakatan sudah termasuk uang sembelih &amp; pemeliharaan; untuk pengadaan sendiri, isi uang penyembelihan &amp; pemeliharaan.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label for="animal_type" class="block text-xs font-semibold text-gray-700">
                            Jenis Hewan Qurban
                        </label>
                        <select id="animal_type" name="animal_type" x-model="animalType"
                            @change="if (!animalType) { agreedAmount = 0; slaughterCareFee = 0; }"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                            <option value="">— Tanpa Qurban (Hanya Infaq) —</option>
                            @foreach (\App\Enums\AnimalType::cases() as $animal)
                                <option value="{{ $animal->value }}">{{ $animal->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="animalType !== ''">
                        <label for="procurement_type" class="block text-xs font-semibold text-gray-700">
                            Jenis Pengadaan
                        </label>
                        <select id="procurement_type" name="procurement_type" x-model="procurementType"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                            @foreach (\App\Enums\ProcurementType::cases() as $proc)
                                <option value="{{ $proc->value }}">{{ $proc->label() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="infaq_amount" class="block text-xs font-semibold text-gray-700">
                            Infaq Idul Adha (Rp)
                        </label>
                        <input id="infaq_amount" type="number" min="0" step="1000" name="infaq_amount"
                            value="{{ old('infaq_amount', (int) ($qurban->infaq_amount ?? 0)) }}"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                <div x-show="animalType !== ''" class="grid grid-cols-1 gap-4 sm:grid-cols-2 pt-1">
                    <div x-show="procurementType === '{{ \App\Enums\ProcurementType::Masjid->value }}'">
                        <label for="agreed_amount" class="block text-xs font-semibold text-gray-700">
                            Nominal Kesepakatan (Rp)
                            <span class="font-normal text-gray-400">— sudah termasuk uang sembelih &amp; pemeliharaan</span>
                        </label>
                        <input id="agreed_amount" type="number" min="0" step="1000" name="agreed_amount"
                            x-model="agreedAmount"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div x-show="procurementType === '{{ \App\Enums\ProcurementType::SelfProcured->value }}'">
                        <label for="slaughter_care_fee" class="block text-xs font-semibold text-gray-700">
                            Uang Penyembelihan &amp; Pemeliharaan (Rp)
                        </label>
                        <input id="slaughter_care_fee" type="number" min="0" step="1000" name="slaughter_care_fee"
                            x-model="slaughterCareFee"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-xs font-semibold text-gray-700">
                        Catatan (Opsional)
                    </label>
                    <textarea id="notes" name="notes" rows="2"
                        placeholder="Catatan tambahan bila diperlukan..."
                        class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('notes', $qurban->notes) }}</textarea>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.idul-adha.index', ['hijri_year' => $hijriYear]) }}"
                    class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memperbarui',
                        text: @json(session('error')),
                        confirmButtonColor: '#c49c4d'
                    });
                }
            });
        </script>
    @endif

    <script>
        function idulAdhaEditForm(initial) {
            return {
                animalType: initial.animalType ?? '',
                procurementType: initial.procurementType ?? '{{ \App\Enums\ProcurementType::Masjid->value }}',
                agreedAmount: initial.agreedAmount ?? 0,
                slaughterCareFee: initial.slaughterCareFee ?? 0
            };
        }
    </script>
</x-layouts.admin>