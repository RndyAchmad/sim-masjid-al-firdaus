<x-layouts.admin>
    <x-slot name="title">Tambah Jadwal Imam Jumat</x-slot>
    <x-slot name="backUrl">{{ route('admin.jadwal-imam.index') }}</x-slot>

    <form
        action="{{ route('admin.jadwal-imam.store') }}"
        method="POST"
        x-data="jadwalCreateForm()"
        @submit="validateSubmit($event)"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3"
    >
        @csrf

        {{-- Kolom Kiri --}}
        <div class="space-y-6 lg:col-span-2">
            <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Informasi Petugas Sholat Jumat
                </h3>

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="mb-2 block text-sm font-semibold text-gray-700">
                        Tanggal Sholat Jumat <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="tanggal"
                        name="tanggal"
                        value="{{ old('tanggal') }}"
                        placeholder="Pilih tanggal hari Jumat"
                        autocomplete="off"
                        required
                        readonly
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-1
                            @error('tanggal')
                                border-red-500 focus:border-red-500 focus:ring-red-500
                            @else
                            @enderror"
                    >

                    @error('tanggal')
                        <p class="mt-1.5 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-1.5 text-xs text-gray-400">
                        Hanya tanggal hari Jumat yang dapat dipilih.
                    </p>
                </div>

                {{-- Imam --}}
                <div>
                    <label for="imam" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama Imam Sholat <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="imam"
                        name="imam"
                        value="{{ old('imam') }}"
                        maxlength="255"
                        placeholder="Contoh: Ustadz H. Ahmad Fauzi"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    @error('imam')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Muadzin --}}
                <div>
                    <label for="muadzin" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama Muadzin
                    </label>

                    <input
                        type="text"
                        id="muadzin"
                        name="muadzin"
                        value="{{ old('muadzin') }}"
                        maxlength="255"
                        placeholder="Contoh: Bpk. Ridwan"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    @error('muadzin')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="space-y-6">
            <div class="space-y-4 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="border-b border-gray-100 pb-3 font-bold text-gray-900">
                    Aksi & Informasi
                </h3>

                <div class="space-y-1 rounded-xl border border-amber-100 bg-amber-50 p-4">
                    <p class="text-xs font-semibold text-[#a8833e]">
                        Ketentuan Kalender
                    </p>

                    <p class="text-xs leading-relaxed text-gray-600">
                        Jadwal hanya dapat dibuat untuk hari Jumat. Setiap tanggal hanya boleh memiliki satu jadwal imam.
                    </p>
                </div>

                <div class="flex flex-col gap-3 pt-2 sm:flex-row lg:flex-col">
                    <button
                        type="submit"
                        :disabled="!!errorMessage || !tanggal"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        Simpan Jadwal
                    </button>

                    <a
                        href="{{ route('admin.jadwal-imam.index') }}"
                        class="w-full rounded-xl border border-gray-300 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50"
                    >
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tanggalInput = document.getElementById('tanggal');

                if (!tanggalInput) return;

                flatpickr(tanggalInput, {
                    dateFormat: 'Y-m-d',
                    disableMobile: true,

                    // Jumat = 5, Minggu = 0.
                    enable: [
                        function (date) {
                            return date.getDay() === 5;
                        }
                    ],

                    locale: {
                        firstDayOfWeek: 1
                    },

                    monthSelectorType: 'static',

                    onReady: function (selectedDates, dateStr, instance) {
                        instance.calendarContainer.classList.add('jadwal-imam-calendar');
                    }
                });
            });
        </script>
    @endpush
</x-layouts.admin>
