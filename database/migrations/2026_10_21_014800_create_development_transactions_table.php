<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('development_transactions', function (Blueprint $table) {
            $table->id();

            // Relasi ke proyek pembangunan
            $table->foreignId('development_project_id')
                ->nullable()
                ->constrained('development_projects')
                ->nullOnDelete();

            // Jenis transaksi
            $table->string('type');

            // Informasi pemasukan dan pengeluaran
            $table->string('donor_or_source')->nullable();
            $table->date('transaction_date');
            $table->decimal('amount', 15, 2);
            $table->text('purpose')->nullable();

            // Bukti transaksi
            $table->string('proof_file')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('development_transactions');
    }
};
