<?php

namespace App\Enums;

enum UserRole: string
{
    case Superadmin = 'superadmin';
    case Admin = 'admin';
    case Bendahara = 'bendahara';
    case Sekretaris = 'sekretaris';

    public function label(): string
    {
        return match ($this) {
            self::Superadmin => 'Superadmin',
            self::Admin => 'Admin',
            self::Bendahara => 'Bendahara',
            self::Sekretaris => 'Sekretaris',
        };
    }
}
