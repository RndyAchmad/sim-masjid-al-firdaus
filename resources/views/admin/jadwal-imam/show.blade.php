<x-layouts.admin>
    <x-slot name="title">Detail Jadwal Imam Jumat</x-slot>
    <x-slot name="backUrl">{{ route('admin.jadwal-imam.index') }}</x-slot>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Kolom Utama: Rincian Data -->
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-medium text-[#c49c4d]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#c49c4d]"></span> Jadwal Rutin
                        </span>
                        <h2 class="mt-2 text-lg font-bold text-gray-900">Jumat, 16 Oktober 2026</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="rounded-xl bg-gray-50 p-4 border border-gray-100">
                        <p class="text-xs font-semibold uppercase text-gray-400">Imam Sholat</p>
                        <p class="mt-1 text-base font-bold text-gray-800">{{ $jadwal->imam ?? 'Ustadz H. Ahmad Fauzi' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4 border border-gray-100">
                        <p class="text-xs font-semibold uppercase text-gray-400">Muadzin</p>
                        <p class="mt-1 text-base font-bold text-gray-800">{{ $jadwal->muadzin ?? 'Bpk. Ridwan' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Samping: Panel Aksi -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-3">Opsi Pengelolaan</h3>

                <div class="space-y-2">
                    <a href="{{ route('admin.jadwal-imam.edit', $jadwal->id ?? 1) }}"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#c49c4d] py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#a8833e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Jadwal
                    </a>

                    <form action="{{ route('admin.jadwal-imam.destroy', $jadwal->id ?? 1) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus Jadwal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
