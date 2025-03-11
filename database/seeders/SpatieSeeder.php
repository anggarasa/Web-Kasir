<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'crud-admin'],
            ['name' => 'crud-pelanggan'],
            ['name' => 'crud-product'],
            ['name' => 'create-pembayaran'],
            ['name' => 'view-detail-transaksi'],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name']]);
        }
        
        $superAdmin = Role::create(['name' => 'superAdmin']);
            $superAdmin->givePermissionTo('crud-admin');
            $superAdmin->givePermissionTo('crud-pelanggan');
            $superAdmin->givePermissionTo('crud-product');
            $superAdmin->givePermissionTo('create-pembayaran');
            $superAdmin->givePermissionTo('view-detail-transaksi');

        $admin = Role::create(['name' => 'admin']);
            $admin->givePermissionTo('crud-pelanggan');
            $admin->givePermissionTo('crud-product');
            $admin->givePermissionTo('create-pembayaran');
            $admin->givePermissionTo('view-detail-transaksi');
    }
}
