<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('friday_schedules', function (Blueprint $table) {
            $table->id();

            // Tanggal pelaksanaan salat Jumat
            $table->date('date')->unique();

            // Petugas salat Jumat
            $table->string('imam');
            $table->string('muadzin')->nullable();
            $table->string('khatib')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('friday_schedules');
    }
};
