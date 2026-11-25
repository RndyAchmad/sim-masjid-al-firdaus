<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IdulAdhaCowGroup extends Model
{
    use HasFactory;

    public const MAX_MEMBERS = 7;

    protected $table = 'idul_adha_cow_groups';

    protected $fillable = [
        'hijri_year',
        'group_name',
        'notes',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(IdulAdhaCowGroupMember::class, 'idul_adha_cow_group_id');
    }

    public function isFull(): bool
    {
        return $this->members()->count() >= self::MAX_MEMBERS;
    }
}
