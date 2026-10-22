<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Enums\ActivityScheduleType;
use App\Enums\ScheduleDay;
use App\Models\ActivitySchedule;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Halaman daftar kegiatan publik.
     */
    public function index()
    {
        // Event sekali jalan yang tanggalnya hari ini atau setelahnya.
        $events = ActivitySchedule::query()
            ->where('schedule_type', ActivityScheduleType::Once->value)
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // Kegiatan rutin mingguan dan dua mingguan.
        $kegiatanRutin = ActivitySchedule::query()
            ->whereIn('schedule_type', [
                ActivityScheduleType::Weekly->value,
                ActivityScheduleType::Biweekly->value,
            ])
            ->orderByRaw("
                CASE day_of_week
                    WHEN 'monday' THEN 1
                    WHEN 'tuesday' THEN 2
                    WHEN 'wednesday' THEN 3
                    WHEN 'thursday' THEN 4
                    WHEN 'friday' THEN 5
                    WHEN 'saturday' THEN 6
                    WHEN 'sunday' THEN 7
                    ELSE 8
                END
            ")
            ->orderBy('time')
            ->get();

        return view('guest.kegiatan.index', compact(
            'events',
            'kegiatanRutin'
        ));
    }

    /**
     * Halaman detail kegiatan berdasarkan slug.
     */
    public function show(string $slug)
    {
        $kegiatan = ActivitySchedule::query()
            ->where('slug', $slug)
            ->firstOrFail();

        // Rekomendasi kegiatan lain yang berbeda dari kegiatan saat ini.
        $kegiatanLainnya = ActivitySchedule::query()
            ->where('id', '!=', $kegiatan->id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('schedule_type', ActivityScheduleType::Once->value)
                        ->whereDate('date', '>=', now()->toDateString());
                })->orWhereIn('schedule_type', [
                            ActivityScheduleType::Weekly->value,
                            ActivityScheduleType::Biweekly->value,
                        ]);
            })
            ->orderByRaw("
                CASE
                    WHEN schedule_type = 'once' THEN 0
                    ELSE 1
                END
            ")
            ->orderBy('date')
            ->orderBy('time')
            ->limit(2)
            ->get();

        return view('guest.kegiatan.show', compact(
            'kegiatan',
            'kegiatanLainnya'
        ));
    }
}
