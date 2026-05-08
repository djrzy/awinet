<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'customer.view',
            'customer.create',
            'customer.edit',
            'customer.delete',

            'invoice.view',
            'invoice.create',
            'invoice.pay',

            'ticket.create',
            'ticket.reply',
            'ticket.close',

            'router.manage',

            'lead.create',
            'lead.update',
            'lead.convert'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
