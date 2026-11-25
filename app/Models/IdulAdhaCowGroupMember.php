<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdulAdhaCowGroupMember extends Model
{
    use HasFactory;

    protected $table = 'idul_adha_cow_group_members';

    protected $fillable = [
        'idul_adha_cow_group_id',
        'idul_adha_qurban_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(IdulAdhaCowGroup::class, 'idul_adha_cow_group_id');
    }

    public function qurban(): BelongsTo
    {
        return $this->belongsTo(IdulAdhaQurban::class, 'idul_adha_qurban_id');
    }

    public function getMemberNameAttribute(): ?string
    {
        return $this->qurban?->person_name;
    }
}
