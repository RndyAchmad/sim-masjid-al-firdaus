<?php

namespace App\Enums;

enum ActivityScheduleType: string
{
    case Once = 'once';
    case Weekly = 'weekly';
    case Biweekly = 'biweekly';

    public function label(): string
    {
        return match ($this) {
            self::Once => 'Sekali',
            self::Weekly => 'Setiap Minggu',
            self::Biweekly => 'Setiap Dua Minggu',
        };
    }
}
