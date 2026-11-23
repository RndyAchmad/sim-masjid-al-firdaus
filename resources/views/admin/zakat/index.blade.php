<x-layouts.admin>
    <x-slot name="title">Pencatatan Zakat</x-slot>

    <div class="space-y-6">
        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Beras Fitrah</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">125,0 <span class="text-sm font-normal text-gray-500">Kg</span></p>
                <p class="mt-1 text-xs text-gray-400">Fitrah khusus beras (tanpa uang)</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Keluarga Terdaftar</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">12 <span class="text-sm font-normal text-gray-500">KK</span></p>
                <p class="mt-1 text-xs text-gray-400">Total 46 jiwa tercatat</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Zakat Mal (Uang)</p>
                <p class="mt-2 text-2xl font-bold text-[#c49c4d]">Rp 8.500.000</p>
                <p class="mt-1 text-xs text-gray-400">Pembayaran tunai / transfer</p>
            </div>
            <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-medium text-gray-500">Total Infaq (Uang)</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">Rp 3.250.000</p>
                <p class="mt-1 text-xs text-gray-400">Tambahan infaq muzakki</p>
            </div>
        </div>

        {{-- Header Aksi & Filter --}}
        <div class="flex flex-col justify-between gap-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center">
            <div>
                <h2 class="text-base font-bold text-gray-900">Daftar Pendaftaran Zakat Per Keluarga</h2>
                <p class="text-xs text-gray-500">Setiap entri mewakili satu keluarga beserta rincian beras per jiwa, zakat mal, dan infaq.</p>
            </div>
            <a href="{{ route('admin.zakat.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Catat Zakat Keluarga
            </a>
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-3.5">Kepala Keluarga / Penanggung Jawab</th>
                            <th class="px-5 py-3.5">Jumlah Jiwa</th>
                            <th class="px-5 py-3.5">Fitrah (Beras)</th>
                            <th class="px-5 py-3.5">Zakat Mal</th>
                            <th class="px-5 py-3.5">Infaq</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50/70">
                            <td class="px-5 py-4">
                                <p class="font-semibold text-gray-900">Bapak Ahmad Fauzi</p>
                                <p class="text-xs text-gray-400">RT 02 / RW 04 • 23 Nov 2026</p>
                            </td>
                            <td class="px-5 py-4">4 Jiwa</td>
                            <td class="px-5 py-4 font-semibold text-gray-900">10,0 Kg</td>
                            <td class="px-5 py-4 font-medium text-[#c49c4d]">Rp 2.500.000</td>
                            <td class="px-5 py-4 font-medium text-gray-900">Rp 250.000</td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href=""
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                                            title="Detail" aria-label="">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Edit --}}
                                        <a href=""
                                            class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-[#c49c4d]"
                                            title="Edit" aria-label="">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="" method="POST"
                                            data-confirm-title="Hapus pengguna?"
                                            data-confirm="">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600"
                                                title="Hapus" aria-label="">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>
