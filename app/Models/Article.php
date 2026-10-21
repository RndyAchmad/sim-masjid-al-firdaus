<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'category',
    'excerpt',
    'content',
    'thumbnail',
    'status',
])]
class Article extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => PublicationStatus::class,
        ];
    }
}
