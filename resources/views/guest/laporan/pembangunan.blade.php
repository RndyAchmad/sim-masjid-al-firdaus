<x-layouts.guest>
    <x-slot name="title">Laporan Keuangan Pembangunan | Masjid Al-Firdaus</x-slot>

    <div class="border-b border-gray-800 bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">Infaq & Wakaf Pembangunan</span>
            <h1 class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl">Laporan Keuangan Pembangunan</h1>
            <p class="mx-auto mt-3 max-w-3xl text-sm text-gray-400 sm:text-base">Rekap penerimaan dan penggunaan dana pembangunan serta renovasi Masjid Al-Firdaus.</p>
        </div>
    </div>

    <div class="bg-[#FBF9F5] py-12 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8">
            <section>
                <div class="mb-8 text-center">
                    <span class="inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm">Akuntabilitas & Amanah</span>
                    <h2 class="mt-3 font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Ringkasan Kas Pembangunan</h2>
                    <p class="mt-2 text-sm text-gray-600">Pemasukan dan pengeluaran untuk periode {{ $namaBulan }}.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <article class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-md">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Pemasukan {{ $namaBulan }}</p>
                        <p class="mt-4 font-mono text-2xl font-bold text-emerald-700 sm:text-3xl">Rp {{ number_format($pemasukanBulan, 0, ',', '.') }}</p>
                        <p class="mt-2 text-xs font-medium text-emerald-700">Dana diterima pada periode terpilih.</p>
                    </article>
                    <article class="rounded-2xl border border-rose-100 bg-white p-6 shadow-md">
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Pengeluaran {{ $namaBulan }}</p>
                        <p class="mt-4 font-mono text-2xl font-bold text-rose-700 sm:text-3xl">Rp {{ number_format($pengeluaranBulan, 0, ',', '.') }}</p>
                        <p class="mt-2 text-xs font-medium text-rose-700">Dana digunakan pada periode terpilih.</p>
                    </article>
                    <article class="rounded-2xl border border-[#8c6b2d]/30 bg-linear-to-br from-white via-white to-[#F7F4EE] p-6 shadow-md sm:col-span-2 lg:col-span-1">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#8c6b2d]">Saldo Kas Pembangunan</p>
                        <p class="mt-4 font-mono text-2xl font-bold text-[#8c6b2d] sm:text-3xl">Rp {{ number_format($saldoKas, 0, ',', '.') }}</p>
                        <p class="mt-2 text-xs font-medium text-gray-500">Akumulasi seluruh pemasukan dikurangi pengeluaran.</p>
                    </article>
                </div>
            </section>

            <section>
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="inline-flex rounded-full border border-[#6e5321] bg-[#8c6b2d] px-3.5 py-1 text-xs font-semibold text-white shadow-sm">Rincian Transaksi</span>
                        <h2 class="mt-3 font-serif text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Buku Kas Pembangunan</h2>
                    </div>

                    <form action="{{ route('laporan.pembangunan') }}" method="GET" class="flex items-end gap-2">
                        <div>
                            <label for="bulan" class="mb-1 block text-xs font-semibold text-gray-600">Periode</label>
                            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="rounded-xl border border-stone-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d]">
                        </div>
                        <button type="submit" class="rounded-xl bg-[#8c6b2d] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#6e5321]">Tampilkan</button>
                    </form>
                </div>

                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-md">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[760px] text-left text-xs text-gray-600 sm:text-sm">
                            <thead class="border-b border-stone-200 bg-stone-100 text-[11px] font-bold uppercase tracking-wider text-gray-700 sm:text-xs">
                                <tr>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Tanggal</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Sumber / Pihak</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Alokasi</th>
                                    <th class="px-4 py-3.5 sm:px-6 sm:py-4">Jenis</th>
                                    <th class="px-4 py-3.5 text-right sm:px-6 sm:py-4">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 bg-white">
                                @forelse ($transaksi as $item)
                                    @php $isPemasukan = $item->type === \App\Enums\TransactionType::INCOME; @endphp
                                    <tr class="transition hover:bg-stone-50/80">
                                        <td class="whitespace-nowrap px-4 py-3.5 font-medium text-stone-500 sm:px-6 sm:py-4">{{ $item->transaction_date->translatedFormat('d M Y') }}</td>
                                        <td class="px-4 py-3.5 font-semibold text-gray-900 sm:px-6 sm:py-4">{{ $item->donor_or_source }}</td>
                                        <td class="px-4 py-3.5 sm:px-6 sm:py-4">
                                            <p class="font-medium text-gray-700">{{ $item->project?->name ?? 'Kas Pembangunan Umum' }}</p>
                                            <p class="mt-1 max-w-xs text-xs leading-5 text-gray-500">{{ $item->purpose }}</p>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3.5 sm:px-6 sm:py-4">
                                            <span class="inline-flex rounded-full border px-2.5 py-0.5 text-[11px] font-bold {{ $isPemasukan ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-rose-200 bg-rose-50 text-rose-700' }}">{{ $item->type->label() }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3.5 text-right font-mono font-bold sm:px-6 sm:py-4 {{ $isPemasukan ? 'text-emerald-600' : 'text-rose-600' }}">{{ $isPemasukan ? '+' : '-' }} {{ number_format((float) $item->amount, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">Belum ada transaksi pembangunan pada periode {{ $namaBulan }}.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($transaksi->hasPages())
                        <div class="border-t border-stone-200 px-4 py-4 sm:px-6">{{ $transaksi->links() }}</div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layouts.guest>
