<x-layouts.admin>
    <x-slot name="title">Buat Proyek Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.index') }}</x-slot>

    <div class="mx-auto max-w-5xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Buat Proyek Pembangunan</h1>
            <p class="mt-1 text-sm leading-6 text-gray-500">Proyek terpisah dari transaksi kas. Transaksi dapat dihubungkan ke proyek setelah proyek dibuat.</p>
        </div>

        @include('admin.pembangunan.projects.form', [
            'project' => null,
            'action' => route('admin.pembangunan.projects.store'),
            'method' => 'POST',
            'submitLabel' => 'Simpan Proyek',
            'cancelUrl' => route('admin.pembangunan.index'),
        ])
    </div>
</x-layouts.admin>
