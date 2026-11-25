<?php

namespace App\Enums;

enum ProcurementType: string
{
    case Masjid = 'masjid';
    case SelfProcured = 'self_procured';

    public function label(): string
    {
        return match ($this) {
            self::Masjid => 'Lewat Masjid',
            self::SelfProcured => 'Pengadaan Sendiri',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Masjid => 'Nominal kesepakatan sudah termasuk uang sembelih & pemeliharaan',
            self::SelfProcured => 'Hewan diadakan sendiri, membayar uang penyembelihan & pemeliharaan',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Masjid => 'bg-blue-50 text-blue-700 border border-blue-200',
            self::SelfProcured => 'bg-amber-50 text-amber-800 border border-amber-200',
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
