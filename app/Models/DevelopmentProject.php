<?php

namespace App\Models;

use App\Enums\DevelopmentProjectStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'target_amount',
    'start_date',
    'end_date',
    'completed_at',
    'status',
    'description',
    'image',
])]
class DevelopmentProject extends Model
{
    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
            'completed_at' => 'datetime',
            'status' => DevelopmentProjectStatus::class,
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(DevelopmentTransaction::class);
    }
}
