<x-layouts.admin>
    <x-slot name="title">Catat Idul Adha</x-slot>
    <x-slot name="backUrl">{{ route('admin.idul-adha.index') }}</x-slot>
    
    @php
        $availableHijriYears = $availableHijriYears ?? collect();
        $defaultHijriYear = (string) ($defaultHijriYear ?? ($latestHijriYear ?? '1448'));
        $yearOptions = $availableHijriYears->isNotEmpty()
            ? $availableHijriYears
            : collect([$defaultHijriYear]);

        $initialAnimalType = old('animal_type', \App\Enums\AnimalType::Sapi->value);
        $initialProcurementType = old('procurement_type', \App\Enums\ProcurementType::Masjid->value);
    @endphp

    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col gap-1">
            <h2 class="text-2xl font-bold text-gray-900">Catat Data Idul Adha</h2>
            <p class="text-sm text-gray-500">
                Pencatatan per orang untuk qurban sapi atau kambing (lewat masjid maupun pengadaan sendiri) dan infaq per tahun Hijriah.
            </p>
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

        <form action="{{ route('admin.idul-adha.store') }}" method="POST"
            x-data="idulAdhaCreateForm({
                animalType: @js($initialAnimalType),
                procurementType: @js($initialProcurementType)
            })"
            class="space-y-6">
            @csrf

            {{-- 1. Data Orang & Periode --}}
            <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-gray-900">Data Orang &amp; Periode</h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label for="hijri_year" class="block text-xs font-semibold text-gray-700">
                            Tahun Hijriah <span class="text-red-500">*</span>
                        </label>
                        <input id="hijri_year" type="text" list="hijri-year-options" name="hijri_year"
                            value="{{ old('hijri_year', $defaultHijriYear) }}" required
                            inputmode="numeric" pattern="[0-9]{4}" maxlength="4"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                        <datalist id="hijri-year-options">
                            @foreach ($yearOptions as $yr)
                                <option value="{{ $yr }}">{{ $yr }} H</option>
                            @endforeach
                        </datalist>
                        <p class="mt-1 text-[11px] text-gray-400">Ketik tahun baru atau pilih dari daftar.</p>
                    </div>

                    <div>
                        <label for="received_date" class="block text-xs font-semibold text-gray-700">
                            Tanggal Terima <span class="text-red-500">*</span>
                        </label>
                        <input id="received_date" type="date" name="received_date"
                            value="{{ old('received_date', now()->toDateString()) }}" required
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="person_name" class="block text-xs font-semibold text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input id="person_name" type="text" name="person_name"
                            value="{{ old('person_name') }}" required
                            placeholder="Nama orang / pengqurban / penyumbang infaq"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="phone" class="block text-xs font-semibold text-gray-700">
                            No. HP / WA (Opsional)
                        </label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    </div>

                    <div>
                        <label for="address" class="block text-xs font-semibold text-gray-700">
                            Alamat (Opsional)
                        </label>
                        <input id="address" type="text" name="address" value="{{ old('address') }}"
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
                            @change="if (!animalType) { agreedAmount = ''; slaughterCareFee = ''; }"
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
                            value="{{ old('infaq_amount', 0) }}"
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
                        class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.idul-adha.index', ['hijri_year' => $defaultHijriYear]) }}"
                    class="rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                    Simpan Data Idul Adha
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
                        title: 'Gagal Menyimpan',
                        text: @json(session('error')),
                        confirmButtonColor: '#c49c4d'
                    });
                }
            });
        </script>
    @endif

    <script>
        function idulAdhaCreateForm(initial) {
            return {
                animalType: initial.animalType ?? '',
                procurementType: initial.procurementType ?? '{{ \App\Enums\ProcurementType::Masjid->value }}',
                agreedAmount: @js(old('agreed_amount', '')),
                slaughterCareFee: @js(old('slaughter_care_fee', ''))
            };
        }
    </script>
</x-layouts.admin>