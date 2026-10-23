<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PublicationStatus;
use App\Http\Controllers\Controller;
use App\Models\NewsAndAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $berita = NewsAndAnnouncement::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'excerpt' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
                'content' => [
                    'required',
                    'string',
                    'max:100000',
                ],
                'status' => [
                    'required',
                    Rule::enum(PublicationStatus::class),
                ],
                'author' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'published_at' => [
                    Rule::requiredIf(
                        $request->input('status') === PublicationStatus::Published->value
                    ),
                    'nullable',
                    'date_format:Y-m-d',
                ],
                'thumbnail' => [
                    'nullable',
                    'file',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ],
            [
                'title.required' => 'Judul berita wajib diisi.',
                'title.string' => 'Judul berita harus berupa teks.',
                'title.max' => 'Judul berita maksimal 255 karakter.',

                'excerpt.string' => 'Ringkasan berita harus berupa teks.',
                'excerpt.max' => 'Ringkasan berita maksimal 1.000 karakter.',

                'content.required' => 'Isi berita wajib diisi.',
                'content.string' => 'Isi berita harus berupa teks.',
                'content.max' => 'Isi berita terlalu panjang.',

                'status.required' => 'Status berita wajib dipilih.',
                'status.enum' => 'Status berita tidak valid.',

                'author.required' => 'Nama penulis wajib diisi.',
                'author.string' => 'Nama penulis harus berupa teks.',
                'author.max' => 'Nama penulis maksimal 255 karakter.',

                'published_at.required' => 'Tanggal publikasi wajib diisi jika berita diterbitkan.',
                'published_at.date_format' => 'Format tanggal publikasi tidak valid.',

                'thumbnail.file' => 'Thumbnail yang diunggah tidak valid.',
                'thumbnail.image' => 'Thumbnail harus berupa gambar.',
                'thumbnail.mimes' => 'Thumbnail harus berformat JPG, JPEG, PNG, atau WEBP.',
                'thumbnail.max' => 'Ukuran thumbnail maksimal 2 MB.',
            ]
        );

        $thumbnail = null;

        try {
            // Simpan thumbnail ke disk public jika ada.
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')
                    ->store('berita', 'public');

                if ($thumbnail === false) {
                    throw new \RuntimeException('Gagal menyimpan thumbnail.');
                }
            }

            // Buat slug unik untuk menghindari duplikasi.
            $baseSlug = Str::slug($validated['title']);

            if ($baseSlug === '') {
                throw ValidationException::withMessages([
                    'title' => 'Judul berita tidak dapat dijadikan slug. Gunakan judul yang valid.',
                ]);
            }

            $slug = $baseSlug;
            $counter = 1;

            while (NewsAndAnnouncement::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            NewsAndAnnouncement::create([
                'title' => $validated['title'],
                'slug' => $slug,
                'excerpt' => $validated['excerpt'] ?? null,
                'content' => $validated['content'],
                'status' => $validated['status'],
                'author' => $validated['author'],
                'published_at' => $validated['published_at'] ?? null,
                'thumbnail' => $thumbnail,
            ]);

        } catch (ValidationException $e) {
            // Hapus file jika sudah terunggah sebelum validasi lanjutan gagal.
            if ($thumbnail) {
                Storage::disk('public')->delete($thumbnail);
            }

            throw $e;
        } catch (\Throwable $e) {
            // Jangan biarkan file yatim jika penyimpanan berita gagal.
            if ($thumbnail) {
                Storage::disk('public')->delete($thumbnail);
            }

            report($e);

            return back()
                ->withInput($request->except(['thumbnail', 'password']))
                ->with('error', 'Berita gagal disimpan. Silakan coba kembali.');
        }

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil disimpan.');
    }


    public function edit($id)
    {
        $berita = NewsAndAnnouncement::findOrFail($id);

        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = NewsAndAnnouncement::findOrFail($id);

        $validated = $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'excerpt' => ['nullable', 'string', 'max:1000'],
                'content' => ['required', 'string', 'max:100000'],
                'status' => ['required', Rule::enum(PublicationStatus::class)],
                'author' => ['required', 'string', 'max:255'],
                'published_at' => [
                    Rule::requiredIf(
                        $request->input('status') === PublicationStatus::Published->value
                    ),
                    'nullable',
                    'date_format:Y-m-d',
                ],
                'thumbnail' => [
                    'nullable',
                    'file',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ],
            [
                'title.required' => 'Judul berita wajib diisi.',
                'title.string' => 'Judul berita harus berupa teks.',
                'title.max' => 'Judul berita maksimal 255 karakter.',
                'excerpt.string' => 'Ringkasan berita harus berupa teks.',
                'excerpt.max' => 'Ringkasan berita maksimal 1.000 karakter.',
                'content.required' => 'Isi berita wajib diisi.',
                'content.string' => 'Isi berita harus berupa teks.',
                'content.max' => 'Isi berita terlalu panjang.',
                'status.required' => 'Status berita wajib dipilih.',
                'status.enum' => 'Status berita tidak valid.',
                'author.required' => 'Nama penulis wajib diisi.',
                'author.string' => 'Nama penulis harus berupa teks.',
                'author.max' => 'Nama penulis maksimal 255 karakter.',
                'published_at.required' => 'Tanggal publikasi wajib diisi jika berita diterbitkan.',
                'published_at.date_format' => 'Format tanggal publikasi tidak valid.',
                'thumbnail.image' => 'Thumbnail harus berupa gambar.',
                'thumbnail.mimes' => 'Thumbnail harus berformat JPG, JPEG, PNG, atau WEBP.',
                'thumbnail.max' => 'Ukuran thumbnail maksimal 2 MB.',
            ]
        );

        $baseSlug = Str::slug($validated['title']);

        if ($baseSlug === '') {
            throw ValidationException::withMessages([
                'title' => 'Judul berita tidak dapat dijadikan slug. Gunakan judul yang valid.',
            ]);
        }

        // Buat slug unik tanpa mengubah slug jika masih sama.
        $slug = $baseSlug;
        $counter = 1;

        while (
            NewsAndAnnouncement::where('slug', $slug)
                ->where('id', '!=', $berita->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $oldThumbnail = $berita->thumbnail;
        $newThumbnail = null;

        try {
            if ($request->hasFile('thumbnail')) {
                $newThumbnail = $request->file('thumbnail')
                    ->store('berita', 'public');

                if ($newThumbnail === false) {
                    throw new \RuntimeException('Gagal menyimpan thumbnail.');
                }
            }

            $berita->update([
                'title' => $validated['title'],
                'slug' => $slug,
                'excerpt' => $validated['excerpt'] ?? null,
                'content' => $validated['content'],
                'status' => $validated['status'],
                'author' => $validated['author'],
                'published_at' => $validated['published_at'] ?? null,
                'thumbnail' => $newThumbnail ?? $oldThumbnail,
            ]);
        } catch (\Throwable $e) {
            // Hapus file baru jika proses update gagal.
            if ($newThumbnail) {
                Storage::disk('public')->delete($newThumbnail);
            }

            report($e);

            return back()
                ->withInput($request->except(['thumbnail', 'password']))
                ->with('error', 'Berita gagal diperbarui. Silakan coba kembali.');
        }

        // Hapus thumbnail lama hanya setelah update database berhasil.
        if ($newThumbnail && $oldThumbnail) {
            Storage::disk('public')->delete($oldThumbnail);
        }

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function show($id)
    {
        $berita = NewsAndAnnouncement::findOrFail($id);

        return view('admin.berita.show', compact('berita'));
    }

    public function destroy($id)
    {
        $berita = NewsAndAnnouncement::findOrFail($id);

        try {
            // Simpan lokasi thumbnail sebelum data dihapus.
            $thumbnail = $berita->thumbnail;

            // Hapus data berita dari database.
            $berita->delete();

            // Hapus thumbnail jika file tersedia.
            if ($thumbnail && Storage::disk('public')->exists($thumbnail)) {
                Storage::disk('public')->delete($thumbnail);
            }

            return redirect()
                ->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus.');

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Berita gagal dihapus. Silakan coba kembali.');
        }
    }
}
