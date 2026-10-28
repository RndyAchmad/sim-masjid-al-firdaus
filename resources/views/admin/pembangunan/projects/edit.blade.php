<x-layouts.admin>
    <x-slot name="title">Edit Proyek Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.projects.show', $project) }}</x-slot>

    <div class="mx-auto max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Edit Proyek Pembangunan</h1>
            <p class="mt-1 text-sm leading-6 text-gray-500">Perbarui informasi proyek atau hubungkan transaksi kas umum yang sebelumnya belum dialokasikan.</p>
        </div>

        <form action="{{ route('admin.pembangunan.projects.edit', $project) }}" method="GET" class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm sm:flex sm:items-end sm:gap-3">
            <div class="flex-1">
                <label for="search_transaksi" class="mb-1.5 block text-sm font-semibold text-gray-700">Cari transaksi kas umum</label>
                <input type="search" id="search_transaksi" name="search_transaksi" value="{{ $searchTransaction }}" maxlength="100" placeholder="Contoh: tukang bangun menara, semen, atau nama toko" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
            </div>
            <div class="mt-3 flex gap-2 sm:mt-0">
                @if ($searchTransaction !== '')
                    <a href="{{ route('admin.pembangunan.projects.edit', $project) }}" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">Reset</a>
                @endif
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">Cari</button>
            </div>
        </form>

        @include('admin.pembangunan.projects.form', [
            'action' => route('admin.pembangunan.projects.update', ['project' => $project, 'search_transaksi' => $searchTransaction]),
            'method' => 'PUT',
            'submitLabel' => 'Simpan Perubahan',
            'cancelUrl' => route('admin.pembangunan.projects.show', $project),
        ])
    </div>
</x-layouts.admin>
