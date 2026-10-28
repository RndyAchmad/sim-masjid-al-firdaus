<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'development_project_id',
    'type',
    'donor_or_source',
    'transaction_date',
    'amount',
    'purpose',
    'proof_file',
])]
class DevelopmentTransaction extends Model
{
    protected function casts(): array
    {
        return [
            'type' => TransactionType::class,
            'transaction_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(DevelopmentProject::class, 'development_project_id');
    }
}
