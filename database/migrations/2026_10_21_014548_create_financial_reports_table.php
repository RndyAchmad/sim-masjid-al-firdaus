<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();

            // Jenis transaksi
            $table->string('type');

            // Detail transaksi
            $table->date('transaction_date');
            $table->decimal('amount', 15, 2);
            $table->text('description');

            // Bukti transaksi bersifat opsional
            $table->string('proof_file')->nullable();

            $table->timestamps();

            // Indeks untuk pencarian laporan
            $table->index('transaction_date');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
