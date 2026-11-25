<?php

namespace App\Models;

use App\Enums\AnimalType;
use App\Enums\ProcurementType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IdulAdhaQurban extends Model
{
    use HasFactory;

    protected $table = 'idul_adha_qurbans';

    protected $fillable = [
        'hijri_year',
        'received_date',
        'person_name',
        'phone',
        'address',
        'animal_type',
        'procurement_type',
        'agreed_amount',
        'slaughter_care_fee',
        'infaq_amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'received_date' => 'date',
            'animal_type' => AnimalType::class,
            'procurement_type' => ProcurementType::class,
            'agreed_amount' => 'integer',
            'slaughter_care_fee' => 'integer',
            'infaq_amount' => 'integer',
        ];
    }

    public function cowGroupMember(): HasOne
    {
        return $this->hasOne(IdulAdhaCowGroupMember::class, 'idul_adha_qurban_id');
    }

    public function cowGroupMembers(): HasMany
    {
        return $this->hasMany(IdulAdhaCowGroupMember::class, 'idul_adha_qurban_id');
    }

    public function getEffectiveAmountAttribute(): int
    {
        if ($this->procurement_type === ProcurementType::SelfProcured) {
            return (int) $this->slaughter_care_fee;
        }

        return (int) $this->agreed_amount;
    }

    public function getTotalPaymentAttribute(): int
    {
        return $this->effective_amount + (int) $this->infaq_amount;
    }
}
