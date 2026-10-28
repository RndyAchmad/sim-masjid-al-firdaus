<x-layouts.admin>
    <x-slot name="title">Detail Proyek Pembangunan</x-slot>
    <x-slot name="backUrl">{{ route('admin.pembangunan.index') }}</x-slot>

    @php
        $selisih = $totalPemasukan - $totalPengeluaran;
        $target = (float) $project->target_amount;
        $persentase = $target > 0 ? min(100, ($totalPemasukan / $target) * 100) : null;
    @endphp

    <div class="mx-auto max-w-6xl space-y-6">
        <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            @if ($project->image)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($project->image) }}" alt="Gambar {{ $project->name }}" class="h-52 w-full object-cover sm:h-64">
            @endif

            <div class="p-5 sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-[#a8833e]">{{ $project->status->label() }}</span>
                        <h1 class="mt-3 text-2xl font-bold tracking-tight text-gray-900">{{ $project->name }}</h1>
                        @if ($project->description)
                            <p class="mt-3 max-w-3xl whitespace-pre-line text-sm leading-6 text-gray-600">{{ $project->description }}</p>
                        @endif
                    </div>

                    <div class="flex shrink-0 gap-2">
                        <a href="{{ route('admin.pembangunan.projects.edit', $project) }}" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">Edit</a>
                        <form action="{{ route('admin.pembangunan.projects.destroy', $project) }}" method="POST" data-confirm="Proyek akan dihapus. Transaksi terkait tetap tersimpan sebagai kas pembangunan umum." data-confirm-title="Hapus proyek?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100">Hapus</button>
                        </form>
                    </div>
                </div>

                <dl class="mt-6 grid grid-cols-1 gap-4 border-t border-gray-100 pt-5 text-sm sm:grid-cols-3">
                    <div>
                        <dt class="text-gray-500">Tanggal mulai</dt>
                        <dd class="mt-1 font-semibold text-gray-800">{{ $project->start_date?->translatedFormat('d M Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Target selesai</dt>
                        <dd class="mt-1 font-semibold text-gray-800">{{ $project->end_date?->translatedFormat('d M Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Target anggaran</dt>
                        <dd class="mt-1 font-semibold text-gray-800">{{ $target > 0 ? 'Rp '.number_format($target, 0, ',', '.') : 'Belum ditetapkan' }}</dd>
                    </div>
                </dl>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <article class="rounded-2xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-sm">
                <p class="text-sm font-medium text-emerald-700">Pemasukan proyek</p>
                <p class="mt-3 text-2xl font-bold text-emerald-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </article>
            <article class="rounded-2xl border border-rose-200 bg-rose-50/50 p-5 shadow-sm">
                <p class="text-sm font-medium text-rose-700">Pengeluaran proyek</p>
                <p class="mt-3 text-2xl font-bold text-rose-700">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </article>
            <article class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Selisih transaksi</p>
                <p class="mt-3 text-2xl font-bold {{ $selisih < 0 ? 'text-rose-700' : 'text-gray-900' }}">Rp {{ number_format($selisih, 0, ',', '.') }}</p>
                @if ($persentase !== null)
                    <p class="mt-2 text-xs text-gray-500">{{ number_format($persentase, 1, ',', '.') }}% dari target anggaran</p>
                @endif
            </article>
        </section>

        <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-gray-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div>
                    <h2 class="font-bold text-gray-900">Riwayat Transaksi Proyek</h2>
                    <p class="mt-1 text-sm text-gray-500">Hanya transaksi yang memang terhubung ke proyek ini.</p>
                </div>
                <a href="{{ route('admin.pembangunan.transactions.create') }}" class="inline-flex items-center justify-center rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#a8833e]">Catat Transaksi</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px] text-left text-sm">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Jenis</th>
                            <th class="px-5 py-4">Sumber / pihak</th>
                            <th class="px-5 py-4">Rincian</th>
                            <th class="px-5 py-4 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($transaksi as $item)
                            @php $isIncome = $item->type === \App\Enums\TransactionType::INCOME; @endphp
                            <tr class="hover:bg-gray-50/80">
                                <td class="whitespace-nowrap px-5 py-4 font-medium text-gray-800">{{ $item->transaction_date->translatedFormat('d M Y') }}</td>
                                <td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $isIncome ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $item->type->label() }}</span></td>
                                <td class="px-5 py-4 text-gray-700">{{ $item->donor_or_source }}</td>
                                <td class="px-5 py-4 text-gray-600">{{ $item->purpose }}</td>
                                <td class="whitespace-nowrap px-5 py-4 text-right font-bold {{ $isIncome ? 'text-emerald-700' : 'text-rose-700' }}">{{ $isIncome ? '+' : '-' }} Rp {{ number_format((float) $item->amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-12 text-center text-sm text-gray-500">Belum ada transaksi yang terhubung ke proyek ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($transaksi->hasPages())
                <div class="border-t border-gray-100 px-5 py-4 sm:px-6">{{ $transaksi->links() }}</div>
            @endif
        </section>
    </div>
</x-layouts.admin>
