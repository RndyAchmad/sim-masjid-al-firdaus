<?php

namespace App\Enums;

enum DevelopmentProjectStatus: string
{
    case PLANNED = 'planned';
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';
    case PAUSED = 'paused';

    public function label(): string
    {
        return match ($this) {
            self::PLANNED => 'Direncanakan',
            self::ONGOING => 'Berjalan',
            self::COMPLETED => 'Selesai',
            self::PAUSED => 'Ditunda',
        };
    }
}
