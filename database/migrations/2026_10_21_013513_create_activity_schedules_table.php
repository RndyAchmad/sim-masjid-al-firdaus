<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_schedules', function (Blueprint $table) {
            $table->id();

            // Informasi kegiatan
            $table->string('name');
            $table->string('tipe');
            $table->string('speaker');

            // Pengulangan jadwal
            $table->string('schedule_type')
                ->comment('once, weekly, atau biweekly');

            $table->string('day_of_week')->nullable();
            $table->date('date')->nullable();

            // Waktu dan lokasi kegiatan
            $table->time('time');
            $table->string('location');
            $table->text('description');
            $table->string('image_poster');

            $table->timestamps();

            // Index untuk membantu pencarian jadwal
            $table->index('schedule_type');
            $table->index('day_of_week');
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_schedules');
    }
};
