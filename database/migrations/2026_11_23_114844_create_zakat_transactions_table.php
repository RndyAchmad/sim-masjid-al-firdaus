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
        Schema::create('zakat_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zakat_registration_id')
                ->constrained('zakat_registrations')
                ->cascadeOnDelete();
            $table->string('person_name');
            $table->decimal('fitrah_rice_kg', 8, 2)->default(0);
            $table->unsignedBigInteger('mal_cash_amount')->default(0);
            $table->unsignedBigInteger('infaq_cash_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakat_transactions');
    }
};
