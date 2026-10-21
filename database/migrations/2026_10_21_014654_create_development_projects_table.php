<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('development_projects', function (Blueprint $table) {
            $table->id();

            // Informasi proyek
            $table->string('name');
            $table->string('slug')->unique();

            // Target dan periode pembangunan
            $table->decimal('target_amount', 15, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Status proyek
            $table->string('status')->default('ongoing');

            // Deskripsi dan gambar proyek
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('development_projects');
    }
};
