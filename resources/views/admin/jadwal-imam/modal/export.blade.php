<div id="exportModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl">

        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">
                Export Jadwal Imam
            </h2>

            <button type="button" onclick="closeExportModal()"
                class="text-2xl leading-none text-gray-400 hover:text-gray-700" aria-label="Tutup modal">
                &times;
            </button>
        </div>

        <form action="{{ route('admin.jadwal-imam.export') }}" method="GET" class="space-y-5">
            @php
                $daftarBulan = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember',
                ];
            @endphp

            {{-- Rentang Awal --}}
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Dari Bulan
                </label>

                <div class="grid grid-cols-2 gap-3">
                    <select name="bulan_awal" required
                        class="w-full rounded-xl border border-gray-300 px-3 py-2.5 text-sm focus:border-[#c49c4d] focus:ring-[#c49c4d]">
                        @foreach ($daftarBulan as $nomor => $nama)
                            <option value="{{ $nomor }}" @selected($nomor === (int) now()->month)>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>

                    <select name="tahun_awal" required
                        class="w-full rounded-xl border border-gray-300 px-3 py-2.5 text-sm focus:border-[#c49c4d] focus:ring-[#c49c4d]">
                        @for ($tahun = now()->year; $tahun >= now()->year - 10; $tahun--)
                            <option value="{{ $tahun }}" @selected($tahun === (int) now()->year)>
                                {{ $tahun }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            {{-- Rentang Akhir --}}
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">
                    Sampai Bulan
                </label>

                <div class="grid grid-cols-2 gap-3">
                    <select name="bulan_akhir" required
                        class="w-full rounded-xl border border-gray-300 px-3 py-2.5 text-sm focus:border-[#c49c4d] focus:ring-[#c49c4d]">
                        @foreach ($daftarBulan as $nomor => $nama)
                            <option value="{{ $nomor }}" @selected($nomor === (int) now()->month)>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>

                    <select name="tahun_akhir" required
                        class="w-full rounded-xl border border-gray-300 px-3 py-2.5 text-sm focus:border-[#c49c4d] focus:ring-[#c49c4d]">
                        @for ($tahun = now()->year; $tahun >= now()->year - 10; $tahun--)
                            <option value="{{ $tahun }}" @selected($tahun === (int) now()->year)>
                                {{ $tahun }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                <button type="button" onclick="closeExportModal()"
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Batal
                </button>

                <button type="submit"
                    class="rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">
                    Export Excel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.openExportModal = function () {
        const modal = document.getElementById('exportModal');

        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.closeExportModal = function () {
        const modal = document.getElementById('exportModal');

        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('exportModal');

        if (!modal) return;

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                window.closeExportModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                window.closeExportModal();
            }
        });
    });
</script>
