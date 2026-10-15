<x-layouts.admin>
    <x-slot name="title">Edit Jadwal Imam Jumat</x-slot>
    <x-slot name="backUrl">{{ route('admin.jadwal-imam.index') }}</x-slot>

    <form action="{{ route('admin.jadwal-imam.update', $jadwal->id ?? 1) }}" method="POST"
        x-data="jadwalForm('{{ old('tanggal', $jadwal->tanggal ?? '2026-10-16') }}')" @submit="validateSubmit($event)"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @method('PUT')

        <!-- Kolom Kiri: Form Utama -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Informasi Petugas</h3>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Tanggal (Wajib Hari Jumat)</label>
                    <input type="date" name="tanggal" x-model="tanggal" @change="checkFriday" required
                        class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-1"
                        :class="errorMessage ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-[#c49c4d] focus:ring-[#c49c4d]'">

                    <!-- Pesan Error / Petunjuk -->
                    <p x-show="errorMessage" x-text="errorMessage" class="mt-1 text-xs text-red-500 font-medium"
                        x-cloak></p>
                    <p x-show="!errorMessage" class="mt-1 text-xs text-gray-400">Pilih tanggal kalender yang jatuh tepat
                        pada hari Jumat.</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Imam Sholat</label>
                    <input type="text" name="imam" value="{{ old('imam', $jadwal->imam ?? 'Ustadz H. Ahmad Fauzi') }}"
                        placeholder="Contoh: Ustadz H. Ahmad Fauzi" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Nama Muadzin</label>
                    <input type="text" name="muadzin" value="{{ old('muadzin', $jadwal->muadzin ?? 'Bpk. Ridwan') }}"
                        placeholder="Contoh: Bpk. Ridwan"
                        class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pengaturan & Aksi -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Aksi & Informasi</h3>

                <div class="rounded-xl bg-amber-50 p-4 border border-amber-100 space-y-1">
                    <p class="text-xs font-semibold text-[#c49c4d]">Catatan Kalender</p>
                    <p class="text-xs text-gray-600">Sistem akan menolak penyimpanan jika tanggal yang dipilih bukan
                        hari Jumat.</p>
                </div>

                <div class="pt-2 flex flex-col sm:flex-row lg:flex-col gap-3">
                    <button type="submit" :disabled="!!errorMessage"
                        class="w-full rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e] disabled:opacity-50 disabled:cursor-not-allowed">
                        Perbarui Jadwal
                    </button>
                    <a href="{{ route('admin.jadwal-imam.index') }}"
                        class="w-full text-center rounded-xl border border-gray-300 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">Batal</a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('jadwalForm', (initialDate) => ({
                    tanggal: initialDate,
                    errorMessage: '',

                    init() {
                        this.checkFriday();
                    },

                    checkFriday() {
                        if (!this.tanggal) {
                            this.errorMessage = 'Tanggal wajib diisi.';
                            return;
                        }

                        // Konstruksi tanggal lokal untuk menghindari pergeseran jam/UTC
                        const parts = this.tanggal.split('-');
                        const dateObj = new Date(parts[0], parts[1] - 1, parts[2]);

                        // Day index 5 = Jumat (0: Minggu, 1: Senin, ..., 5: Jumat, 6: Sabtu)
                        if (dateObj.getDay() !== 5) {
                            this.errorMessage = 'Tanggal yang Anda pilih bukan hari Jumat! Silakan pilih tanggal hari Jumat.';
                        } else {
                            this.errorMessage = '';
                        }
                    },

                    validateSubmit(e) {
                        this.checkFriday();
                        if (this.errorMessage) {
                            e.preventDefault();
                            alert(this.errorMessage);
                        }
                    }
                }));
            });
        </script>
    @endpush
</x-layouts.admin>
