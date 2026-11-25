<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('idul_adha_qurbans', function (Blueprint $table) {
            $table->id();
            $table->string('hijri_year', 10)->index();
            $table->date('received_date')->index();
            $table->string('person_name')->index();
            $table->string('phone', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('animal_type', 20)->nullable()->index();
            $table->string('procurement_type', 30)->nullable()->index();
            $table->unsignedBigInteger('agreed_amount')->default(0);
            $table->unsignedBigInteger('slaughter_care_fee')->default(0);
            $table->unsignedBigInteger('infaq_amount')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idul_adha_qurbans');
    }
};
