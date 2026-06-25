<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Tenant; // <-- Tambahkan import ini
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari Tenant pertama yang dibuat
        $tenantId = Tenant::first()?->id;

        Customer::factory()
            ->count(200)
            ->create([
                'tenant_id' => $tenantId // <-- Suntikkan tenant_id ke dalam factory data customer
            ])
            ->each(function ($customer) {
                // Di dalam CustomerFactory pastikan user yang dibuat otomatis terikat ke tenant yang sama jika diperlukan
                $customer->user->assignRole('customer');
            });
    }
}
