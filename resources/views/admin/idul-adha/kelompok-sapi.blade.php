<x-layouts.admin>
    <x-slot name="title">Kelola Kelompok Sapi — {{ $hijriYear }} H</x-slot>
    <x-slot name="backUrl">{{ route('admin.idul-adha.index', ['hijri_year' => $hijriYear]) }}</x-slot>

    @php
        $hijriYear = (string) ($hijriYear ?? ($latestHijriYear ?? '1448'));
        $availableHijriYears = $availableHijriYears ?? collect();
        $yearOptions = $availableHijriYears->isNotEmpty()
            ? $availableHijriYears
            : collect([$hijriYear]);
        $cowGroups = $cowGroups ?? collect();
        $availableCowQurbans = $availableCowQurbans ?? collect();
        $maxMembers = \App\Models\IdulAdhaCowGroup::MAX_MEMBERS;
        $totalAssignedMembers = $cowGroups->sum(fn ($g) => $g->members->count());
    @endphp

    <div class="space-y-6">
        {{-- Header & Filter Tahun --}}
        <div class="flex flex-col justify-between gap-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center">
            <div class="space-y-1">
                <div class="flex flex-wrap items-center gap-2.5">
                    <h2 class="text-xl font-bold text-gray-900">Kelola Kelompok Sapi</h2>
                    <span class="inline-flex rounded-lg bg-[#c49c4d]/15 px-2.5 py-0.5 text-xs font-semibold text-[#9c7832]">
                        {{ $hijriYear }} H
                    </span>
                    <span class="inline-flex rounded-lg bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">
                        {{ $cowGroups->count() }} Kelompok • {{ $totalAssignedMembers }} Peserta Terkelompok
                    </span>
                </div>
                <p class="text-xs text-gray-500">
                    Kelompokkan peserta qurban sapi per ekor (maksimal {{ $maxMembers }} orang per sapi). Kambing dan infaq tidak masuk kelompok sapi.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <form action="{{ route('admin.idul-adha.kelompok-sapi.index') }}" method="GET" class="flex items-center gap-2">
                    <label for="group_hijri_year" class="text-xs font-semibold text-gray-700">Tahun:</label>
                    <select id="group_hijri_year" name="hijri_year" onchange="this.form.submit()"
                        class="rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm font-semibold text-gray-900 focus:border-[#c49c4d] focus:outline-none focus:ring-2 focus:ring-[#c49c4d]/20">
                        @foreach ($yearOptions as $yr)
                            <option value="{{ $yr }}" @selected($hijriYear === (string) $yr)>{{ $yr }} H</option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ route('admin.idul-adha.index', ['hijri_year' => $hijriYear]) }}"
                    class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-xs">
                <p class="font-semibold">Periksa kembali isian:</p>
                <ul class="mt-1.5 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Tambah Kelompok Sapi Baru --}}
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-0.5">
                <h3 class="text-base font-bold text-gray-900">Tambah Kelompok Sapi Baru</h3>
                <p class="text-xs text-gray-500">Buat kelompok ekor sapi baru untuk periode {{ $hijriYear }} H, lalu tambahkan peserta di bawah.</p>
            </div>

            <form action="{{ route('admin.idul-adha.kelompok-sapi.store') }}" method="POST"
                class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-12 sm:items-end">
                @csrf
                <input type="hidden" name="hijri_year" value="{{ $hijriYear }}">

                <div class="sm:col-span-4">
                    <label for="group_name" class="block text-xs font-semibold text-gray-700">
                        Nama Kelompok <span class="text-red-500">*</span>
                    </label>
                    <input id="group_name" type="text" name="group_name" value="{{ old('group_name') }}" required
                        placeholder="Contoh: Sapi #1"
                        class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div class="sm:col-span-5">
                    <label for="group_notes" class="block text-xs font-semibold text-gray-700">
                        Catatan (Opsional)
                    </label>
                    <input id="group_notes" type="text" name="notes" value="{{ old('notes') }}"
                        placeholder="Misal: Patungan warga RT 02"
                        class="mt-1.5 w-full rounded-xl border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-xs focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                </div>

                <div class="sm:col-span-3">
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-1.5 rounded-xl bg-[#c49c4d] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b08a3e]">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Kelompok
                    </button>
                </div>
            </form>
        </div>

        {{-- Peserta Qurban Sapi Belum Masuk Kelompok --}}
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm space-y-3">
            <div class="flex items-center justify-between gap-2">
                <h3 class="text-sm font-bold text-gray-900">
                    Peserta Qurban Sapi Belum Masuk Kelompok
                </h3>
                <span class="rounded-lg bg-amber-50 px-2.5 py-1 text-xs font-semibold text-[#9c7832] border border-amber-200/80">
                    {{ $availableCowQurbans->count() }} Orang Tersedia
                </span>
            </div>

            @if ($availableCowQurbans->isNotEmpty())
                <div class="flex flex-wrap gap-2 pt-1">
                    @foreach ($availableCowQurbans as $cowQurban)
                        <span class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-gray-50 px-3 py-1.5 text-xs text-gray-700">
                            <span class="font-semibold text-gray-900">{{ $cowQurban->person_name }}</span>
                            @if ($cowQurban->address)
                                <span class="text-gray-400">• {{ $cowQurban->address }}</span>
                            @endif
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-gray-400">
                    Semua data qurban sapi pada periode {{ $hijriYear }} H sudah masuk kelompok atau belum ada data sapi.
                </p>
            @endif
        </div>

        {{-- Daftar Card Kelompok Sapi --}}
        @if ($cowGroups->isNotEmpty())
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                @foreach ($cowGroups as $group)
                    @php
                        $memberCount = $group->members->count();
                        $isFull = $memberCount >= $maxMembers;
                        $quotaPercent = min(100, (int) round(($memberCount / max(1, $maxMembers)) * 100));
                    @endphp
                    <div class="flex flex-col justify-between space-y-5 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                        <div class="space-y-4">
                            {{-- Header Card Kelompok --}}
                            <div class="flex items-start justify-between gap-3 border-b border-gray-100 pb-4">
                                <div class="space-y-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="text-lg font-bold text-gray-900">{{ $group->group_name }}</h4>
                                        <span class="inline-flex rounded-lg px-2.5 py-0.5 text-xs font-semibold {{ $isFull ? 'bg-emerald-100 text-emerald-800' : 'bg-[#c49c4d]/15 text-[#9c7832]' }}">
                                            {{ $memberCount }} / {{ $maxMembers }} Orang
                                        </span>
                                    </div>
                                    @if ($group->notes)
                                        <p class="text-xs text-gray-500">{{ $group->notes }}</p>
                                    @endif
                                </div>

                                <form action="{{ route('admin.idul-adha.kelompok-sapi.destroy', $group->id) }}" method="POST"
                                    class="swal-confirm-form shrink-0"
                                    data-swal-title="Hapus {{ $group->group_name }}?"
                                    data-swal-text="Kelompok akan dihapus dan anggotanya akan kembali ke daftar belum terkelompok.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 rounded-lg border border-red-200 bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>

                            {{-- Indikator Kuota --}}
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-100">
                                <div class="h-full rounded-full transition-all {{ $isFull ? 'bg-emerald-500' : 'bg-[#c49c4d]' }}"
                                    style="width: {{ $quotaPercent }}%"></div>
                            </div>

                            {{-- Daftar Anggota --}}
                            <div class="space-y-2">
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-gray-400">Anggota Kelompok</p>
                                @if ($group->members->isNotEmpty())
                                    <ul class="divide-y divide-gray-100 overflow-hidden rounded-xl border border-gray-100 bg-gray-50/60">
                                        @foreach ($group->members as $member)
                                            <li class="flex items-center justify-between gap-3 px-3.5 py-2.5 text-sm hover:bg-gray-50">
                                                <div class="min-w-0">
                                                    <span class="font-semibold text-gray-900">
                                                        {{ $loop->iteration }}. {{ $member->qurban?->person_name ?? '-' }}
                                                    </span>
                                                    @if ($member->qurban?->address)
                                                        <span class="ml-1 text-xs text-gray-400">• {{ $member->qurban->address }}</span>
                                                    @endif
                                                </div>

                                                <form action="{{ route('admin.idul-adha.kelompok-sapi.members.destroy', [$group->id, $member->id]) }}" method="POST"
                                                    class="swal-confirm-form shrink-0"
                                                    data-swal-title="Keluarkan peserta?"
                                                    data-swal-text="{{ $member->qurban?->person_name ?? 'Peserta' }} akan dikeluarkan dari {{ $group->group_name }}.">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="rounded-lg px-2.5 py-1 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                                                        Keluarkan
                                                    </button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="rounded-xl border border-dashed border-gray-200 py-5 text-center text-xs text-gray-400">
                                        Belum ada peserta di kelompok ini.
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Form Tambah Anggota --}}
                        <div class="border-t border-gray-100 pt-4">
                            @if ($isFull)
                                <p class="rounded-xl bg-emerald-50 py-2.5 text-center text-xs font-semibold text-emerald-700">
                                    Kelompok sudah penuh ({{ $maxMembers }}/{{ $maxMembers }} orang).
                                </p>
                            @elseif ($availableCowQurbans->isEmpty())
                                <p class="py-2 text-center text-xs text-gray-400">
                                    Tidak ada peserta sapi tersedia untuk ditambahkan.
                                </p>
                            @else
                                <form action="{{ route('admin.idul-adha.kelompok-sapi.members.store', $group->id) }}" method="POST"
                                    class="flex flex-col gap-2 sm:flex-row">
                                    @csrf
                                    <select name="idul_adha_qurban_id" required
                                        class="flex-1 rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-[#c49c4d] focus:outline-none focus:ring-1 focus:ring-[#c49c4d]">
                                        <option value="">— Pilih peserta qurban sapi —</option>
                                        @foreach ($availableCowQurbans as $cowQurban)
                                            <option value="{{ $cowQurban->id }}">
                                                {{ $cowQurban->person_name }}{{ $cowQurban->address ? ' — ' . $cowQurban->address : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit"
                                        class="inline-flex shrink-0 items-center justify-center rounded-xl bg-[#c49c4d] px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#b08a3e]">
                                        + Masukkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-xl border border-gray-100 bg-white p-10 text-center text-sm text-gray-400 shadow-sm">
                Belum ada kelompok sapi untuk tahun {{ $hijriYear }} H. Buat kelompok baru di form di atas.
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMsg = @json(session('success'));
            const errorMsg = @json(session('error'));

            if (typeof Swal !== 'undefined') {
                if (successMsg) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: successMsg,
                        confirmButtonColor: '#c49c4d'
                    });
                }

                if (errorMsg) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Perhatian',
                        text: errorMsg,
                        confirmButtonColor: '#c49c4d'
                    });
                }

                document.querySelectorAll('form.swal-confirm-form').forEach(function (form) {
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: form.dataset.swalTitle || 'Konfirmasi',
                            text: form.dataset.swalText || 'Apakah Anda yakin ingin melanjutkan?',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Lanjutkan',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#c49c4d'
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            } else {
                if (successMsg) {
                    alert(successMsg);
                }
                if (errorMsg) {
                    alert(errorMsg);
                }
                document.querySelectorAll('form.swal-confirm-form').forEach(function (form) {
                    form.addEventListener('submit', function (e) {
                        const message = (form.dataset.swalTitle ? form.dataset.swalTitle + '\n' : '') +
                            (form.dataset.swalText || 'Apakah Anda yakin ingin melanjutkan?');
                        if (!confirm(message)) {
                            e.preventDefault();
                        }
                    });
                });
            }
        });
    </script>
</x-layouts.admin>
