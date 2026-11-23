<x-layouts.admin>
    <x-slot name="title">Edit Pencatatan Zakat</x-slot>
    <x-slot name="backUrl">{{ route('admin.zakat.index') }}</x-slot>

    @php
        $existingRows = $registration->transactions
            ->map(function ($trx) {
                return [
                    'nama' => $trx->person_name,
                    'fitrah_kg' => (float) $trx->fitrah_rice_kg,
                    'mal_rp' => (int) $trx->mal_cash_amount,
                    'infaq_rp' => (int) $trx->infaq_cash_amount,
                ];
            })
            ->values()
            ->all();

        $initialRows = old('items', !empty($existingRows) ? $existingRows : [
            ['nama' => '', 'fitrah_kg' => 2.5, 'mal_rp' => 0, 'infaq_rp' => 0],
        ]);
    @endphp

    <form action="{{ route('admin.zakat.update', $registration) }}" method="POST"
        data-confirm-title="Simpan perubahan zakat?"
        data-confirm="Pastikan nama jiwa/orang, beras fitrah (Kg), zakat mal (Rp), dan infaq (Rp) sudah sesuai."
        data-confirm-color="#c49c4d" data-confirm-icon="question" data-confirm-text="Ya, Perbarui" x-data="{
            kepalaKeluarga: @js(old('kepala_keluarga', $registration->head_of_family)),
            rows: @js($initialRows),
            addRow() {
                this.rows.push({ nama: '', fitrah_kg: 2.5, mal_rp: 0, infaq_rp: 0 });
            },
            removeRow(index) {
                if (this.rows.length > 1) {
                    this.rows.splice(index, 1);
                }
            },
            get totalFitrahKg() {
                return this.rows.reduce((sum, r) => sum + (parseFloat(r.fitrah_kg) || 0), 0).toFixed(2);
            },
            get totalMal() {
                return this.rows.reduce((sum, r) => sum + (parseFloat(r.mal_rp) || 0), 0);
            },
            get totalInfaq() {
                return this.rows.reduce((sum, r) => sum + (parseFloat(r.infaq_rp) || 0), 0);
            },
            formatRupiah(val) {
                return 'Rp ' + (Number(val) || 0).toLocaleString('id-ID');
            }
        }" class="space-y-6">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Periksa kembali isian form:</p>
                <ul class="mt-1.5 list-inside list-disc space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Identitas Keluarga & Tanggal --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-700">Kepala Keluarga / Pendaftar</label>
                    <input type="text" name="kepala_keluarga" x-model="kepalaKeluarga" required
                        placeholder="Contoh: Bapak Ahmad Fauzi"
                        class="mt-1.5 w-full rounded-xl border border-gray-300 px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $registration->address) }}"
                        placeholder="Contoh: P-37 / RT 26"
                        class="mt-1.5 w-full rounded-xl border border-gray-300 px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal"
                        value="{{ old('tanggal', $registration->received_date->format('Y-m-d')) }}" required
                        class="mt-1.5 w-full rounded-xl border border-gray-300 px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                </div>
            </div>
        </div>

        {{-- Tabel Utama: Nama (Lebar) | Zakat Fitrah (Kg) | Mal (Rp) | Infaq (Rp) --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-3 border-b border-gray-100 p-6 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Rincian Per Jiwa / Per Orang</h2>
                    <p class="mt-0.5 text-xs text-gray-500">Zakat fitrah khusus beras (kg), sedangkan zakat mal dan
                        infaq dalam rupiah (Rp).</p>
                </div>
                <button type="button" @click="addRow()"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-[#c49c4d] bg-[#c49c4d]/10 px-3.5 py-2 text-xs font-semibold text-[#c49c4d] transition hover:bg-[#c49c4d] hover:text-white">
                    + Tambah Baris
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-195 table-fixed text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="w-auto px-4 py-3">Nama</th>
                            <th class="w-36 px-4 py-3">Zakat Fitrah (Kg)</th>
                            <th class="w-44 px-4 py-3">Mal (Rp)</th>
                            <th class="w-44 px-4 py-3">Infaq (Rp)</th>
                            <th class="w-14 px-4 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="(row, index) in rows" :key="index">
                            <tr class="hover:bg-gray-50/60">
                                <td class="px-4 py-3">
                                    <input type="text" :name="'items[' + index + '][nama]'" x-model="row.nama" required
                                        placeholder="Nama lengkap"
                                        class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" step="0.1" min="0" :name="'items[' + index + '][fitrah_kg]'"
                                        x-model="row.fitrah_kg"
                                        class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" min="0" step="1000" :name="'items[' + index + '][mal_rp]'"
                                        x-model="row.mal_rp"
                                        class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" min="0" step="1000" :name="'items[' + index + '][infaq_rp]'"
                                        x-model="row.infaq_rp"
                                        class="w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2 text-sm focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button type="button" @click="removeRow(index)" :disabled="rows.length === 1"
                                        :class="rows.length === 1 ? 'opacity-40 cursor-not-allowed' : 'text-red-500 hover:bg-red-50'"
                                        title="Hapus baris"
                                        class="inline-flex rounded-xl border border-gray-200 bg-white p-2 text-gray-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                    <tfoot class="border-t border-gray-200 bg-[#c49c4d]/10 text-sm font-bold text-gray-900">
                        <tr>
                            <td class="px-4 py-3">Total (<span x-text="rows.length"></span> orang)</td>
                            <td class="px-4 py-3 text-[#c49c4d]"><span x-text="totalFitrahKg"></span> Kg</td>
                            <td class="px-4 py-3 text-[#c49c4d]" x-text="formatRupiah(totalMal)"></td>
                            <td class="px-4 py-3" x-text="formatRupiah(totalInfaq)"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 p-6">
                <a href="{{ route('admin.zakat.index') }}"
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-xl bg-[#c49c4d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</x-layouts.admin>
