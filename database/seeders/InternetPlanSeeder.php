<?php

namespace Database\Seeders;

use App\Models\InternetPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternetPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternetPlan::create([
            'tenant_id' => null,
            'name' => '20 Mbps',
            'description' =>  'Paket internet 20 Mbps',
            'download_speed' => '20',
            'upload_speed' => '20',
            'price' => 100000,
            'notes' => null,
        ]);
    }
}
