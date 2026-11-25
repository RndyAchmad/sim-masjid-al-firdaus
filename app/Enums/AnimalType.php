<?php

namespace App\Enums;

enum AnimalType: string
{
    case Sapi = 'sapi';
    case Kambing = 'kambing';

    public function label(): string
    {
        return match ($this) {
            self::Sapi => 'Sapi',
            self::Kambing => 'Kambing',
        };
    }

    public function maxParticipants(): ?int
    {
        return match ($this) {
            self::Sapi => 7,
            self::Kambing => 1,
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Sapi => 'bg-[#c49c4d]/15 text-[#9a752b] border border-[#c49c4d]/30',
            self::Kambing => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn (self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }
}
