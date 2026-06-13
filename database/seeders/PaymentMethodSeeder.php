<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            'Cash',
            'Manual Transfer',
            'Bank Transfer',
            'Xendit',
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::firstOrCreate(['name' => $method]);
        }
    }
}
