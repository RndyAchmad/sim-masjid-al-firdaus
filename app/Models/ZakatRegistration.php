<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZakatRegistration extends Model
{
    use HasFactory;

    protected $table = 'zakat_registrations';

    protected $fillable = [
        'head_of_family',
        'address',
        'received_date',
        'hijri_year',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'received_date' => 'date',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(ZakatTransaction::class, 'zakat_registration_id');
    }

    public function getTotalFitrahRiceKgAttribute(): float
    {
        return (float) $this->transactions->sum('fitrah_rice_kg');
    }

    public function getTotalMalCashAmountAttribute(): int
    {
        return (int) $this->transactions->sum('mal_cash_amount');
    }

    public function getTotalInfaqCashAmountAttribute(): int
    {
        return (int) $this->transactions->sum('infaq_cash_amount');
    }

    public function getTotalCashAmountAttribute(): int
    {
        return $this->total_mal_cash_amount + $this->total_infaq_cash_amount;
    }
}
