<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Enums\PublicationStatus;
use App\Models\NewsAndAnnouncement;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita yang sudah diterbitkan.
     */
    public function index()
    {
        $berita = NewsAndAnnouncement::query()
            ->where('status', PublicationStatus::Published->value)
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now()->toDateString())
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('guest.berita.index', compact('berita'));
    }

    /**
     * Menampilkan detail berita berdasarkan slug.
     */
    public function show(string $slug)
    {
        $berita = NewsAndAnnouncement::query()
            ->where('slug', $slug)
            ->where('status', PublicationStatus::Published->value)
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now()->toDateString())
            ->firstOrFail();

        $beritaLainnya = NewsAndAnnouncement::query()
            ->where('status', PublicationStatus::Published->value)
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now()->toDateString())
            ->where('id', '!=', $berita->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(2)
            ->get();

        return view('guest.berita.show', compact(
            'berita',
            'beritaLainnya'
        ));
    }
}
