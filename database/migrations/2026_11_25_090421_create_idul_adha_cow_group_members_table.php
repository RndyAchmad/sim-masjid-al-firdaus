<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('idul_adha_cow_group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idul_adha_cow_group_id')
                ->constrained('idul_adha_cow_groups')
                ->cascadeOnDelete();
            $table->foreignId('idul_adha_qurban_id')
                ->constrained('idul_adha_qurbans')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique('idul_adha_qurban_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idul_adha_cow_group_members');
    }
};
