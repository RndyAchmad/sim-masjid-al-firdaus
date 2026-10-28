<x-layouts.guest>
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

        $rupiah = fn($nilai) => 'Rp ' . number_format((float) $nilai, 0, ',', '.');
    @endphp

    {{-- HEADER HALAMAN --}}
    <div
        class="relative bg-linear-to-b from-black via-[#080806] to-[#121212] py-12 sm:py-16 md:py-20 border-b border-gray-800">
        <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#d8b76a] sm:text-xs">
                Transparansi Ummat
            </span>
            <h1
                class="mt-2 font-serif text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Laporan Keuangan Operasional
            </h1>
            <p class="mt-2 text-xs text-gray-400 sm:mt-3 sm:text-sm md:text-base">
                Laporan penerimaan infak, sedekah, dan pengeluaran operasional rutin Masjid Al-Firdaus
            </p>
            <div
                class="mx-auto mt-4 h-px w-16 bg-linear-to-r from-transparent via-[#d8b76a] to-transparent sm:mt-6 sm:w-20">
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <main class="bg-[#FBF9F5] py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-7xl space-y-10 px-4 sm:px-6 lg:px-8 sm:space-y-12">

            {{-- SALDO KAS KESELURUHAN --}}
            <section>
                <div class="mb-5">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#8c6b2d]">
                        Ringkasan Keuangan
                    </p>

                    <h2 class="mt-2 font-serif text-2xl font-bold text-gray-900 sm:text-3xl">
                        Saldo Kas Keseluruhan
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Akumulasi pemasukan dikurangi pengeluaran yang tercatat sampai hari ini.
                    </p>
                </div>

                <div
                    class="relative overflow-hidden rounded-3xl border border-[#8c6b2d]/30 bg-linear-to-br from-[#17150f] via-[#262116] to-[#47371b] p-6 shadow-xl sm:p-9 lg:p-10">
                    <div
                        class="pointer-events-none absolute -right-12 -top-16 h-56 w-56 rounded-full border border-[#d8b76a]/10">
                    </div>
                    <div
                        class="pointer-events-none absolute -right-4 -top-8 h-40 w-40 rounded-full border border-[#d8b76a]/10">
                    </div>

                    <div class="relative grid grid-cols-1 items-center gap-7 lg:grid-cols-[1fr_auto]">
                        <div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-[#d8b76a]/30 bg-[#d8b76a]/10 text-[#e4c77f]">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-[#e4c77f]">
                                        Posisi Saldo Kas
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400">
                                        Per {{ now()->locale('id')->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <p
                                class="mt-6 wrap-break-word font-mono text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
                                {{ $rupiah($saldoKas) }}
                            </p>

                            <p class="mt-4 max-w-2xl text-xs leading-relaxed text-gray-300 sm:text-sm">
                                Saldo dihitung dari seluruh pemasukan dikurangi pengeluaran yang tercatat hingga hari
                                ini. Saldo awal sebelum pencatatan sistem dimulai belum termasuk.
                            </p>
                        </div>

                        <div
                            class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-4 lg:min-w-52 lg:flex-col lg:items-start lg:p-5">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $saldoKas < 0 ? 'bg-rose-500/15 text-rose-300' : 'bg-emerald-500/15 text-emerald-300' }}">
                                @if ($saldoKas < 0)
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v4m0 4h.01M10.3 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.7 3.86a2 2 0 00-3.4 0z" />
                                    </svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @endif
                            </div>

                            <div>
                                <p class="text-xs text-gray-400">Status saldo tercatat</p>
                                <p
                                    class="mt-1 text-sm font-bold {{ $saldoKas < 0 ? 'text-rose-300' : 'text-emerald-300' }}">
                                    {{ $saldoKas < 0 ? 'Saldo negatif' : 'Saldo tidak negatif' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- FILTER PERIODE --}}
            <section class="rounded-2xl border border-stone-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900">
                            Lihat Laporan Periode
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Pilih bulan dan tahun untuk melihat ringkasan serta rincian transaksi.
                        </p>
                    </div>

                    <form action="{{ url()->current() }}" method="GET"
                        class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                        <select name="bulan" aria-label="Pilih bulan"
                            class="w-full rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-gray-700 focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:w-40">
                            @foreach ($daftarBulan as $nomorBulan => $namaBulan)
                                <option value="{{ $nomorBulan }}" @selected((int) $bulan === (int) $nomorBulan)>
                                    {{ $namaBulan }}
                                </option>
                            @endforeach
                        </select>

                        <select name="tahun" aria-label="Pilih tahun"
                            class="w-full rounded-xl border border-stone-200 bg-white px-4 py-3 text-sm text-gray-700 focus:border-[#8c6b2d] focus:outline-none focus:ring-1 focus:ring-[#8c6b2d] sm:w-32">
                            @foreach ($daftarTahun as $opsiTahun)
                                <option value="{{ $opsiTahun }}" @selected((int) $tahun === (int) $opsiTahun)>
                                    {{ $opsiTahun }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="rounded-xl bg-[#8c6b2d] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#6e5321]">
                            Tampilkan
                        </button>
                    </form>
                </div>
            </section>

            {{-- RINGKASAN PERIODE --}}
            <section>
                <div class="mb-6">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8c6b2d]">
                        Ringkasan Bulanan
                    </p>

                    <h2 class="mt-2 font-serif text-2xl font-bold text-gray-900 sm:text-3xl">
                        Keuangan {{ $daftarBulan[$bulan] }} {{ $tahun }}
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        @if ($periodeBelumBerjalan)
                            Laporan {{ $daftarBulan[$bulan] }} {{ $tahun }} belum tersedia karena periode belum dimulai.
                        @else
                            Ringkasan pemasukan, pengeluaran, dan selisih transaksi pada periode yang dipilih.
                        @endif
                    </p>
                </div>

                @if ($periodeBelumBerjalan)
                    <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm">
                        <p class="font-semibold text-gray-900">
                            Periode Belum Dimulai
                        </p>
                        <p class="mt-2 text-sm leading-relaxed text-gray-500">
                            Ringkasan keuangan akan tersedia setelah bulan
                            {{ $daftarBulan[$bulan] }} {{ $tahun }} dimulai dan transaksi tercatat di sistem.
                        </p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        {{-- TOTAL PEMASUKAN --}}
                        <div
                            class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:border-emerald-300 hover:shadow-md sm:p-7">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Total Pemasukan
                                    </p>

                                    <p class="mt-4 wrap-break-word font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                                        {{ $rupiah($totalPemasukan) }}
                                    </p>

                                    <p class="mt-3 text-xs text-emerald-700">
                                        Pemasukan tercatat pada periode terpilih
                                    </p>
                                </div>

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-100 bg-emerald-50 text-emerald-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19V5m-7 7l7-7 7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- TOTAL PENGELUARAN --}}
                        <div
                            class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:border-rose-300 hover:shadow-md sm:p-7">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Total Pengeluaran
                                    </p>

                                    <p class="mt-4 wrap-break-word font-mono text-2xl font-bold text-gray-900 sm:text-3xl">
                                        {{ $rupiah($totalPengeluaran) }}
                                    </p>

                                    <p class="mt-3 text-xs text-rose-700">
                                        Pengeluaran tercatat pada periode terpilih
                                    </p>
                                </div>

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-rose-100 bg-rose-50 text-rose-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v14m7-7l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- SELISIH PERIODE --}}
                        <div
                            class="rounded-2xl border border-stone-200 bg-white p-6 shadow-sm transition hover:border-[#c49c4d]/50 hover:shadow-md sm:p-7">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                        Selisih Periode
                                    </p>

                                    <p
                                        class="mt-4 wrap-break-word font-mono text-2xl font-bold sm:text-3xl {{ $selisihPeriode < 0 ? 'text-rose-600' : 'text-[#8c6b2d]' }}">
                                        {{ $selisihPeriode < 0 ? '− ' : '' }}{{ $rupiah(abs($selisihPeriode)) }}
                                    </p>

                                    <p class="mt-3 text-xs {{ $selisihPeriode < 0 ? 'text-rose-700' : 'text-gray-500' }}">
                                        Pemasukan dikurangi pengeluaran pada periode ini, tidak termasuk saldo awal.
                                    </p>
                                </div>

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-[#c49c4d]/20 bg-[#c49c4d]/10 text-[#8c6b2d]">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h8m-8 10h8M5 12h14" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KETERANGAN SALDO AKHIR PERIODE --}}
                    <div class="mt-5 rounded-2xl border border-[#c49c4d]/30 bg-white p-5 shadow-sm sm:p-6">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Saldo Akhir Periode
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Saldo awal ditambah selisih transaksi periode terpilih.
                                </p>
                            </div>

                            <p
                                class="font-mono text-xl font-bold {{ $saldoAkhirPeriode < 0 ? 'text-rose-600' : 'text-[#8c6b2d]' }} sm:text-2xl">
                                {{ $rupiah($saldoAkhirPeriode) }}
                            </p>
                        </div>
                    </div>
                @endif
            </section>

            <div class="border-t border-stone-200"></div>

            {{-- BUKU KAS OPERASIONAL --}}
            <section>
                <div class="mb-6">
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8c6b2d]">
                        Transparansi Transaksi
                    </p>

                    <h2 class="mt-2 font-serif text-2xl font-bold text-gray-900 sm:text-3xl">
                        Buku Kas Operasional
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        @if ($periodeBelumBerjalan)
                            Transaksi untuk {{ $daftarBulan[$bulan] }} {{ $tahun }} belum tersedia karena periode belum
                            dimulai.
                        @else
                            Rincian transaksi {{ $daftarBulan[$bulan] }} {{ $tahun }}.
                            Saldo awal menunjukkan akumulasi saldo sebelum periode ini, bukan transaksi baru.
                        @endif
                    </p>
                </div>

                <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-170 text-left text-sm text-gray-600">
                            <thead
                                class="border-b border-stone-200 bg-stone-100 text-[11px] font-bold uppercase tracking-wider text-gray-700 sm:text-xs">
                                <tr>
                                    <th class="px-4 py-4 sm:px-6">Tanggal</th>
                                    <th class="px-4 py-4 sm:px-6">Keterangan Transaksi</th>
                                    <th class="px-4 py-4 sm:px-6">Jenis</th>
                                    <th class="px-4 py-4 text-right sm:px-6">Jumlah (Rp)</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-stone-100">

                                @if ($periodeBelumBerjalan)
                                    <tr>
                                        <td colspan="4" class="px-6 py-14 text-center">
                                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                                <div
                                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-stone-100 text-stone-400">
                                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M8 7h8m-8 4h8m-8 4h5M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                                    </svg>
                                                </div>

                                                <p class="mt-4 font-semibold text-gray-800">
                                                    Periode Belum Dimulai
                                                </p>

                                                <p class="mt-1 text-sm leading-relaxed text-gray-500">
                                                    Laporan {{ $daftarBulan[$bulan] }} {{ $tahun }} belum tersedia.
                                                    Silakan pilih periode yang sedang berjalan atau periode sebelumnya.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @else

                                    {{-- SALDO AWAL PERIODE --}}
                                    <tr class="bg-[#FBF9F5]">
                                        <td class="whitespace-nowrap px-4 py-4 font-medium text-stone-500 sm:px-6">
                                            {{ \Illuminate\Support\Carbon::create($tahun, $bulan, 1)->locale('id')->translatedFormat('d M Y') }}
                                        </td>

                                        <td class="px-4 py-4 font-semibold text-gray-900 sm:px-6">
                                            Saldo Awal Periode
                                            <p class="mt-1 text-xs font-normal text-gray-500">
                                                Saldo kumulatif sebelum {{ $daftarBulan[$bulan] }} {{ $tahun }}.
                                                Bukan transaksi baru pada periode ini.
                                            </p>
                                        </td>

                                        <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                                            <span
                                                class="inline-flex rounded-full border border-[#c49c4d]/30 bg-[#c49c4d]/10 px-2.5 py-1 text-[11px] font-bold text-[#8c6b2d]">
                                                Saldo Awal
                                            </span>
                                        </td>

                                        <td
                                            class="whitespace-nowrap px-4 py-4 text-right font-mono font-bold text-[#8c6b2d] sm:px-6">
                                            {{ $rupiah($saldoAwalPeriode) }}
                                        </td>
                                    </tr>

                                    @forelse ($transaksi as $item)
                                        @php
                                            $jenisTransaksi = $item->type instanceof \BackedEnum
                                                ? $item->type->value
                                                : $item->type;

                                            $isPemasukan = $jenisTransaksi === 'income';
                                        @endphp

                                        <tr class="transition hover:bg-[#FBF9F5]">
                                            <td class="whitespace-nowrap px-4 py-4 font-medium text-stone-500 sm:px-6">
                                                {{ \Illuminate\Support\Carbon::parse($item->transaction_date)->locale('id')->translatedFormat('d M Y') }}
                                            </td>

                                            <td
                                                class="max-w-md whitespace-normal wrap-break-word px-4 py-4 font-medium text-gray-900 sm:px-6">
                                                {{ $item->description }}
                                            </td>

                                            <td class="whitespace-nowrap px-4 py-4 sm:px-6">
                                                @if ($isPemasukan)
                                                    <span
                                                        class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700">
                                                        Pemasukan
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex rounded-full border border-rose-200 bg-rose-50 px-2.5 py-1 text-[11px] font-bold text-rose-700">
                                                        Pengeluaran
                                                    </span>
                                                @endif
                                            </td>

                                            <td
                                                class="whitespace-nowrap px-4 py-4 text-right font-mono font-bold sm:px-6 {{ $isPemasukan ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $isPemasukan ? '+' : '−' }}
                                                {{ number_format((float) $item->amount, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-14 text-center">
                                                <div class="mx-auto flex max-w-sm flex-col items-center">
                                                    <div
                                                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-stone-100 text-stone-400">
                                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M8 7h8m-8 4h8m-8 4h5M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012 2z" />
                                                        </svg>
                                                    </div>

                                                    <p class="mt-4 font-semibold text-gray-800">
                                                        Belum Ada Transaksi
                                                    </p>

                                                    <p class="mt-1 text-sm text-gray-500">
                                                        Belum ada transaksi tercatat pada
                                                        {{ $daftarBulan[$bulan] }} {{ $tahun }}.
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                @endif

                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if (!$periodeBelumBerjalan && $transaksi->hasPages())
                        <div class="border-t border-stone-200 px-4 py-4 sm:px-6">
                            <p class="mb-3 text-xs text-gray-500 sm:text-sm">
                                Menampilkan {{ $transaksi->firstItem() }}–{{ $transaksi->lastItem() }}
                                dari {{ $transaksi->total() }} transaksi
                            </p>

                            {{ $transaksi->links() }}
                        </div>
                    @endif
                </div>

                <p class="mt-4 text-xs leading-relaxed text-gray-500">
                    Catatan: laporan ini berdasarkan transaksi yang tercatat di sistem. Saldo awal periode dihitung
                    dari transaksi sebelum periode terpilih. Saldo kas aktual juga bergantung pada kelengkapan
                    pencatatan dan saldo awal masjid.
                </p>
            </section>
        </div>
    </main>
</x-layouts.guest>
