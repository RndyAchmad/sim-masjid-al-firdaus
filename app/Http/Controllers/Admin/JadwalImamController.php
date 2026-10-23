<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FridaySchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalImamController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'bulan' => ['nullable', 'date_format:Y-m'],
        ]);

        $bulan = $request->input('bulan', now()->format('Y-m'));

        $jadwalImam = FridaySchedule::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('imam', 'like', "%{$search}%")
                        ->orWhere('muadzin', 'like', "%{$search}%")
                        ->orWhere('khatib', 'like', "%{$search}%");
                });
            })
            ->when($bulan, function ($query) use ($bulan) {
                $tanggal = \Carbon\Carbon::createFromFormat('Y-m', $bulan);

                $query->whereYear('date', $tanggal->year)
                    ->whereMonth('date', $tanggal->month);
            })
            ->orderBy('date')
            ->paginate(10)
            ->withQueryString();

        return view('admin.jadwal-imam.index', compact('jadwalImam', 'bulan'));
    }

    public function show($id)
    {
        return view('admin.jadwal-imam.show', compact('id'));
    }

    public function create()
    {
        return view('admin.jadwal-imam.create');
    }

    public function store(Request $request)
    {
        // / Simpan data baru ke database
    }

    public function edit($id)
    {
        return view('admin.jadwal-imam.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update data berdasarkan ID
    }

    public function destroy($id)
    {
        // Hapus data dari database berdasarkan ID
    }



    public function exportToExcel(Request $request)
    {
        // Validasi input rentang bulan dan tahun.
        $validated = $request->validate([
            'bulan_awal' => ['required', 'integer', 'between:1,12'],
            'tahun_awal' => ['required', 'integer', 'between:2000,2100'],
            'bulan_akhir' => ['required', 'integer', 'between:1,12'],
            'tahun_akhir' => ['required', 'integer', 'between:2000,2100'],
        ]);

        $tanggalAwal = Carbon::create(
            (int) $validated['tahun_awal'],
            (int) $validated['bulan_awal'],
            1
        )->startOfMonth();

        $tanggalAkhir = Carbon::create(
            (int) $validated['tahun_akhir'],
            (int) $validated['bulan_akhir'],
            1
        )->endOfMonth();

        // Pastikan rentang tanggal valid.
        if ($tanggalAwal->greaterThan($tanggalAkhir)) {
            return back()->withErrors([
                'bulan_awal' => 'Bulan dan tahun awal tidak boleh melebihi bulan dan tahun akhir.',
            ]);
        }

        // Ambil hanya data dalam rentang yang diminta.
        $jadwalImam = FridaySchedule::query()
            ->whereBetween('date', [
                $tanggalAwal->toDateString(),
                $tanggalAkhir->toDateString(),
            ])
            ->orderBy('date')
            ->get(['date', 'imam', 'muadzin', 'khatib']);

        // Nama file dibentuk dari angka hasil validasi, bukan input bebas.
        $filename = sprintf(
            'jadwal-imam-%s-sampai-%s.csv',
            $tanggalAwal->format('Y-m'),
            $tanggalAkhir->format('Y-m')
        );

        return response()->streamDownload(
            function () use ($jadwalImam) {
                $file = fopen('php://output', 'w');

                if ($file === false) {
                    throw new \RuntimeException('Gagal membuat file ekspor.');
                }

                try {
                    // BOM agar UTF-8 terbaca dengan baik di Excel.
                    fwrite($file, "\xEF\xBB\xBF");

                    // Mencegah formula injection pada data teks.
                    $safeCsvValue = static function ($value): string {
                        $value = (string) ($value ?? '');

                        if (preg_match('/^[\x00-\x20]*[=+\-@]/', $value)) {
                            return "'" . $value;
                        }

                        return $value;
                    };

                    fputcsv($file, [
                        'Tanggal Jumat',
                        'Imam Sholat',
                        'Muadzin',
                    ], ';', '"', '');

                    foreach ($jadwalImam as $item) {
                        fputcsv($file, [
                            $item->date?->format('d-m-Y'),
                            $safeCsvValue($item->imam),
                            $safeCsvValue($item->muadzin),
                            $safeCsvValue($item->khatib),
                        ], ';', '"', '');
                    }
                } finally {
                    fclose($file);
                }
            },
            $filename,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'X-Content-Type-Options' => 'nosniff',
                'Cache-Control' => 'private, no-store, max-age=0',
            ]
        );
    }


    public function importFromExcel(Request $request)
    {
        // Logic to import data from Excel
    }
}