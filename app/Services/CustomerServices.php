<?php

namespace App\Services;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerServices
{
    public function create(array $data): Customer
    {
        return DB::transaction(function () use ($data) {

            $user = User::create([
                'tenant_id' => null,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make('password'),
                'is_active' => true,
            ]);

            $user->assignRole('customer');

            return Customer::create([
                'tenant_id' => null,
                'user_id' => $user->id,
                'internet_plans_id' => null,
                'customer_code' => $this->generateCustomerCode(),
                'nik' => $data['nik'],
                'address' => $data['address'],
                'postal_code' => $data['postal_code'],
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
                'status' => 'pending',
            ]);
        });
    }

    protected function generateCustomerCode(): string
    {
        $lastCustomer = Customer::orderBy('customer_code', 'desc')->first();

        $number = $lastCustomer
            ? ((int) substr($lastCustomer->customer_code, 4)) + 1
            : 1;

        return 'CUS-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
