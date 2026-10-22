<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActivityScheduleType;
use App\Enums\ScheduleDay;
use App\Http\Controllers\Controller;
use App\Models\ActivitySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));
        $tipe = $request->query('tipe', '');

        $query = ActivitySchedule::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('speaker', 'like', "%{$search}%");
            });
        }

        if ($tipe !== '') {
            $query->where('tipe', $tipe);
        }

        $kegiatans = $query
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $tipeKegiatan = ActivitySchedule::query()
            ->whereNotNull('tipe')
            ->where('tipe', '<>', '')
            ->distinct()
            ->orderBy('tipe')
            ->pluck('tipe');

        return view('admin.kegiatan.index', compact(
            'kegiatans',
            'tipeKegiatan',
            'search',
            'tipe'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'string', 'max:100'],
            'speaker' => ['nullable', 'string', 'max:255'],

            'schedule_type' => [
                'required',
                Rule::enum(ActivityScheduleType::class),
            ],

            'day_of_week' => [
                'nullable',
                'required_if:schedule_type,weekly,biweekly',
                Rule::enum(ScheduleDay::class),
            ],

            'date' => [
                'nullable',
                'required_if:schedule_type,once',
                'date',
            ],

            'time' => ['required', 'date_format:H:i'],
            'location' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],

            'image_poster' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'name.required' => 'Nama kegiatan wajib diisi.',
            'name.max' => 'Nama kegiatan maksimal 255 karakter.',

            'tipe.required' => 'Jenis kegiatan wajib diisi.',
            'tipe.max' => 'Jenis kegiatan maksimal 100 karakter.',

            'speaker.max' => 'Nama pemateri maksimal 255 karakter.',

            'schedule_type.required' => 'Pola jadwal wajib dipilih.',
            'schedule_type.in' => 'Pola jadwal yang dipilih tidak valid.',

            'day_of_week.required_if' => 'Hari kegiatan wajib dipilih untuk jadwal rutin.',
            'day_of_week.in' => 'Hari kegiatan yang dipilih tidak valid.',

            'date.required_if' => 'Tanggal kegiatan wajib diisi untuk jadwal sekali.',
            'date.date' => 'Tanggal kegiatan tidak valid.',

            'time.required' => 'Waktu kegiatan wajib diisi.',
            'time.date_format' => 'Format waktu kegiatan tidak valid.',

            'location.required' => 'Lokasi kegiatan wajib diisi.',
            'location.max' => 'Lokasi maksimal 255 karakter.',

            'excerpt.max' => 'Ringkasan kegiatan maksimal 1.000 karakter.',

            'image_poster.image' => 'File poster harus berupa gambar.',
            'image_poster.mimes' => 'Poster harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image_poster.max' => 'Ukuran poster maksimal 2 MB.',
        ], [
            'name' => 'nama kegiatan',
            'tipe' => 'jenis kegiatan',
            'speaker' => 'pemateri',
            'schedule_type' => 'pola jadwal',
            'day_of_week' => 'hari kegiatan',
            'date' => 'tanggal kegiatan',
            'time' => 'waktu kegiatan',
            'location' => 'lokasi',
            'excerpt' => 'ringkasan kegiatan',
            'description' => 'deskripsi',
            'image_poster' => 'poster kegiatan',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $baseSlug = $baseSlug ?: 'kegiatan';
        $slug = $baseSlug;
        $counter = 1;

        while (ActivitySchedule::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        if ($validated['schedule_type'] === 'once') {
            $validated['day_of_week'] = null;
        } else {
            $validated['date'] = null;
        }

        if ($request->hasFile('image_poster')) {
            $validated['image_poster'] = $request
                ->file('image_poster')
                ->store('activity-posters', 'public');
        }

        ActivitySchedule::create($validated);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.kegiatan.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.kegiatan.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
