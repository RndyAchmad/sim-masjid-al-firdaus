<x-layouts.admin>
    <x-slot name="title">Detail Transaksi Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.index') }}</x-slot>

    @php
        $isPemasukan = $transaction->type === \App\Enums\TransactionType::INCOME;
    @endphp

    <div class="mx-auto grid max-w-6xl grid-cols-1 gap-6 lg:grid-cols-3">
        <section class="space-y-6 lg:col-span-2">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-col gap-4 border-b border-gray-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold {{ $isPemasukan ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $isPemasukan ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            {{ $transaction->type->label() }}
                        </span>

                        <h1 class="mt-3 text-xl font-bold text-gray-900 sm:text-2xl">
                            {{ $transaction->donor_or_source }}
                        </h1>
                    </div>

                    <div class="text-sm text-gray-500 sm:text-right">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Tanggal transaksi</p>
                        <p class="mt-1 font-medium text-gray-800">{{ $transaction->transaction_date->translatedFormat('d F Y') }}</p>
                    </div>
                </div>

                <div class="mt-5 rounded-xl border border-gray-100 bg-gray-50 p-4 sm:flex sm:items-center sm:justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Nominal</p>
                    <p class="mt-1 text-2xl font-bold sm:mt-0 {{ $isPemasukan ? 'text-emerald-700' : 'text-rose-700' }}">
                        {{ $isPemasukan ? '+' : '-' }} Rp {{ number_format((float) $transaction->amount, 0, ',', '.') }}
                    </p>
                </div>

                <dl class="mt-6 divide-y divide-gray-100 text-sm">
                    <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-semibold text-gray-500">Kategori</dt>
                        <dd class="text-gray-800 sm:col-span-2">
                            {{ $transaction->project?->name ?? 'Kas Pembangunan Umum' }}
                        </dd>
                    </div>
                    <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-semibold text-gray-500">Sumber / pihak terkait</dt>
                        <dd class="text-gray-800 sm:col-span-2">{{ $transaction->donor_or_source }}</dd>
                    </div>
                    <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-semibold text-gray-500">Rincian / peruntukan</dt>
                        <dd class="whitespace-pre-line leading-6 text-gray-800 sm:col-span-2">{{ $transaction->purpose }}</dd>
                    </div>
                </dl>
            </div>
        </section>

        <aside class="space-y-6">
            <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="border-b border-gray-100 pb-3 font-bold text-gray-900">Bukti Transaksi</h2>

                @if ($transaction->proof_file)
                    @if (in_array(strtolower(pathinfo($transaction->proof_file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'], true))
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($transaction->proof_file) }}"
                            alt="Bukti transaksi {{ $transaction->donor_or_source }}"
                            class="mt-4 max-h-72 w-full rounded-xl border border-gray-200 object-contain"
                        >
                    @endif

                    <a
                        href="{{ \Illuminate\Support\Facades\Storage::url($transaction->proof_file) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-4 inline-flex w-full items-center justify-center rounded-xl border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                    >
                        Buka bukti transaksi
                    </a>
                @else
                    <p class="mt-4 text-sm leading-6 text-gray-500">Belum ada bukti transaksi yang diunggah.</p>
                @endif
            </section>

            <section class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="border-b border-gray-100 pb-3 font-bold text-gray-900">Opsi Pengelolaan</h2>

                <div class="mt-4 space-y-2">
                    <a
                        href="{{ route('admin.pembangunan.transactions.edit', $transaction) }}"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]"
                    >
                        Edit Transaksi
                    </a>

                    <form
                        action="{{ route('admin.pembangunan.transactions.destroy', $transaction) }}"
                        method="POST"
                        data-confirm="Transaksi ini akan dihapus secara permanen."
                        data-confirm-title="Hapus transaksi?"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                            Hapus Transaksi
                        </button>
                    </form>
                </div>
            </section>
        </aside>
    </div>
</x-layouts.admin>
