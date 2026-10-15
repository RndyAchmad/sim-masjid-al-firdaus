<x-layouts.admin>
    <x-slot name="title">Tambah Jadwal Imam Jumat</x-slot>
    <x-slot name="backUrl">{{ route('admin.jadwal-imam.index') }}</x-slot>

    <form action="{{ route('admin.jadwal-imam.store') }}" method="POST" x-data="jadwalCreateForm()"
        @submit="validateSubmit($event)" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf

        <!-- Kolom Kiri: Form Utama -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Informasi Petugas Sholat Jumat</h3>

                <!-- Input Tanggal Kalender -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Tanggal Sholat Jumat <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" x-model="tanggal" @change="checkFriday" required
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-1"
                        :class="errorMessage ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-[#c49c4d] focus:ring-[#c49c4d]'">

                    <!-- Pesan Validasi / Petunjuk -->
                    <p x-show="errorMessage" x-text="errorMessage" class="mt-1.5 text-xs text-red-500 font-medium"
                        x-cloak></p>
                    <p x-show="!errorMessage" class="mt-1.5 text-xs text-gray-400">Pilih tanggal kalender yang jatuh
                        tepat pada hari Jumat.</p>
                    @error('tanggal')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Nama Imam Sholat -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Nama Imam Sholat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="imam" value="{{ old('imam') }}" placeholder="Contoh: Ustadz H. Ahmad Fauzi"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('imam')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Nama Muadzin -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Muadzin</label>
                    <input type="text" name="muadzin" value="{{ old('muadzin') }}" placeholder="Contoh: Bpk. Ridwan"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                    @error('muadzin')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pengaturan & Tombol Aksi -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Aksi & Informasi</h3>

                <!-- Box Catatan -->
                <div class="rounded-xl bg-amber-50 p-4 border border-amber-100 space-y-1">
                    <p class="text-xs font-semibold text-[#c49c4d]">Ketentuan Kalender</p>
                    <p class="text-xs text-gray-600">Sistem secara otomatis memeriksa dan memverifikasi bahwa tanggal
                        yang Anda pilih jatuh pada hari Jumat.</p>
                </div>

                <!-- Tombol Aksi Responsive -->
                <div class="pt-2 flex flex-col sm:flex-row lg:flex-col gap-3">
                    <button type="submit" :disabled="!!errorMessage || !tanggal"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] disabled:opacity-50 disabled:cursor-not-allowed">
                        Simpan Jadwal
                    </button>
                    <a href="{{ route('admin.jadwal-imam.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Script Validasi Pemilihan Hari Jumat via Alpine.js -->
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('jadwalCreateForm', () => ({
                    tanggal: '{{ old('tanggal') }}',
                    errorMessage: '',

                    init() {
                        if (this.tanggal) {
                            this.checkFriday();
                        }
                    },

                    checkFriday() {
                        if (!this.tanggal) {
                            this.errorMessage = '';
                            return;
                        }

                        // Hindari pergeseran waktu timezone UTC dengan split string tanggal YYYY-MM-DD
                        const parts = this.tanggal.split('-');
                        const dateObj = new Date(parts[0], parts[1] - 1, parts[2]);

                        // Nilai index 5 menandakan hari Jumat (0: Minggu, 1: Senin, ..., 5: Jumat, 6: Sabtu)
                        if (dateObj.getDay() !== 5) {
                            this.errorMessage = 'Tanggal yang Anda pilih bukan hari Jumat! Silakan pilih tanggal hari Jumat.';
                        } else {
                            this.errorMessage = '';
                        }
                    },

                    validateSubmit(e) {
                        this.checkFriday();
                        if (this.errorMessage || !this.tanggal) {
                            e.preventDefault();
                            if (this.errorMessage) {
                                alert(this.errorMessage);
                            }
                        }
                    }
                }));
            });
        </script>
    @endpush
</x-layouts.admin>
