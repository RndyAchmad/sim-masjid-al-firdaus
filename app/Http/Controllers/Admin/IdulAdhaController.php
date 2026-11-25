<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AnimalType;
use App\Enums\ProcurementType;
use App\Http\Controllers\Controller;
use App\Models\IdulAdhaQurban;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class IdulAdhaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $date = trim((string) $request->query('date', ''));

        $availableHijriYears = IdulAdhaQurban::query()
            ->whereNotNull('hijri_year')
            ->where('hijri_year', '!=', '')
            ->distinct()
            ->pluck('hijri_year')
            ->sortByDesc(fn ($year) => (int) $year)
            ->values();

        $latestHijriYear = (string) ($availableHijriYears->first() ?? '1448');
        $hijriYear = $request->has('hijri_year')
            ? trim((string) $request->query('hijri_year'))
            : $latestHijriYear;

        if ($hijriYear === '') {
            $hijriYear = $latestHijriYear;
        }

        $baseQuery = IdulAdhaQurban::query()
            ->when($hijriYear !== 'all', function ($query) use ($hijriYear) {
                $query->where('hijri_year', $hijriYear);
            })
            ->when($search !== '', function ($query) use ($search) {
                $like = "%{$search}%";
                $query->where(function ($q) use ($like) {
                    $q->where('person_name', 'like', $like)
                        ->orWhere('phone', 'like', $like)
                        ->orWhere('address', 'like', $like)
                        ->orWhere('hijri_year', 'like', $like);
                });
            })
            ->when($date !== '', function ($query) use ($date) {
                $query->whereDate('received_date', $date);
            });

        $qurbans = (clone $baseQuery)
            ->orderByDesc('received_date')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $summary = [
            'sapi_count' => (clone $baseQuery)->where('animal_type', AnimalType::Sapi->value)->count(),
            'kambing_count' => (clone $baseQuery)->where('animal_type', AnimalType::Kambing->value)->count(),
            'self_procured_count' => (clone $baseQuery)->where('procurement_type', ProcurementType::SelfProcured->value)->count(),
            'total_infaq' => (int) (clone $baseQuery)->sum('infaq_amount'),
        ];

        return view('admin.idul-adha.index', compact(
            'qurbans',
            'summary',
            'search',
            'date',
            'hijriYear',
            'availableHijriYears',
            'latestHijriYear'
        ));
    }

    public function create(Request $request): View
    {
        $availableHijriYears = IdulAdhaQurban::query()
            ->whereNotNull('hijri_year')
            ->where('hijri_year', '!=', '')
            ->distinct()
            ->pluck('hijri_year')
            ->sortByDesc(fn ($year) => (int) $year)
            ->values();

        $latestHijriYear = (string) ($availableHijriYears->first() ?? '1448');
        $targetHijriYear = trim((string) $request->query('hijri_year', $latestHijriYear));

        if ($targetHijriYear === '' || $targetHijriYear === 'all') {
            $targetHijriYear = $latestHijriYear;
        }

        return view('admin.idul-adha.create', compact(
            'latestHijriYear',
            'targetHijriYear'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateQurbanRequest($request);

        try {
            $qurban = DB::transaction(function () use ($validated, $request) {
                $latestHijriYear = (string) (IdulAdhaQurban::query()
                    ->whereNotNull('hijri_year')
                    ->where('hijri_year', '!=', '')
                    ->orderByRaw('CAST(hijri_year AS UNSIGNED) DESC')
                    ->value('hijri_year') ?? '1448');

                $resolvedHijriYear = trim((string) ($validated['hijri_year'] ?? $request->query('hijri_year', '')));
                if ($resolvedHijriYear === '' || $resolvedHijriYear === 'all') {
                    $resolvedHijriYear = $latestHijriYear;
                }

                $payload = $this->normalizeQurbanPayload($validated, $resolvedHijriYear);

                if ($payload['animal_type'] === null && $payload['infaq_amount'] <= 0) {
                    throw new \RuntimeException('Pilih jenis hewan qurban atau isi nominal infaq lebih dari 0.');
                }

                return IdulAdhaQurban::create($payload);
            });

            return redirect()
                ->route('admin.idul-adha.index', ['hijri_year' => $qurban->hijri_year])
                ->with('success', 'Data pengqurban Idul Adha berhasil disimpan.');
        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data Idul Adha: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data Idul Adha. Silakan coba lagi.');
        }
    }

    public function show(IdulAdhaQurban $idul_adha): View
    {
        return view('admin.idul-adha.show', [
            'qurban' => $idul_adha,
        ]);
    }

    public function edit(IdulAdhaQurban $idul_adha): View
    {
        return view('admin.idul-adha.edit', [
            'qurban' => $idul_adha,
        ]);
    }

    public function update(Request $request, IdulAdhaQurban $idul_adha): RedirectResponse
    {
        $validated = $this->validateQurbanRequest($request);

        try {
            DB::transaction(function () use ($validated, $idul_adha) {
                $hijriYear = trim((string) ($validated['hijri_year'] ?? $idul_adha->hijri_year));
                if ($hijriYear === '') {
                    $hijriYear = (string) $idul_adha->hijri_year;
                }

                $payload = $this->normalizeQurbanPayload($validated, $hijriYear);

                if ($payload['animal_type'] === null && $payload['infaq_amount'] <= 0) {
                    throw new \RuntimeException('Pilih jenis hewan qurban atau isi nominal infaq lebih dari 0.');
                }

                $idul_adha->update($payload);
            });

            return redirect()
                ->route('admin.idul-adha.index', ['hijri_year' => $idul_adha->hijri_year])
                ->with('success', 'Data pengqurban Idul Adha berhasil diperbarui.');
        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui data Idul Adha: ' . $e->getMessage(), [
                'qurban_id' => $idul_adha->id,
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data Idul Adha.');
        }
    }

    public function destroy(IdulAdhaQurban $idul_adha): RedirectResponse
    {
        $hijriYear = $idul_adha->hijri_year;

        try {
            DB::transaction(function () use ($idul_adha) {
                $idul_adha->delete();
            });

            return redirect()
                ->route('admin.idul-adha.index', ['hijri_year' => $hijriYear])
                ->with('success', 'Data pengqurban Idul Adha berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data Idul Adha: ' . $e->getMessage(), [
                'qurban_id' => $idul_adha->id,
                'exception' => $e,
            ]);

            return back()
                ->with('error', 'Terjadi kesalahan saat menghapus data Idul Adha.');
        }
    }

    private function validateQurbanRequest(Request $request): array
    {
        return $request->validate(
            [
                'hijri_year' => ['nullable', 'regex:/^[0-9]{4}$/'],
                'received_date' => ['required', 'date'],
                'person_name' => ['required', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:30'],
                'address' => ['nullable', 'string', 'max:255'],
                'animal_type' => ['nullable', Rule::enum(AnimalType::class)],
                'procurement_type' => ['nullable', Rule::enum(ProcurementType::class)],
                'agreed_amount' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
                'slaughter_care_fee' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
                'infaq_amount' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
                'notes' => ['nullable', 'string'],
            ],
            [
                'hijri_year.regex' => 'Tahun Hijriah harus berupa 4 digit angka (contoh: 1448).',
                'received_date.required' => 'Tanggal penerimaan wajib diisi.',
                'received_date.date' => 'Format tanggal tidak valid.',
                'person_name.required' => 'Nama orang wajib diisi.',
                'infaq_amount.numeric' => 'Nominal infaq harus berupa angka.',
                'infaq_amount.min' => 'Nominal infaq tidak boleh kurang dari 0.',
                'agreed_amount.numeric' => 'Nominal kesepakatan harus berupa angka.',
                'slaughter_care_fee.numeric' => 'Biaya sembelih & pemeliharaan harus berupa angka.',
            ]
        );
    }

    private function normalizeQurbanPayload(array $validated, string $hijriYear): array
    {
        $animalType = null;
        if (!empty($validated['animal_type'])) {
            $animalType = $validated['animal_type'] instanceof AnimalType
                ? $validated['animal_type']->value
                : AnimalType::from($validated['animal_type'])->value;
        }

        $procurementType = null;
        if ($animalType !== null) {
            if (!empty($validated['procurement_type'])) {
                $procurementType = $validated['procurement_type'] instanceof ProcurementType
                    ? $validated['procurement_type']
                    : ProcurementType::from($validated['procurement_type']);
            } else {
                $procurementType = ProcurementType::Masjid;
            }
        }

        $isSelfProcured = $procurementType === ProcurementType::SelfProcured;

        return [
            'hijri_year' => $hijriYear,
            'received_date' => $validated['received_date'],
            'person_name' => trim($validated['person_name']),
            'phone' => isset($validated['phone']) && trim($validated['phone']) !== ''
                ? trim($validated['phone'])
                : null,
            'address' => isset($validated['address']) && trim($validated['address']) !== ''
                ? trim($validated['address'])
                : null,
            'animal_type' => $animalType,
            'procurement_type' => $procurementType?->value,
            'agreed_amount' => ($animalType !== null && !$isSelfProcured)
                ? (int) round((float) ($validated['agreed_amount'] ?? 0))
                : 0,
            'slaughter_care_fee' => ($animalType !== null && $isSelfProcured)
                ? (int) round((float) ($validated['slaughter_care_fee'] ?? 0))
                : 0,
            'infaq_amount' => (int) round((float) ($validated['infaq_amount'] ?? 0)),
            'notes' => isset($validated['notes']) && trim($validated['notes']) !== ''
                ? trim($validated['notes'])
                : null,
        ];
    }
}
