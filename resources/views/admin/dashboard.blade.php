<x-layouts.admin>
    <x-slot name="title">Dashboard</x-slot>

    <div class="space-y-6">
        {{-- Header Sambutan --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d]">
                        SIM Masjid Al-Firdaus
                    </p>
                    <h2 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl">
                        Assalamu'alaikum, {{ $user->name ?? 'Takmir Masjid' }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Ringkasan angka utama dalam bentuk card dan rincian data dalam bentuk tabel.
                    </p>
                </div>

                <span class="inline-flex w-fit items-center rounded-full bg-[#c49c4d]/15 px-3.5 py-1 text-xs font-semibold text-[#9a762d] capitalize">
                    {{ $role }}
                </span>
            </div>
        </div>

        {{-- Grid Card Statistik (1 Card = 1 Data) --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @if ($isBendahara)
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Saldo Kas Masjid</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        Rp {{ number_format($cards['cash_balance'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Proyek Pembangunan Berjalan</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($cards['ongoing_projects_count']) }} Proyek
                    </p>
                </div>
            @endif

            @if ($isSekretaris)
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Total Inventaris</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($cards['inventories_count']) }} Barang
                    </p>
                </div>
            @endif

            @if ($isAdmin)
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Total Infaq</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        Rp {{ number_format($cards['infaq_total'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Jumlah Kegiatan</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($cards['activities_count']) }} Kegiatan
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Jumlah Artikel</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($cards['articles_count']) }} Artikel
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Jumlah Berita & Pengumuman</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($cards['news_count']) }} Berita
                    </p>
                </div>
            @endif

            @if ($isSuperadmin)
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-xs">
                    <p class="text-xs font-medium text-gray-500">Total Akun Pengguna</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($cards['users_count']) }} User
                    </p>
                </div>
            @endif
        </div>

        {{-- Tabel Jadwal Shalat Jumat Terdekat --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Jadwal Shalat Jumat Terdekat</h3>
                    <p class="text-xs text-gray-500">Daftar imam, khatib, dan muadzin mendatang</p>
                </div>
                @if ($isAdmin)
                    <a href="{{ route('admin.jadwal-imam.index') }}"
                        class="text-xs font-semibold text-[#9a762d] hover:underline">
                        Lihat Semua
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Imam</th>
                            <th class="px-6 py-3">Khatib</th>
                            <th class="px-6 py-3">Muadzin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($upcomingFridaySchedules as $schedule)
                            <tr class="hover:bg-gray-50/80">
                                <td class="whitespace-nowrap px-6 py-3.5 font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d M Y') }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-3.5 text-gray-700">
                                    {{ $schedule->imam }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                    {{ $schedule->khatib ?: '-' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                    {{ $schedule->muadzin ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-400">
                                    Belum ada jadwal Shalat Jumat mendatang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($isBendahara)
            {{-- Tabel Transaksi Kas Terbaru --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Transaksi Kas Terbaru</h3>
                        <p class="text-xs text-gray-500">Riwayat pemasukan dan pengeluaran keuangan</p>
                    </div>
                    <a href="{{ route('admin.laporan-keuangan.index') }}"
                        class="text-xs font-semibold text-[#9a762d] hover:underline">
                        Laporan Lengkap
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Keterangan</th>
                                <th class="px-6 py-3">Jenis</th>
                                <th class="px-6 py-3 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($recentFinancialReports as $report)
                                @php $isIncome = ($report->type ?? '') === 'income'; @endphp
                                <tr class="hover:bg-gray-50/80">
                                    <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                        {{ \Carbon\Carbon::parse($report->transaction_date)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-6 py-3.5 font-medium text-gray-900">
                                        {{ $report->description }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5">
                                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $isIncome ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                            {{ $isIncome ? 'Pemasukan' : 'Pengeluaran' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5 text-right font-bold {{ $isIncome ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $isIncome ? '+' : '-' }} Rp {{ number_format((float) $report->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-400">
                                        Belum ada transaksi keuangan tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if ($isAdmin)
            {{-- Tabel Kegiatan Terbaru --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Kegiatan Terbaru</h3>
                        <p class="text-xs text-gray-500">Agenda kajian, shalat Jumat, dan acara masjid</p>
                    </div>
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="text-xs font-semibold text-[#9a762d] hover:underline">
                        Kelola Kegiatan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Nama Kegiatan</th>
                                <th class="px-6 py-3">Tipe</th>
                                <th class="px-6 py-3">Pemateri</th>
                                <th class="px-6 py-3">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($recentActivities as $activity)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-6 py-3.5 font-medium text-gray-900">
                                        {{ $activity->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                        {{ $activity->tipe ?: '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                        {{ $activity->speaker ?: '-' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                        {{ $activity->location ?: '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-400">
                                        Belum ada data kegiatan tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if ($isSekretaris)
            {{-- Tabel Inventaris Terbaru --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xs">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Inventaris Terbaru</h3>
                        <p class="text-xs text-gray-500">Daftar barang dan kondisi perlengkapan masjid</p>
                    </div>
                    <a href="{{ route('admin.inventaris.index') }}"
                        class="text-xs font-semibold text-[#9a762d] hover:underline">
                        Kelola Inventaris
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Nama Barang</th>
                                <th class="px-6 py-3">Jumlah</th>
                                <th class="px-6 py-3">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($recentInventories as $item)
                                <tr class="hover:bg-gray-50/80">
                                    <td class="px-6 py-3.5 font-medium text-gray-900">
                                        {{ $item->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                        {{ $item->quantity }} {{ $item->unit ?? 'Unit' }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3.5 text-gray-600">
                                        {{ $item->condition ?: '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-6 text-center text-sm text-gray-400">
                                        Belum ada data inventaris tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts.admin>
