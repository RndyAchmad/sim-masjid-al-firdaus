<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news_and_announcements', function (Blueprint $table) {
            $table->id();

            // Informasi berita
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');

            // Status dan informasi publikasi
            $table->string('status')->default('published');
            $table->string('author');
            $table->date('published_at')->nullable();

            // Gambar sampul
            $table->string('thumbnail');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_and_announcements');
    }
};
