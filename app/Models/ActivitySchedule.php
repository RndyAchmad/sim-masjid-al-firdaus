<?php

namespace App\Models;

use App\Enums\ActivityScheduleType;
use App\Enums\ScheduleDay;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'tipe',
    'speaker',
    'schedule_type',
    'day_of_week',
    'date',
    'time',
    'location',
    'description',
    'image_poster',
])]
class ActivitySchedule extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'schedule_type' => ActivityScheduleType::class,
            'day_of_week' => ScheduleDay::class,
            'date' => 'date',
        ];
    }
}
