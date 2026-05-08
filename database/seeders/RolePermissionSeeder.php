<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::findByName('admin');

        $admin->givePermissionTo([
            'customer.view',
            'customer.create',
            'customer.edit',
            'invoice.create',
            'invoice.view',
            'router.manage'
        ]);

        $staff = Role::findByName('staff');

        $staff->givePermissionTo([
            'customer.view',
            'ticket.create',
            'ticket.reply'
        ]);

        $technician = Role::findByName('technician');

        $technician->givePermissionTo([
            'router.manage'
        ]);
    }
}
