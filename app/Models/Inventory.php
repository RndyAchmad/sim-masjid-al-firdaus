<?php

namespace App\Models;

use App\Enums\InventoryCondition;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'code',
    'quantity',
    'unit',
    'condition',
    'description',
    'image',
])]
class Inventory extends Model
{
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'condition' => InventoryCondition::class,
        ];
    }
}
