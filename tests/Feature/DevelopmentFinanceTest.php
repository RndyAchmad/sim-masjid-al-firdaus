<?php

namespace Tests\Feature;

use App\Enums\DevelopmentProjectStatus;
use App\Enums\TransactionType;
use App\Enums\UserRole;
use App\Models\DevelopmentProject;
use App\Models\DevelopmentTransaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DevelopmentFinanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_report_counts_general_and_project_transactions_once(): void
    {
        $project = DevelopmentProject::query()->create([
            'name' => 'Renovasi Tempat Wudu',
            'slug' => 'renovasi-tempat-wudu',
            'status' => DevelopmentProjectStatus::ONGOING,
        ]);

        DevelopmentTransaction::query()->create([
            'type' => TransactionType::INCOME,
            'donor_or_source' => 'Kotak Infak',
            'transaction_date' => '2026-10-02',
            'amount' => 100000,
            'purpose' => 'Infak pembangunan umum',
        ]);

        DevelopmentTransaction::query()->create([
            'development_project_id' => $project->id,
            'type' => TransactionType::INCOME,
            'donor_or_source' => 'Hamba Allah',
            'transaction_date' => '2026-10-04',
            'amount' => 50000,
            'purpose' => 'Donasi renovasi tempat wudu',
        ]);

        DevelopmentTransaction::query()->create([
            'development_project_id' => $project->id,
            'type' => TransactionType::EXPENSE,
            'donor_or_source' => 'Toko Bangunan',
            'transaction_date' => '2026-10-06',
            'amount' => 25000,
            'purpose' => 'Pembelian keramik',
        ]);

        DevelopmentTransaction::query()->create([
            'type' => TransactionType::INCOME,
            'donor_or_source' => 'Donatur sebelumnya',
            'transaction_date' => '2026-09-30',
            'amount' => 70000,
            'purpose' => 'Infak pembangunan umum',
        ]);

        $response = $this->get(route('laporan.pembangunan', ['bulan' => '2026-10']));

        $response
            ->assertOk()
            ->assertSee('Rp 150.000')
            ->assertSee('Rp 25.000')
            ->assertSee('Rp 195.000')
            ->assertSee('Kas Pembangunan Umum')
            ->assertSee('Renovasi Tempat Wudu');
    }

    public function test_deleting_a_project_keeps_its_transaction_history(): void
    {
        $project = DevelopmentProject::query()->create([
            'name' => 'Perbaikan Atap',
            'slug' => 'perbaikan-atap',
            'status' => DevelopmentProjectStatus::ONGOING,
        ]);

        $transaction = DevelopmentTransaction::query()->create([
            'development_project_id' => $project->id,
            'type' => TransactionType::EXPENSE,
            'donor_or_source' => 'Toko Material',
            'transaction_date' => '2026-10-06',
            'amount' => 50000,
            'purpose' => 'Pembelian genteng',
        ]);

        $project->delete();

        $this->assertDatabaseHas('development_transactions', [
            'id' => $transaction->id,
            'development_project_id' => null,
        ]);
    }

    public function test_treasurer_can_record_general_and_project_transactions(): void
    {
        $treasurer = User::query()->create([
            'name' => 'Bendahara Pengujian',
            'email' => 'bendahara@example.test',
            'password' => 'password',
            'role' => UserRole::Bendahara,
        ]);

        $project = DevelopmentProject::query()->create([
            'name' => 'Perluasan Kanopi',
            'slug' => 'perluasan-kanopi',
            'status' => DevelopmentProjectStatus::ONGOING,
        ]);

        $response = $this->actingAs($treasurer)->post(
            route('admin.pembangunan.transactions.store'),
            [
                'type' => TransactionType::INCOME->value,
                'donor_or_source' => 'Kotak Infak Jumat',
                'transaction_date' => '2026-10-10',
                'amount' => 125000,
                'purpose' => 'Infak pembangunan umum',
            ]
        );

        $response->assertRedirect(route('admin.pembangunan.index'));
        $this->assertDatabaseHas('development_transactions', [
            'development_project_id' => null,
            'type' => TransactionType::INCOME->value,
            'amount' => 125000,
        ]);

        $this->actingAs($treasurer)->post(
            route('admin.pembangunan.transactions.store'),
            [
                'development_project_id' => $project->id,
                'type' => TransactionType::EXPENSE->value,
                'donor_or_source' => 'Toko Bangunan',
                'transaction_date' => '2026-10-11',
                'amount' => 25000,
                'purpose' => 'Pembelian rangka kanopi',
            ]
        )->assertRedirect(route('admin.pembangunan.index'));

        $this->assertDatabaseHas('development_transactions', [
            'development_project_id' => $project->id,
            'type' => TransactionType::EXPENSE->value,
            'amount' => 25000,
        ]);
    }
}
