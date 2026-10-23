<x-layouts.admin>
    <x-slot name="title">Edit Jadwal Imam Jumat</x-slot>
    <x-slot name="backUrl">{{ route('admin.jadwal-imam.index') }}</x-slot>

    <form
        action="{{ route('admin.jadwal-imam.update', $jadwal->id) }}"
        method="POST"
        x-data="jadwalForm(@js(old('tanggal', $jadwal->date?->format('Y-m-d'))))"
        @submit="validateSubmit($event)"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3"
    >
        @csrf
        @method('PUT')

        {{-- Kolom Kiri: Form Utama --}}
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
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        x-model="tanggal"
                        @change="checkFriday()"
                        required
                        aria-describedby="tanggal-error tanggal-help"
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-1
                            @error('tanggal')
                                border-red-500 focus:border-red-500 focus:ring-red-500
                            @else
                            @enderror"
                        :class="errorMessage ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
                    >

                    <p
                        id="tanggal-error"
                        x-show="errorMessage"
                        x-text="errorMessage"
                        class="mt-1.5 text-xs font-medium text-red-500"
                        x-cloak
                    ></p>

                    @error('tanggal')
                        <p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror

                    <p id="tanggal-help" class="mt-1.5 text-xs text-gray-400">
                        Pilih tanggal yang jatuh tepat pada hari Jumat.
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
                        value="{{ old('imam', $jadwal->imam) }}"
                        maxlength="255"
                        placeholder="Contoh: Ustadz H. Ahmad Fauzi"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    @error('imam')
                        <p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>
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
                        value="{{ old('muadzin', $jadwal->muadzin) }}"
                        maxlength="255"
                        placeholder="Contoh: Bpk. Ridwan"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    @error('muadzin')
                        <p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Khatib --}}
                {{-- <div>
                    <label for="khatib" class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama Khatib
                    </label>

                    <input
                        type="text"
                        id="khatib"
                        name="khatib"
                        value="{{ old('khatib', $jadwal->khatib) }}"
                        maxlength="255"
                        placeholder="Contoh: Ustadz H. Muhammad"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]"
                    >

                    @error('khatib')
                        <p class="mt-1.5 text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div> --}}

            </div>
        </div>

        {{-- Kolom Kanan: Pengaturan & Aksi --}}
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
                        Tanggal jadwal harus hari Jumat. Setiap tanggal hanya boleh memiliki satu jadwal imam.
                    </p>
                </div>

                <div class="flex flex-col gap-3 pt-2 sm:flex-row lg:flex-col">
                    <button
                        type="submit"
                        :disabled="!tanggal || !!errorMessage"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        Perbarui Jadwal
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
            document.addEventListener('alpine:init', () => {
                Alpine.data('jadwalForm', (initialDate) => ({
                    tanggal: initialDate ?? '',
                    errorMessage: '',

                    init() {
                        this.checkFriday();
                    },

                    checkFriday() {
                        this.errorMessage = '';

                        if (!this.tanggal) {
                            return;
                        }

                        const parts = this.tanggal.split('-');

                        const dateObj = new Date(
                            Number(parts[0]),
                            Number(parts[1]) - 1,
                            Number(parts[2])
                        );

                        if (
                            dateObj.getFullYear() !== Number(parts[0]) ||
                            dateObj.getMonth() !== Number(parts[1]) - 1 ||
                            dateObj.getDate() !== Number(parts[2])
                        ) {
                            this.errorMessage = 'Tanggal yang dipilih tidak valid.';
                            return;
                        }

                        if (dateObj.getDay() !== 5) {
                            this.errorMessage =
                                'Tanggal yang dipilih bukan hari Jumat. Silakan pilih tanggal hari Jumat.';
                        }
                    },

                    validateSubmit(event) {
                        this.checkFriday();

                        if (!this.tanggal || this.errorMessage) {
                            event.preventDefault();
                        }
                    }
                }));
            });
        </script>
    @endpush
</x-layouts.admin>
