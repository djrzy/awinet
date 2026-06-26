<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant; // <-- Import Model Tenant
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Jalankan Seeder Role dan Permission terlebih dahulu
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // 2. Buat Tenant Dummy (ISP Pertama)
        $tenant = Tenant::create([
            'name' => 'AWINET ISP',
            'slug' => 'awinet',
            'email' => 'info@awinet.net',
            'phone' => '08123456789',
            'address' => 'Jakarta, Indonesia',
            'status' => 'active',
        ]);

        // 3. Buat Akun Superadmin yang Terikat ke Tenant AWINET
        $superadmin = User::create([
            'tenant_id' => $tenant->id, // <-- Kaitkan ke Tenant yang baru dibuat
            'name' => 'Owner AWINET',
            'email' => 'owner@awinet.net',
            'password' => Hash::make('password'), // Silakan ganti password-nya
        ]);

        // Pasangkan role Superadmin (Spatie)
        $superadmin->assignRole('superadmin');

        // 4. (Opsional) Buat Akun GODMODE yang TIDAK terikat ke Tenant manapun
        $godmode = User::create([
            'tenant_id' => null, // Godmode tidak punya tenant karena bisa melihat semua ISP
            'name' => 'Developer Godmode',
            'email' => 'admin@saas.com',
            'password' => Hash::make('password'),
        ]);

        $godmode->assignRole('godmode');

        // 5. Jalankan seeder data bawaan lainnya jika ada
        $this->call([
            PaymentMethodSeeder::class,
            // Jika seeder ini dijalankan, pastikan di dalamnya sudah diset tenant_id nya ya!
            InternetPlanSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
