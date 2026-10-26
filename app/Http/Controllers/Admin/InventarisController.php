<?php

namespace App\Http\Controllers\admin;

use App\Enums\InventoryCondition;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $condition = $request->input('condition', '');

        $conditions = InventoryCondition::cases();

        $validCondition = InventoryCondition::tryFrom($condition);

        $inventories = Inventory::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($validCondition !== null, function ($query) use ($validCondition) {
                $query->where('condition', $validCondition->value);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.inventaris.index', compact(
            'inventories',
            'search',
            'condition',
            'conditions'
        ));
    }

    public function create()
    {
        return view('admin.inventaris.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
            ],

            'condition' => [
                'required',
                Rule::enum(InventoryCondition::class),
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'name.required' => 'Nama barang wajib diisi.',
            'name.max' => 'Nama barang maksimal 255 karakter.',

            'quantity.required' => 'Jumlah barang wajib diisi.',
            'quantity.integer' => 'Jumlah barang harus berupa bilangan bulat.',
            'quantity.min' => 'Jumlah barang minimal 0.',

            'unit.required' => 'Satuan barang wajib diisi.',
            'unit.max' => 'Satuan barang maksimal 50 karakter.',

            'condition.required' => 'Kondisi barang wajib dipilih.',
            'condition.enum' => 'Kondisi barang tidak valid.',

            'description.max' => 'Keterangan maksimal 5000 karakter.',

            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $imagePath = null;

        try {
            // Simpan gambar jika pengguna mengunggahnya.
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')
                    ->store('inventaris', 'public');

                if ($imagePath === false) {
                    return back()
                        ->withInput($request->except('image'))
                        ->withErrors([
                            'image' => 'Foto gagal disimpan. Silakan coba kembali.',
                        ]);
                }
            }

            $prefix = 'INV-' . now('Asia/Jakarta')->format('ym');

            $validated['image'] = $imagePath;

            /*
             * Coba membuat kode sampai berhasil.
             * Jika terjadi benturan kode unik akibat penyimpanan bersamaan,
             * sistem akan mencoba membuat kode berikutnya.
             */
            $saved = false;

            for ($attempt = 0; $attempt < 5; $attempt++) {
                $lastCode = Inventory::query()
                    ->where('code', 'like', $prefix . '-%')
                    ->orderByDesc('code')
                    ->value('code');

                $lastNumber = 0;

                if (
                    $lastCode &&
                    preg_match('/^INV-\d{4}-(\d+)$/', $lastCode, $matches)
                ) {
                    $lastNumber = (int) $matches[1];
                }

                $validated['code'] = $prefix . '-'
                    . str_pad((string) ($lastNumber + 1), 3, '0', STR_PAD_LEFT);

                try {
                    Inventory::create($validated);

                    $saved = true;
                    break;
                } catch (QueryException $exception) {
                    // SQLSTATE 23000: pelanggaran constraint integritas,
                    // termasuk kemungkinan benturan kode UNIQUE.
                    $sqlState = $exception->errorInfo[0] ?? null;

                    if ($sqlState !== '23000' && $sqlState !== '23505') {
                        throw $exception;
                    }

                    // Jika masih ada percobaan, ambil kode berikutnya.
                    if ($attempt === 4) {
                        throw $exception;
                    }
                }
            }

            if (!$saved) {
                throw new \RuntimeException(
                    'Kode inventaris gagal dibuat setelah beberapa percobaan.'
                );
            }
        } catch (\Throwable $exception) {
            // Hapus foto jika penyimpanan data gagal.
            if ($imagePath !== null) {
                Storage::disk('public')->delete($imagePath);
            }

            report($exception);

            return back()
                ->withInput($request->except('image'))
                ->withErrors([
                    'general' => 'Barang gagal disimpan. Silakan coba kembali.',
                ]);
        }

        return redirect()
            ->route('admin.inventaris.index')
            ->with('success', 'Barang inventaris berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $inventory = Inventory::findOrFail($id);

        return view('admin.inventaris.show', compact('inventory'));
    }

    public function edit(string $id)
    {
        $inventory = Inventory::findOrFail($id);

        return view('admin.inventaris.edit', compact('inventory'));
    }

    public function update(Request $request, string $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
            ],

            'condition' => [
                'required',
                Rule::enum(InventoryCondition::class),
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'name.required' => 'Nama barang wajib diisi.',
            'name.max' => 'Nama barang maksimal 255 karakter.',

            'quantity.required' => 'Jumlah barang wajib diisi.',
            'quantity.integer' => 'Jumlah barang harus berupa bilangan bulat.',
            'quantity.min' => 'Jumlah barang minimal 0.',

            'unit.required' => 'Satuan barang wajib diisi.',
            'unit.max' => 'Satuan barang maksimal 50 karakter.',

            'condition.required' => 'Kondisi barang wajib dipilih.',
            'condition.enum' => 'Kondisi barang tidak valid.',

            'description.max' => 'Keterangan maksimal 5000 karakter.',

            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $oldImage = $inventory->image;
        $newImage = null;

        try {
            // Simpan foto baru jika pengguna mengunggahnya.
            if ($request->hasFile('image')) {
                $newImage = $request->file('image')
                    ->store('inventaris', 'public');

                if ($newImage === false) {
                    return back()
                        ->withInput($request->except('image'))
                        ->withErrors([
                            'image' => 'Foto gagal disimpan. Silakan coba kembali.',
                        ]);
                }
            }

            // Kode barang tidak diubah saat proses update.
            if ($newImage !== null) {
                $validated['image'] = $newImage;
            }

            $inventory->update($validated);

            // Hapus foto lama hanya setelah data berhasil diperbarui.
            if (
                $newImage !== null &&
                $oldImage &&
                $oldImage !== $newImage
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } catch (Throwable $exception) {
            // Hapus foto baru jika proses update gagal.
            if ($newImage !== null) {
                Storage::disk('public')->delete($newImage);
            }

            report($exception);

            return back()
                ->withInput($request->except('image'))
                ->withErrors([
                    'general' => 'Barang gagal diperbarui. Silakan coba kembali.',
                ]);
        }

        return redirect()
            ->route('admin.inventaris.index', $inventory->id)
            ->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $image = $inventory->image;

        try {
            $inventory->delete();

            // Hapus foto hanya jika data berhasil dihapus.
            if ($image) {
                Storage::disk('public')->delete($image);
            }
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('admin.inventaris.index')
                ->with('error', 'Barang gagal dihapus. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.inventaris.index')
            ->with('success', 'Barang inventaris berhasil dihapus.');
    }
}
