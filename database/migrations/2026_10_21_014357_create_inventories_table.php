<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            // Informasi barang
            $table->string('name');
            $table->string('code')->nullable()->unique();

            // Jumlah dan kondisi barang
            $table->unsignedInteger('quantity')->default(0);
            $table->string('unit')->default('Unit');
            $table->string('condition')->default('Baik');

            // Keterangan dan foto
            $table->text('description');
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
