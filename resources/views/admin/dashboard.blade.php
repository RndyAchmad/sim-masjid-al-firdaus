<x-layouts.admin>
    <x-slot name="title">Dashboard</x-slot>

    <div class="space-y-6">
        <!-- Header Sambutan -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#c49c4d]">
                        SIM Masjid Al-Firdaus
                    </p>
                    <h2 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl">
                        Assalamu'alaikum, {{ $user->name ?? 'Takmir Masjid' }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Pantau ringkasan data masjid, keuangan, kegiatan, dan akses cepat modul sesuai hak akses Anda.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-full bg-[#c49c4d]/15 px-3.5 py-1 text-xs font-semibold text-[#9a762d] capitalize">
                        {{ $role }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Kartu Ringkasan KPI -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @if ($isBendahara)
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium text-gray-500">Saldo Kas Masjid</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        Rp {{ number_format($stats['cash_balance'], 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-xs text-gray-400">
                        Masuk: Rp {{ number_format($stats['income_total'], 0, ',', '.') }} · Keluar: Rp {{ number_format($stats['expense_total'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium text-gray-500">Proyek Pembangunan Berjalan</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($stats['ongoing_projects_count']) }} <span class="text-sm font-semibold text-gray-500">Proyek</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">Status ongoing pada pembangunan masjid</p>
                </div>
            @endif

            @if ($isSekretaris)
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium text-gray-500">Total Item Inventaris</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($stats['inventories_count']) }} <span class="text-sm font-semibold text-gray-500">Barang</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">Perlengkapan & aset tercatat</p>
                </div>
            @endif

            @if ($isAdmin)
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium text-gray-500">Zakat Fitrah Terkumpul</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($zakatSummary['fitrah_rice_kg'], 2, ',', '.') }} <span class="text-sm font-semibold text-gray-500">Kg</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">
                        {{ number_format($zakatSummary['total_persons']) }} jiwa · Mal & Infaq: Rp {{ number_format($zakatSummary['mal_cash_amount'] + $zakatSummary['infaq_cash_amount'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium text-gray-500">Konten & Agenda</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($stats['activities_count'] + $stats['articles_count'] + $stats['news_count']) }} <span class="text-sm font-semibold text-gray-500">Data</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">
                        {{ $stats['activities_count'] }} Kegiatan · {{ $stats['articles_count'] }} Artikel · {{ $stats['news_count'] }} Berita
                    </p>
                </div>
            @endif

            @if ($isSuperadmin)
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-medium text-gray-500">Akun Pengurus</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ number_format($stats['users_count']) }} <span class="text-sm font-semibold text-gray-500">User</span>
                    </p>
                    <p class="mt-1 text-xs text-gray-400">Superadmin, Admin, Bendahara & Sekretaris</p>
                </div>
            @endif
        </div>

        <!-- Grid Konten Tengah: Jadwal Jumat & Aktivitas/Keuangan -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Jadwal Shalat Jumat Terdekat -->
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Jadwal Shalat Jumat Terdekat</h3>
                        <p class="text-xs text-gray-500">Imam, khatib, dan muadzin yang terjadwal</p>
                    </div>
                    @if ($isAdmin)
                        <a href="{{ route('admin.jadwal-imam.index') }}"
                            class="text-xs font-semibold text-[#c49c4d] hover:underline">
                            Lihat Semua
                        </a>
                    @endif
                </div>

                <div class="mt-4 divide-y divide-gray-100">
                    @forelse ($upcomingFridaySchedules as $schedule)
                        <div class="flex items-center justify-between py-3 first:pt-0 last:pb-0">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Imam: <span class="font-medium text-gray-700">{{ $schedule->imam }}</span>
                                    @if (!empty($schedule->khatib))
                                        · Khatib: <span class="font-medium text-gray-700">{{ $schedule->khatib }}</span>
                                    @endif
                                </p>
                            </div>
                            @if (!empty($schedule->muadzin))
                                <span class="rounded-md bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">
                                    Muadzin: {{ $schedule->muadzin }}
                                </span>
                            @endif
                        </div>
                    @empty
                        <p class="py-6 text-center text-sm text-gray-400">
                            Belum ada jadwal Shalat Jumat mendatang.
                        </p>
                    @endforelse
                </div>
            </div>

            <!-- Transaksi Keuangan Terbaru (Bendahara/Superadmin) atau Kegiatan Terbaru (Admin/Superadmin) -->
            @if ($isBendahara)
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-gray-900">Transaksi Kas Terbaru</h3>
                            <p class="text-xs text-gray-500">Pemasukan & pengeluaran terakhir</p>
                        </div>
                        <a href="{{ route('admin.laporan-keuangan.index') }}"
                            class="text-xs font-semibold text-[#c49c4d] hover:underline">
                            Laporan Lengkap
                        </a>
                    </div>

                    <div class="mt-4 divide-y divide-gray-100">
                        @forelse ($recentFinancialReports as $report)
                            @php $isIncome = ($report->type ?? '') === 'income'; @endphp
                            <div class="flex items-center justify-between gap-3 py-3 first:pt-0 last:pb-0">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-gray-800">
                                        {{ $report->description }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($report->transaction_date)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                                <span class="shrink-0 text-sm font-bold {{ $isIncome ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $isIncome ? '+' : '-' }} Rp {{ number_format((float) $report->amount, 0, ',', '.') }}
                                </span>
                            </div>
                        @empty
                            <p class="py-6 text-center text-sm text-gray-400">
                                Belum ada transaksi keuangan tercatat.
                            </p>
                        @endforelse
                    </div>
                </div>
            @elseif ($isAdmin)
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-gray-900">Agenda Kegiatan Terbaru</h3>
                            <p class="text-xs text-gray-500">Kajian, shalat Jumat, dan acara masjid</p>
                        </div>
                        <a href="{{ route('admin.kegiatan.index') }}"
                            class="text-xs font-semibold text-[#c49c4d] hover:underline">
                            Kelola Kegiatan
                        </a>
                    </div>

                    <div class="mt-4 divide-y divide-gray-100">
                        @forelse ($recentActivities as $activity)
                            <div class="flex items-center justify-between gap-3 py-3 first:pt-0 last:pb-0">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-gray-800">{{ $activity->name }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $activity->tipe ?? 'Kegiatan' }} · {{ $activity->location ?? '-' }}
                                    </p>
                                </div>
                                <span class="shrink-0 rounded-full bg-[#c49c4d]/15 px-2.5 py-0.5 text-xs font-semibold text-[#9a762d]">
                                    {{ $activity->time ? substr($activity->time, 0, 5) : '-' }}
                                </span>
                            </div>
                        @empty
                            <p class="py-6 text-center text-sm text-gray-400">
                                Belum ada jadwal kegiatan tercatat.
                            </p>
                        @endforelse
                    </div>
                </div>
            @else
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-bold text-gray-900">Pintasan Sekretaris</h3>
                    <p class="mt-1 text-xs text-gray-500">Akses cepat ke profil masjid dan inventaris barang.</p>
                    <div class="mt-4 space-y-2.5">
                        <a href="{{ route('admin.profile') }}"
                            class="flex items-center justify-between rounded-lg border border-gray-200 px-4 py-3 text-sm font-medium text-gray-700 transition hover:border-[#c49c4d] hover:text-[#c49c4d]">
                            <span>Profil Masjid</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="{{ route('admin.inventaris.index') }}"
                            class="flex items-center justify-between rounded-lg border border-gray-200 px-4 py-3 text-sm font-medium text-gray-700 transition hover:border-[#c49c4d] hover:text-[#c49c4d]">
                            <span>Inventaris Masjid</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pintasan Semua Modul Sesuai Role -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="text-base font-bold text-gray-900">Navigasi Cepat Modul</h3>
            <p class="text-xs text-gray-500">Langsung buka halaman pengelolaan data sesuai hak akses akun.</p>

            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                @if (in_array($role, ['superadmin', 'admin', 'sekretaris'], true))
                    <a href="{{ route('admin.profile') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Profil Masjid
                    </a>
                @endif

                @if ($isAdmin)
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Kegiatan & Jadwal
                    </a>
                    <a href="{{ route('admin.articles.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Artikel Keislaman
                    </a>
                    <a href="{{ route('admin.jadwal-imam.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Jadwal Imam Jumat
                    </a>
                    <a href="{{ route('admin.berita.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Berita & Pengumuman
                    </a>
                    <a href="{{ route('admin.zakat.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Pencatatan Zakat
                    </a>
                    <a href="{{ route('admin.idul-adha.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Kurban Idul Adha
                    </a>
                @endif

                @if ($isSekretaris)
                    <a href="{{ route('admin.inventaris.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Inventaris Barang
                    </a>
                @endif

                @if ($isBendahara)
                    <a href="{{ route('admin.laporan-keuangan.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Laporan Keuangan
                    </a>
                    <a href="{{ route('admin.pembangunan.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Pembangunan Masjid
                    </a>
                @endif

                @if ($isSuperadmin)
                    <a href="{{ route('admin.users.index') }}"
                        class="rounded-lg border border-gray-200 p-3.5 text-sm font-semibold text-gray-800 transition hover:border-[#c49c4d] hover:bg-[#c49c4d]/5">
                        Manajemen Pengguna
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
