<?php

namespace Database\Seeders;

use App\Models\InternetPlan;
use App\Models\Tenant; // <-- Tambahkan import ini
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternetPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari Tenant pertama yang dibuat
        $tenantId = Tenant::first()?->id;

        InternetPlan::create([
            'tenant_id' => $tenantId, // <-- Ubah dari null menjadi $tenantId
            'name' => '20 Mbps',
            'description' =>  'Paket internet 20 Mbps',
            'download_speed' => '20',
            'upload_speed' => '20',
            'price' => 100000,
            'service_type' => fake()->randomElement([
                'pppoe',
                'dedicated',
                'hotspot',
                'static',
            ])
        ]);

        InternetPlan::create([
            'tenant_id' => $tenantId, // <-- Ubah dari null menjadi $tenantId
            'name' => '100 Mbps',
            'description' =>  'Paket internet 100 Mbps',
            'download_speed' => '100',
            'upload_speed' => '100',
            'price' => 1000000,
            'service_type' => fake()->randomElement([
                'pppoe',
                'dedicated',
                'hotspot',
                'static',
            ])
        ]);
    }
}
