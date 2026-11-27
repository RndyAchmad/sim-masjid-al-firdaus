<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZakatRegistration;
use App\Models\ZakatTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ZakatController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $date = trim((string) $request->query('date', ''));

        $availableHijriYears = ZakatRegistration::query()
            ->whereNotNull('hijri_year')
            ->where('hijri_year', '!=', '')
            ->distinct()
            ->pluck('hijri_year')
            ->sortByDesc(fn ($year) => (int) $year)
            ->values();

        // Ambil tahun Hijriah tertinggi yang ada di database, fallback ke '1448' jika tabel masih kosong
        $latestHijriYear = (string) ($availableHijriYears->first() ?? '1448');

        $hijriYear = $request->has('hijri_year')
            ? trim((string) $request->query('hijri_year'))
            : $latestHijriYear;

        if ($hijriYear === '') {
            $hijriYear = $latestHijriYear;
        }

        $baseQuery = ZakatRegistration::query()
            ->when($hijriYear !== 'all', function ($query) use ($hijriYear) {
                $query->where('hijri_year', $hijriYear);
            })
            ->when($search !== '', function ($query) use ($search) {
                $like = "%{$search}%";
                $query->where(function ($q) use ($like) {
                    $q->where('head_of_family', 'like', $like)
                        ->orWhere('address', 'like', $like)
                        ->orWhere('hijri_year', 'like', $like)
                        ->orWhereHas('transactions', function ($t) use ($like) {
                            $t->where('person_name', 'like', $like);
                        });
                });
            })
            ->when($date !== '', function ($query) use ($date) {
                $query->whereDate('received_date', $date);
            });

        $registrations = (clone $baseQuery)
            ->with('transactions')
            ->orderByDesc('received_date')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $registrationIds = (clone $baseQuery)->select('id');

        $trxStats = ZakatTransaction::query()
            ->whereIn('zakat_registration_id', $registrationIds)
            ->selectRaw('
                COUNT(*) as total_souls,
                COALESCE(SUM(fitrah_rice_kg), 0) as total_fitrah_rice_kg,
                COALESCE(SUM(mal_cash_amount), 0) as total_mal_cash_amount,
                COALESCE(SUM(infaq_cash_amount), 0) as total_infaq_cash_amount
            ')
            ->first();

        $summary = [
            'total_fitrah_rice_kg' => (float) ($trxStats->total_fitrah_rice_kg ?? 0),
            'total_registrations' => (int) (clone $baseQuery)->count(),
            'total_souls' => (int) ($trxStats->total_souls ?? 0),
            'total_mal_cash_amount' => (int) ($trxStats->total_mal_cash_amount ?? 0),
            'total_infaq_cash_amount' => (int) ($trxStats->total_infaq_cash_amount ?? 0),
        ];

        return view('admin.zakat.index', compact(
            'registrations',
            'summary',
            'search',
            'date',
            'hijriYear',
            'availableHijriYears',
            'latestHijriYear'
        ));
    }

    public function create(): View
    {
        $availableHijriYears = ZakatRegistration::query()
            ->whereNotNull('hijri_year')
            ->where('hijri_year', '!=', '')
            ->distinct()
            ->orderByDesc('hijri_year')
            ->pluck('hijri_year');

        $latestHijriYear = (string) ($availableHijriYears->first() ?? '1448');

        $previousNames = ZakatTransaction::query()
            ->whereNotNull('person_name')
            ->where('person_name', '!=', '')
            ->distinct()
            ->orderBy('person_name')
            ->pluck('person_name');

        $previousHeads = ZakatRegistration::query()
            ->whereNotNull('head_of_family')
            ->where('head_of_family', '!=', '')
            ->orderByDesc('received_date')
            ->orderByDesc('id')
            ->get(['head_of_family', 'address'])
            ->unique(fn ($item) => mb_strtolower(trim($item->head_of_family)))
            ->values()
            ->map(fn ($item) => [
                'name' => trim($item->head_of_family),
                'address' => $item->address ? trim($item->address) : '',
            ]);

        return view('admin.zakat.create', compact(
            'latestHijriYear',
            'availableHijriYears',
            'previousNames',
            'previousHeads'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateZakatRequest($request);

        try {
            $rowsToInsert = $this->extractTransactionRows($validated['items']);

            $hijriYear = trim((string) ($validated['hijri_year'] ?? ''));
            if ($hijriYear === '') {
                $hijriYear = (string) (ZakatRegistration::query()
                    ->whereNotNull('hijri_year')
                    ->where('hijri_year', '!=', '')
                    ->orderByDesc('hijri_year')
                    ->value('hijri_year') ?? '1448');
            }

            DB::transaction(function () use ($validated, $rowsToInsert, $hijriYear) {
                $registration = ZakatRegistration::create([
                    'head_of_family' => trim($validated['kepala_keluarga']),
                    'address' => isset($validated['alamat']) && trim($validated['alamat']) !== ''
                        ? trim($validated['alamat'])
                        : null,
                    'received_date' => $validated['tanggal'],
                    'hijri_year' => $hijriYear,
                ]);

                $registration->transactions()->createMany($rowsToInsert);
            });

            return redirect()
                ->route('admin.zakat.index', ['hijri_year' => $hijriYear])
                ->with('success', 'Data pencatatan zakat berhasil disimpan.');
        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data zakat: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data zakat. Silakan coba lagi.');
        }
    }

    public function show(int|string $id): View
    {
        $registration = ZakatRegistration::query()
            ->with('transactions')
            ->findOrFail($id);

        return view('admin.zakat.show', compact('registration'));
    }

    public function edit(int|string $id): View
    {
        $registration = ZakatRegistration::query()
            ->with('transactions')
            ->findOrFail($id);

        return view('admin.zakat.edit', compact('registration'));
    }

    public function update(Request $request, int|string $id): RedirectResponse
    {
        $registration = ZakatRegistration::query()->findOrFail($id);
        $validated = $this->validateZakatRequest($request);

        try {
            $rowsToInsert = $this->extractTransactionRows($validated['items']);
            $hijriYear = trim((string) ($validated['hijri_year'] ?? ($registration->hijri_year ?: '1448')));

            DB::transaction(function () use ($validated, $registration, $rowsToInsert, $hijriYear) {
                $registration->update([
                    'head_of_family' => trim($validated['kepala_keluarga']),
                    'address' => isset($validated['alamat']) && trim($validated['alamat']) !== ''
                        ? trim($validated['alamat'])
                        : null,
                    'received_date' => $validated['tanggal'],
                    'hijri_year' => $hijriYear,
                ]);

                $registration->transactions()->delete();
                $registration->transactions()->createMany($rowsToInsert);
            });

            return redirect()
                ->route('admin.zakat.index', ['hijri_year' => $hijriYear])
                ->with('success', 'Data pencatatan zakat berhasil diperbarui.');
        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data zakat: ' . $e->getMessage(), [
                'registration_id' => $registration->id,
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data zakat.');
        }
    }

    public function destroy(int|string $id): RedirectResponse
    {
        $registration = ZakatRegistration::query()->findOrFail($id);
        $hijriYear = $registration->hijri_year;

        try {
            DB::transaction(function () use ($registration) {
                $registration->delete();
            });

            return redirect()
                ->route('admin.zakat.index', $hijriYear ? ['hijri_year' => $hijriYear] : [])
                ->with('success', 'Data zakat berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data zakat: ' . $e->getMessage(), [
                'registration_id' => $registration->id,
                'exception' => $e,
            ]);

            return back()
                ->with('error', 'Terjadi kesalahan saat menghapus data zakat.');
        }
    }

    private function validateZakatRequest(Request $request): array
    {
        return $request->validate(
            [
                'kepala_keluarga' => ['required', 'string', 'max:255'],
                'alamat' => ['nullable', 'string', 'max:255'],
                'tanggal' => ['required', 'date'],
                'items' => ['required', 'array', 'min:1'],
                'items.*.nama' => ['required', 'string', 'max:255'],
                'items.*.fitrah_kg' => ['nullable', 'numeric', 'min:2.5', 'max:9999.99'],
                'items.*.mal_rp' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
                'items.*.infaq_rp' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
                'hijri_year' => ['required', 'regex:/^[0-9]{4}$/'],
            ],
            [
                'kepala_keluarga.required' => 'Nama kepala keluarga / pendaftar wajib diisi.',
                'tanggal.required' => 'Tanggal penerimaan wajib diisi.',
                'tanggal.date' => 'Format tanggal tidak valid.',
                'items.required' => 'Minimal harus ada 1 baris rincian jiwa / orang.',
                'items.min' => 'Minimal harus ada 1 baris rincian jiwa / orang.',
                'items.*.nama.required' => 'Nama pada setiap baris rincian wajib diisi.',
                'items.*.fitrah_kg.numeric' => 'Zakat fitrah harus berupa angka (Kg).',
                'items.*.fitrah_kg.min' => 'Zakat fitrah minimal 2.5 Kg.',
                'items.*.mal_rp.numeric' => 'Nominal zakat mal harus berupa angka.',
                'items.*.mal_rp.min' => 'Nominal zakat mal tidak boleh kurang dari 0.',
                'items.*.infaq_rp.numeric' => 'Nominal infaq harus berupa angka.',
                'items.*.infaq_rp.min' => 'Nominal infaq tidak boleh kurang dari 0.',
                'hijri_year.required' => 'Tahun Hijriah wajib diisi.',
                'hijri_year.regex' => 'Tahun Hijriah harus berupa 4 digit angka (contoh: 1448).',
            ]
        );
    }

    private function extractTransactionRows(array $items): array
    {
        $rows = collect($items)
            ->map(function (array $item) {
                return [
                    'person_name' => trim($item['nama']),
                    'fitrah_rice_kg' => round((float) ($item['fitrah_kg'] ?? 0), 2),
                    'mal_cash_amount' => (int) round((float) ($item['mal_rp'] ?? 0)),
                    'infaq_cash_amount' => (int) round((float) ($item['infaq_rp'] ?? 0)),
                ];
            })
            ->filter(function (array $row) {
                return $row['person_name'] !== ''
                    && (
                        $row['fitrah_rice_kg'] > 0
                        || $row['mal_cash_amount'] > 0
                        || $row['infaq_cash_amount'] > 0
                    );
            })
            ->values()
            ->all();

        if (empty($rows)) {
            throw new \RuntimeException('Minimal satu orang harus memiliki nilai fitrah (Kg), zakat mal (Rp), atau infaq (Rp) lebih dari 0.');
        }

        return $rows;
    }
}
