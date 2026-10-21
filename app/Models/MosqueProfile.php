<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'description',
    'images',
    'vision',
    'mission',
    'structure',
    'address',
    'contact_number',
])]
class MosqueProfile extends Model
{
    use HasFactory;

    /**
     * Konversi tipe data atribut secara otomatis.
     */
    protected function casts(): array
    {
        return [
            'mission' => 'array',
        ];
    }
}
