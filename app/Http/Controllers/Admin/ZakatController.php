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
        $date = $request->query('date');

        $registrations = ZakatRegistration::query()
            ->with('transactions')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('head_of_family', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhereHas('transactions', function ($t) use ($search) {
                            $t->where('person_name', 'like', "%{$search}%");
                        });
                });
            })
            ->when(!empty($date), function ($query) use ($date) {
                $query->whereDate('received_date', $date);
            })
            ->orderByDesc('received_date')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        $summary = [
            'total_fitrah_rice_kg' => (float) ZakatTransaction::query()->sum('fitrah_rice_kg'),
            'total_registrations' => (int) ZakatRegistration::query()->count(),
            'total_souls' => (int) ZakatTransaction::query()->count(),
            'total_mal_cash_amount' => (int) ZakatTransaction::query()->sum('mal_cash_amount'),
            'total_infaq_cash_amount' => (int) ZakatTransaction::query()->sum('infaq_cash_amount'),
        ];

        return view('admin.zakat.index', compact('registrations', 'summary', 'search', 'date'));
    }

    public function create(): View
    {
        return view('admin.zakat.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateZakatRequest($request);

        try {
            DB::transaction(function () use ($validated) {
                $registration = ZakatRegistration::create([
                    'head_of_family' => trim($validated['kepala_keluarga']),
                    'address' => isset($validated['alamat']) && trim($validated['alamat']) !== ''
                        ? trim($validated['alamat'])
                        : null,
                    'received_date' => $validated['tanggal'],
                ]);

                $rowsToInsert = $this->extractTransactionRows($validated['items']);

                $registration->transactions()->createMany($rowsToInsert);
            });

            return redirect()
                ->route('admin.zakat.index')
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
            DB::transaction(function () use ($validated, $registration) {
                $registration->update([
                    'head_of_family' => trim($validated['kepala_keluarga']),
                    'address' => isset($validated['alamat']) && trim($validated['alamat']) !== ''
                        ? trim($validated['alamat'])
                        : null,
                    'received_date' => $validated['tanggal'],
                ]);

                $rowsToInsert = $this->extractTransactionRows($validated['items']);

                $registration->transactions()->delete();
                $registration->transactions()->createMany($rowsToInsert);
            });

            return redirect()
                ->route('admin.zakat.index')
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

        try {
            DB::transaction(function () use ($registration) {
                $registration->delete();
            });

            return redirect()
                ->route('admin.zakat.index')
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
                'items.*.fitrah_kg' => ['nullable', 'numeric', 'min:0', 'max:9999.99'],
                'items.*.mal_rp' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
                'items.*.infaq_rp' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
            ],
            [
                'kepala_keluarga.required' => 'Nama kepala keluarga / pendaftar wajib diisi.',
                'tanggal.required' => 'Tanggal penerimaan wajib diisi.',
                'tanggal.date' => 'Format tanggal tidak valid.',
                'items.required' => 'Minimal harus ada 1 baris rincian jiwa / orang.',
                'items.min' => 'Minimal harus ada 1 baris rincian jiwa / orang.',
                'items.*.nama.required' => 'Nama pada setiap baris rincian wajib diisi.',
                'items.*.fitrah_kg.numeric' => 'Zakat fitrah harus berupa angka (Kg).',
                'items.*.fitrah_kg.min' => 'Zakat fitrah tidak boleh kurang dari 0.',
                'items.*.mal_rp.numeric' => 'Nominal zakat mal harus berupa angka.',
                'items.*.mal_rp.min' => 'Nominal zakat mal tidak boleh kurang dari 0.',
                'items.*.infaq_rp.numeric' => 'Nominal infaq harus berupa angka.',
                'items.*.infaq_rp.min' => 'Nominal infaq tidak boleh kurang dari 0.',
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
