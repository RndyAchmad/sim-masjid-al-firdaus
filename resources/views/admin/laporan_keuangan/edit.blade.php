<x-layouts.admin>
    <x-slot name="title">Edit Transaksi</x-slot>
    <x-slot name="backUrl">{{ route('admin.laporan-keuangan.index') }}</x-slot>

    <form action="#" method="POST" enctype="multipart/form-data"
        class="max-w-4xl rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8 space-y-6">

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="mb-3 block text-sm font-semibold text-gray-700">Tipe Transaksi</label>
                <div class="flex flex-wrap gap-4">
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-emerald-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 has-[:checked]:ring-1 has-[:checked]:ring-emerald-500">
                        <input type="radio" name="tipe" value="pemasukan"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-600">
                        <span class="text-sm font-medium text-gray-900">Pemasukan</span>
                    </label>
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-4 transition hover:bg-rose-50 has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50 has-[:checked]:ring-1 has-[:checked]:ring-rose-500">
                        <input type="radio" name="tipe" value="pengeluaran"
                            class="h-4 w-4 text-rose-600 focus:ring-rose-600" checked>
                        <span class="text-sm font-medium text-gray-900">Pengeluaran</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Tanggal Transaksi</label>
                <input type="date" value="2026-09-02"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">Nominal (Rp)</label>
                <input type="number" value="1250000"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            </div>

            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-gray-700">Keterangan Lengkap</label>
                <textarea rows="3"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">Pembayaran Listrik & Air Masjid Al-Firdaus Bulan Agustus 2026.</textarea>
            </div>

            <!-- Jika ingin mengganti file -->
            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-gray-700">Ganti Bukti (Opsional)</label>
                <input type="file"
                    class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-[#c49c4d] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-[#a8833e]">
            </div>
        </div>

        <div class="flex gap-3 pt-4 sm:justify-end border-t border-gray-100">
            <a href="{{ route('admin.laporan-keuangan.index') }}"
                class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">Batal</a>
            <button type="submit"
                class="rounded-xl bg-[#c49c4d] px-8 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">Perbarui
                Transaksi</button>
        </div>
    </form>
</x-layouts.admin>