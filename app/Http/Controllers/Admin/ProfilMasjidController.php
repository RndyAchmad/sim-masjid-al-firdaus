<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MosqueProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilMasjidController extends Controller
{
    public function index()
    {
        $profile = MosqueProfile::first();

        return view('admin.profil-masjid.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = MosqueProfile::first() ?? new MosqueProfile();

        // Rapikan spasi sebelum validasi.
        if (is_string($request->input('description'))) {
            $request->merge([
                'description' => trim($request->input('description')),
            ]);
        }

        if (is_string($request->input('vision'))) {
            $request->merge([
                'vision' => trim($request->input('vision')),
            ]);
        }

        if (is_string($request->input('address'))) {
            $request->merge([
                'address' => trim($request->input('address')),
            ]);
        }

        if (is_string($request->input('contact_number'))) {
            $request->merge([
                'contact_number' => trim($request->input('contact_number')),
            ]);
        }

        // Poin kosong harus gagal validasi, bukan diabaikan.
        $missions = $request->input('mission');

        if (is_array($missions)) {
            $request->merge([
                'mission' => array_map(
                    fn($mission) => is_string($mission)
                        ? trim($mission)
                        : $mission,
                    $missions
                ),
            ]);
        }

        $validated = $request->validate([
            'description' => ['required', 'string', 'max:10000'],
            'images' => [
                $profile->images ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
            'vision' => ['required', 'string', 'max:5000'],
            'mission' => ['required', 'array', 'min:1'],
            'mission.*' => ['required', 'string', 'max:500'],
            'structure' => [
                $profile->structure ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
            'address' => ['required', 'string', 'max:1000'],
            'contact_number' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:25'],
        ], [
            'description.required' => 'Tentang masjid wajib diisi.',
            'images.required' => 'Gambar masjid wajib diunggah.',
            'images.image' => 'File gambar masjid harus berupa gambar.',
            'images.mimes' => 'Gambar masjid harus berformat JPG, JPEG, atau PNG.',
            'images.max' => 'Ukuran gambar masjid maksimal 2 MB.',

            'vision.required' => 'Visi masjid wajib diisi.',
            'mission.required' => 'Minimal satu poin misi wajib diisi.',
            'mission.min' => 'Minimal satu poin misi wajib diisi.',
            'mission.*.required' => 'Setiap poin misi wajib diisi.',
            'mission.*.max' => 'Setiap poin misi maksimal 500 karakter.',

            'structure.required' => 'Gambar struktur organisasi wajib diunggah.',
            'structure.image' => 'Struktur organisasi harus berupa gambar.',
            'structure.mimes' => 'Struktur organisasi harus berformat JPG, JPEG, atau PNG.',
            'structure.max' => 'Ukuran gambar struktur organisasi maksimal 2 MB.',

            'address.required' => 'Alamat masjid wajib diisi.',
            'contact_number.required' => 'Nomor kontak wajib diisi.',
        ]);

        // Simpan gambar masjid jika ada file baru.
        foreach (['images', 'structure'] as $field) {
            if ($request->hasFile($field)) {
                $oldPath = $profile->{$field};

                $newPath = $request->file($field)
                    ->store('mosque-profile', 'public');

                $validated[$field] = $newPath;

                // Hapus file lama setelah file baru berhasil disimpan.
                if ($oldPath && $newPath && $oldPath !== $newPath) {
                    Storage::disk('public')->delete($oldPath);
                }
            } else {
                // Pertahankan gambar yang sudah tersimpan.
                unset($validated[$field]);
            }
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil masjid berhasil diperbarui.');
    }
}
