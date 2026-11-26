<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - {{ $namaBulan }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1f2937;
            margin: 24px;
        }
        .header {
            border-bottom: 2px solid #c49c4d;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .header h1 {
            margin: 0;
            font-size: 17px;
            color: #111827;
        }
        .header p {
            margin: 4px 0 0;
            font-size: 11px;
            color: #6b7280;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .summary-table td {
            border: 1px solid #e5e7eb;
            padding: 8px 10px;
            vertical-align: top;
        }
        .summary-label {
            font-size: 9px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: bold;
        }
        .summary-value {
            font-size: 13px;
            font-weight: bold;
            margin-top: 4px;
        }
        .text-emerald { color: #059669; }
        .text-rose { color: #e11d48; }
        .text-right { text-align: right; }
        .book-table {
            width: 100%;
            border-collapse: collapse;
        }
        .book-table th {
            background-color: #f9fafb;
            color: #4b5563;
            font-size: 9px;
            text-transform: uppercase;
            border: 1px solid #d1d5db;
            padding: 8px 10px;
            text-align: left;
        }
        .book-table td {
            border: 1px solid #e5e7eb;
            padding: 7px 10px;
        }
        .row-opening {
            background-color: #fffbeb;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #6b7280;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KEUANGAN MASJID AL-FIRDAUS</h1>
        <p>Periode: <strong>{{ $namaBulan }}</strong>
            @if ($search !== '')
                &middot; Filter Keterangan: <strong>"{{ $search }}"</strong>
            @endif
        </p>
    </div>

    <table class="summary-table">
        <tr>
            <td width="25%">
                <div class="summary-label">Saldo Kas Keseluruhan</div>
                <div class="summary-value">Rp {{ number_format($saldoKas, 0, ',', '.') }}</div>
            </td>
            <td width="25%">
                <div class="summary-label">Saldo Awal Periode</div>
                <div class="summary-value">Rp {{ number_format($saldoAwalPeriode, 0, ',', '.') }}</div>
            </td>
            <td width="25%">
                <div class="summary-label">Pemasukan {{ $namaBulan }}</div>
                <div class="summary-value text-emerald">+ Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</div>
            </td>
            <td width="25%">
                <div class="summary-label">Pengeluaran {{ $namaBulan }}</div>
                <div class="summary-value text-rose">- Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div class="summary-label">
                    {{ $periodeBelumBerjalan
                        ? 'Perkiraan Saldo Awal Periode'
                        : ($bulan === now()->format('Y-m') ? 'Saldo hingga Saat Ini' : 'Saldo Akhir Periode') }}
                </div>
                <div class="summary-value {{ $saldoAkhirPeriode < 0 ? 'text-rose' : '' }}">
                    Rp {{ number_format($saldoAkhirPeriode, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    <table class="book-table">
        <thead>
            <tr>
                <th width="16%">Tanggal</th>
                <th width="44%">Keterangan</th>
                <th width="16%">Kategori</th>
                <th width="24%" class="text-right">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @if (!$periodeBelumBerjalan)
                <tr class="row-opening">
                    <td colspan="3">Saldo Awal Periode (Sebelum {{ $namaBulan }})</td>
                    <td class="text-right">Rp {{ number_format($saldoAwalPeriode, 0, ',', '.') }}</td>
                </tr>
            @endif

            @forelse ($laporanKeuangan as $laporan)
                @php
                    $jenis = $laporan->type instanceof \App\Enums\TransactionType
                        ? $laporan->type
                        : \App\Enums\TransactionType::tryFrom($laporan->type);
                    $pemasukan = $jenis === \App\Enums\TransactionType::INCOME;
                @endphp
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::parse($laporan->transaction_date)->format('d-m-Y') }}</td>
                    <td>{{ $laporan->description }}</td>
                    <td>{{ $jenis?->label() ?? ucfirst((string) $laporan->type) }}</td>
                    <td class="text-right {{ $pemasukan ? 'text-emerald' : 'text-rose' }}">
                        {{ $pemasukan ? '+' : '-' }} Rp {{ number_format($laporan->amount, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 16px; color: #6b7280;">
                        Tidak ada transaksi tercatat pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->locale('id')->translatedFormat('d F Y H:i') }} WIB
    </div>
</body>
</html>
