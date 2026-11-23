<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZakatTransaction extends Model
{
    use HasFactory;

    protected $table = 'zakat_transactions';

    protected $fillable = [
        'zakat_registration_id',
        'person_name',
        'fitrah_rice_kg',
        'mal_cash_amount',
        'infaq_cash_amount',
    ];

    protected function casts(): array
    {
        return [
            'fitrah_rice_kg' => 'decimal:2',
            'mal_cash_amount' => 'integer',
            'infaq_cash_amount' => 'integer',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(ZakatRegistration::class, 'zakat_registration_id');
    }

    public function getTotalCashAmountAttribute(): int
    {
        return (int) $this->mal_cash_amount + (int) $this->infaq_cash_amount;
    }
}
