<?php

namespace App\Enums;

enum InventoryCondition: string
{
    case GOOD = 'Baik';
    case DAMAGED = 'Rusak';
    case MISSING = 'Hilang';
    case REPAIR = 'Repair';

    public function label(): string
    {
        return $this->value;
    }
}
