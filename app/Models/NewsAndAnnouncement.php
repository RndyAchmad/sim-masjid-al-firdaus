<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'excerpt',
    'content',
    'status',
    'author',
    'published_at',
    'thumbnail',
])]
class NewsAndAnnouncement extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'status' => PublicationStatus::class,
        ];
    }
}
