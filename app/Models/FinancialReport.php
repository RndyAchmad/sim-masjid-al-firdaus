<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'type',
    'transaction_date',
    'amount',
    'description',
    'proof_file',
])]
class FinancialReport extends Model
{
    protected function casts(): array
    {
        return [
            'type' => TransactionType::class,
            'transaction_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }
}
