<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DevelopmentProjectStatus;
use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Models\DevelopmentProject;
use App\Models\DevelopmentTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class PembangunanController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'bulan' => ['nullable', 'date_format:Y-m'],
            'search' => ['nullable', 'string', 'max:100'],
            'jenis' => ['nullable', Rule::enum(TransactionType::class)],
            'proyek' => [
                'nullable',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if ($value === 'umum') {
                        return;
                    }

                    if (
                        filter_var($value, FILTER_VALIDATE_INT) === false
                        || (int) $value < 1
                        || !DevelopmentProject::query()->whereKey($value)->exists()
                    ) {
                        $fail('Filter proyek yang dipilih tidak valid.');
                    }
                },
            ],
        ]);

        $bulan = $validated['bulan'] ?? now()->format('Y-m');
        $search = trim($validated['search'] ?? '');
        $jenis = $validated['jenis'] ?? '';
        $proyekId = $validated['proyek'] ?? '';
        $tanggalBulan = Carbon::createFromFormat('!Y-m', $bulan);
        $tanggalAwal = $tanggalBulan->copy()->startOfMonth()->toDateString();
        $tanggalAkhir = $tanggalBulan->copy()->endOfMonth()->toDateString();
        $namaBulan = $tanggalBulan->copy()->locale('id')->translatedFormat('F Y');

        // Satu catatan transaksi selalu dihitung sekali, baik transaksi umum
        // maupun transaksi yang terhubung ke sebuah proyek.
        $ringkasanKas = DevelopmentTransaction::query()
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pemasukan, '
                . 'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pengeluaran',
                [TransactionType::INCOME->value, TransactionType::EXPENSE->value]
            )
            ->first();

        $ringkasanBulan = DevelopmentTransaction::query()
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir])
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pemasukan, '
                . 'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pengeluaran',
                [TransactionType::INCOME->value, TransactionType::EXPENSE->value]
            )
            ->first();

        $totalPemasukan = (float) ($ringkasanKas->total_pemasukan ?? 0);
        $totalPengeluaran = (float) ($ringkasanKas->total_pengeluaran ?? 0);
        $saldoKas = $totalPemasukan - $totalPengeluaran;
        $pemasukanBulanIni = (float) ($ringkasanBulan->total_pemasukan ?? 0);
        $pengeluaranBulanIni = (float) ($ringkasanBulan->total_pengeluaran ?? 0);

        $proyekPembangunan = DevelopmentProject::query()
            ->withSum([
                'transactions as total_pemasukan' => fn($query) => $query
                    ->where('type', TransactionType::INCOME->value),
            ], 'amount')
            ->withSum([
                'transactions as total_pengeluaran' => fn($query) => $query
                    ->where('type', TransactionType::EXPENSE->value),
            ], 'amount')
            ->orderByDesc('created_at')
            ->get();

        $query = DevelopmentTransaction::query()
            ->with('project:id,name')
            ->whereBetween('transaction_date', [$tanggalAwal, $tanggalAkhir]);

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('donor_or_source', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhereHas('project', fn($projectQuery) => $projectQuery
                        ->where('name', 'like', "%{$search}%"));
            });
        }

        if ($jenis !== '') {
            $query->where('type', $jenis);
        }

        if ($proyekId === 'umum') {
            $query->whereNull('development_project_id');
        } elseif ($proyekId !== '') {
            $query->where('development_project_id', $proyekId);
        }

        $transaksiPembangunan = $query
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pembangunan.index', compact(
            'saldoKas',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'proyekPembangunan',
            'transaksiPembangunan',
            'bulan',
            'search',
            'jenis',
            'proyekId',
            'namaBulan'
        ));
    }

    public function createTransaction()
    {
        $proyekPembangunan = DevelopmentProject::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.pembangunan.create', compact('proyekPembangunan'));
    }

    public function storeTransaction(Request $request)
    {
        $validated = $request->validate($this->transactionRules(), $this->transactionMessages());
        $proofFile = null;

        try {
            if ($request->hasFile('proof_file')) {
                $proofFile = $request->file('proof_file')
                    ->store('development-transactions', 'public');

                if (!is_string($proofFile)) {
                    throw new \RuntimeException('Bukti transaksi gagal disimpan.');
                }
            }

            DB::transaction(function () use ($validated, $proofFile): void {
                DevelopmentTransaction::create([
                    ...$this->transactionAttributes($validated),
                    'proof_file' => $proofFile,
                ]);
            });
        } catch (Throwable $exception) {
            if ($proofFile !== null) {
                Storage::disk('public')->delete($proofFile);
            }

            report($exception);

            return back()
                ->withInput($request->except('proof_file'))
                ->with('error', 'Transaksi gagal disimpan. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.pembangunan.index')
            ->with('success', 'Transaksi kas pembangunan berhasil dicatat.');
    }

    public function showTransaction(DevelopmentTransaction $transaction)
    {
        $transaction->load('project:id,name');

        return view('admin.pembangunan.show', compact('transaction'));
    }

    public function editTransaction(DevelopmentTransaction $transaction)
    {
        $proyekPembangunan = DevelopmentProject::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.pembangunan.edit', compact('transaction', 'proyekPembangunan'));
    }

    public function updateTransaction(Request $request, DevelopmentTransaction $transaction)
    {
        $validated = $request->validate($this->transactionRules(), $this->transactionMessages());
        $oldProofFile = $transaction->proof_file;
        $newProofFile = null;

        try {
            if ($request->hasFile('proof_file')) {
                $newProofFile = $request->file('proof_file')
                    ->store('development-transactions', 'public');

                if (!is_string($newProofFile)) {
                    throw new \RuntimeException('Bukti transaksi gagal disimpan.');
                }
            }

            DB::transaction(function () use ($transaction, $validated, $newProofFile): void {
                $attributes = $this->transactionAttributes($validated);

                if ($newProofFile !== null) {
                    $attributes['proof_file'] = $newProofFile;
                }

                $transaction->update($attributes);
            });

            if ($newProofFile !== null && $oldProofFile !== $newProofFile) {
                Storage::disk('public')->delete($oldProofFile);
            }
        } catch (Throwable $exception) {
            if ($newProofFile !== null) {
                Storage::disk('public')->delete($newProofFile);
            }

            report($exception);

            return back()
                ->withInput($request->except('proof_file'))
                ->with('error', 'Transaksi gagal diperbarui. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.pembangunan.transactions.show', $transaction)
            ->with('success', 'Transaksi kas pembangunan berhasil diperbarui.');
    }

    public function destroyTransaction(DevelopmentTransaction $transaction)
    {
        $proofFile = $transaction->proof_file;

        try {
            DB::transaction(fn() => $transaction->delete());

            if ($proofFile !== null) {
                Storage::disk('public')->delete($proofFile);
            }
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('admin.pembangunan.index')
                ->with('error', 'Transaksi gagal dihapus. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.pembangunan.index')
            ->with('success', 'Transaksi kas pembangunan berhasil dihapus.');
    }

    public function createProject()
    {
        $statusProyek = DevelopmentProjectStatus::cases();

        return view('admin.pembangunan.projects.create', compact('statusProyek'));
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate($this->projectRules(), $this->projectMessages());
        $image = null;

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('development-projects', 'public');

                if (!is_string($image)) {
                    throw new \RuntimeException('Gambar proyek gagal disimpan.');
                }
            }

            DB::transaction(function () use ($validated, $image): void {
                DevelopmentProject::create([
                    ...$this->projectAttributes($validated),
                    'slug' => $this->uniqueProjectSlug($validated['name']),
                    'image' => $image,
                ]);
            });
        } catch (Throwable $exception) {
            if ($image !== null) {
                Storage::disk('public')->delete($image);
            }

            report($exception);

            return back()
                ->withInput($request->except('image'))
                ->with('error', 'Proyek gagal disimpan. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.pembangunan.index')
            ->with('success', 'Proyek pembangunan berhasil dibuat.');
    }

    public function showProject(DevelopmentProject $project)
    {
        $ringkasan = $project->transactions()
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pemasukan, '
                . 'COALESCE(SUM(CASE WHEN type = ? THEN amount ELSE 0 END), 0) as total_pengeluaran',
                [TransactionType::INCOME->value, TransactionType::EXPENSE->value]
            )
            ->first();

        $totalPemasukan = (float) ($ringkasan->total_pemasukan ?? 0);
        $totalPengeluaran = (float) ($ringkasan->total_pengeluaran ?? 0);
        $transaksi = $project->transactions()
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.pembangunan.projects.show', compact(
            'project',
            'transaksi',
            'totalPemasukan',
            'totalPengeluaran'
        ));
    }

    public function editProject(Request $request, DevelopmentProject $project)
    {
        $validated = $request->validate([
            'search_transaksi' => ['nullable', 'string', 'max:100'],
            'jenis_transaksi' => [
                'nullable',
                Rule::in(['income', 'expense']),
            ],
        ]);

        $searchTransaction = trim($validated['search_transaksi'] ?? '');
        $jenisTransaksi = $validated['jenis_transaksi'] ?? '';

        $statusProyek = DevelopmentProjectStatus::cases();

        // Ambil transaksi yang masih menjadi kas umum.
        // Pemasukan dan pengeluaran sama-sama ditampilkan.
        $unlinkedTransactions = DevelopmentTransaction::query()
            ->whereNull('development_project_id')
            ->when($jenisTransaksi !== '', function ($query) use ($jenisTransaksi) {
                $query->where('type', $jenisTransaksi);
            })
            ->when($searchTransaction !== '', function ($query) use ($searchTransaction) {
                $query->where(function ($subQuery) use ($searchTransaction) {
                    $subQuery
                        ->where('donor_or_source', 'like', "%{$searchTransaction}%")
                        ->orWhere('purpose', 'like', "%{$searchTransaction}%");
                });
            })
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->limit(100)
            ->get();

        return view('admin.pembangunan.projects.edit', compact(
            'project',
            'statusProyek',
            'unlinkedTransactions',
            'searchTransaction',
            'jenisTransaksi'
        ));
    }

    public function updateProject(Request $request, DevelopmentProject $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'target_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::enum(DevelopmentProjectStatus::class)],
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            // Transaksi pemasukan dan/atau pengeluaran yang akan
            // dihubungkan ke proyek ini.
            'transaction_ids' => ['nullable', 'array'],
            'transaction_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('development_transactions', 'id')
                    ->whereNull('development_project_id'),
            ],
        ]);

        $transactionIds = collect($validated['transaction_ids'] ?? [])
            ->unique()
            ->values()
            ->all();

        $imageBaru = null;
        $imageLama = $project->image;

        try {
            DB::beginTransaction();

            // Simpan gambar baru jika ada.
            if ($request->hasFile('image')) {
                $imageBaru = $request->file('image')
                    ->store('development-projects', 'public');

                $validated['image'] = $imageBaru;
            }

            // Perbarui data proyek.
            $project->update([
                'name' => $validated['name'],
                'slug' => \Illuminate\Support\Str::slug($validated['name']),
                'target_amount' => $validated['target_amount'],
                'status' => $validated['status'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'description' => $validated['description'] ?? null,
                'image' => $imageBaru ?? $imageLama,
            ]);

            // Hubungkan transaksi yang dipilih dengan proyek.
            // Berlaku untuk pemasukan maupun pengeluaran.
            // Tidak membuat transaksi baru sehingga saldo tidak berubah.
            $transaksiTerhubung = 0;

            if (!empty($transactionIds)) {
                $transaksiTerhubung = DevelopmentTransaction::query()
                    ->whereNull('development_project_id')
                    ->whereIn('id', $transactionIds)
                    ->update([
                        'development_project_id' => $project->id,
                    ]);
            }

            DB::commit();

            // Hapus gambar lama hanya setelah perubahan berhasil.
            if ($imageBaru && $imageLama) {
                Storage::disk('public')->delete($imageLama);
            }

            return redirect()
                ->route('admin.pembangunan.projects.show', $project)
                ->with(
                    'success',
                    'Proyek berhasil diperbarui. '
                    . $transaksiTerhubung
                    . ' transaksi pemasukan/pengeluaran berhasil dihubungkan.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            // Hapus gambar baru jika proses gagal.
            if ($imageBaru) {
                Storage::disk('public')->delete($imageBaru);
            }

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Proyek gagal diperbarui. Silakan coba kembali.');
        }
    }

    public function destroyProject(DevelopmentProject $project)
    {
        $image = $project->image;

        try {
            // Foreign key development_project_id menggunakan nullOnDelete(),
            // sehingga riwayat transaksi tetap tersimpan sebagai kas umum.
            DB::transaction(fn() => $project->delete());

            if ($image !== null) {
                Storage::disk('public')->delete($image);
            }
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('admin.pembangunan.projects.show', $project)
                ->with('error', 'Proyek gagal dihapus. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.pembangunan.index')
            ->with('success', 'Proyek dihapus. Riwayat transaksinya tetap tersimpan sebagai kas pembangunan umum.');
    }

    /** @return array<string, array<int, mixed>> */
    private function transactionRules(): array
    {
        return [
            'development_project_id' => ['nullable', 'integer', Rule::exists('development_projects', 'id')],
            'type' => ['required', Rule::enum(TransactionType::class)],
            'donor_or_source' => ['required', 'string', 'max:255'],
            'transaction_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:1', 'max:999999999999.99'],
            'purpose' => ['required', 'string', 'max:1000'],
            'proof_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }

    /** @return array<string, string> */
    private function transactionMessages(): array
    {
        return [
            'development_project_id.exists' => 'Proyek pembangunan yang dipilih tidak ditemukan.',
            'type.required' => 'Jenis transaksi wajib dipilih.',
            'type.enum' => 'Jenis transaksi harus berupa pemasukan atau pengeluaran.',
            'donor_or_source.required' => 'Donatur atau sumber dana wajib diisi.',
            'donor_or_source.max' => 'Donatur atau sumber dana maksimal 255 karakter.',
            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'transaction_date.date' => 'Tanggal transaksi tidak valid.',
            'amount.required' => 'Nominal transaksi wajib diisi.',
            'amount.numeric' => 'Nominal harus berupa angka.',
            'amount.min' => 'Nominal transaksi minimal Rp1.',
            'amount.max' => 'Nominal transaksi terlalu besar.',
            'purpose.required' => 'Peruntukan transaksi wajib diisi.',
            'purpose.max' => 'Peruntukan transaksi maksimal 1000 karakter.',
            'proof_file.file' => 'Bukti transaksi harus berupa file.',
            'proof_file.mimes' => 'Bukti transaksi harus berupa JPG, JPEG, PNG, atau PDF.',
            'proof_file.max' => 'Ukuran bukti transaksi maksimal 2 MB.',
        ];
    }

    /** @param array<string, mixed> $validated */
    private function transactionAttributes(array $validated): array
    {
        return [
            'development_project_id' => $validated['development_project_id'] ?? null,
            'type' => $validated['type'],
            'donor_or_source' => $validated['donor_or_source'],
            'transaction_date' => $validated['transaction_date'],
            'amount' => $validated['amount'],
            'purpose' => $validated['purpose'],
        ];
    }

    /** @return array<string, array<int, mixed>> */
    private function projectRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'target_amount' => ['nullable', 'numeric', 'min:1', 'max:999999999999.99'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', Rule::enum(DevelopmentProjectStatus::class)],
            'description' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /** @return array<string, string> */
    private function projectMessages(): array
    {
        return [
            'name.required' => 'Nama proyek wajib diisi.',
            'name.max' => 'Nama proyek maksimal 255 karakter.',
            'target_amount.numeric' => 'Target anggaran harus berupa angka.',
            'target_amount.min' => 'Target anggaran minimal Rp1.',
            'target_amount.max' => 'Target anggaran terlalu besar.',
            'start_date.date' => 'Tanggal mulai tidak valid.',
            'end_date.date' => 'Target selesai tidak valid.',
            'end_date.after_or_equal' => 'Target selesai harus sama dengan atau setelah tanggal mulai.',
            'status.required' => 'Status proyek wajib dipilih.',
            'status.enum' => 'Status proyek tidak valid.',
            'description.max' => 'Deskripsi proyek maksimal 5000 karakter.',
            'image.image' => 'Gambar proyek harus berupa gambar.',
            'image.mimes' => 'Gambar proyek harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar proyek maksimal 2 MB.',
        ];
    }

    /** @param array<string, mixed> $validated */
    private function projectAttributes(array $validated): array
    {
        return [
            'name' => $validated['name'],
            'target_amount' => $validated['target_amount'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
        ];
    }

    private function uniqueProjectSlug(string $name, ?int $exceptProjectId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'proyek-pembangunan';
        $slug = $baseSlug;
        $counter = 2;

        while (
            DevelopmentProject::query()
                ->where('slug', $slug)
                ->when($exceptProjectId !== null, fn($query) => $query
                    ->whereKeyNot($exceptProjectId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
