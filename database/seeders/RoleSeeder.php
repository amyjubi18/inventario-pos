<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //categorias
            'create-categories',
            'read-categories',
            'update-categories',
            'delete-categories',
            //productos
            'create-products',
            'read-products',
            'update-products',
            'delete-products',
            //alamacenes
            'create-warehouses',
            'read-warehouses',
            'update-warehouses',
            'delete-warehouses',
            //proveedores
            'create-suppliers',
            'read-suppliers',
            'update-suppliers',
            'delete-suppliers',
            //Ordenes de compra
            'create-purchase_orders',
            'read-purchase_orders',
            'update-purchase_orders',
            'delete-purchase_orders',
            //Compras
            'create-purchases',
            'read-purchases',
            'update-purchases',
            'delete-purchases',
            //Clientes
            'create-customers',
            'read-customers',
            'update-customers',
            'delete-customers',
            //cotizaciones
            'create-quotes',
            'read-quotes',
            'update-quotes',
            'delete-quotes',
            //ventas
            'create-sales',
            'read-sales',
            'update-sales',
            'delete-sales',
            //movimientos
            'create-movements',
            'read-movements',
            'update-movements',
            'delete-movements',
            //transferencias
            'create-transfers',
            'read-transfers',
            'update-transfers',
            'delete-transfers',
            //reportes
            'read-top-products',
            'read-top-customers',
            'read-low-stock',
            //usuarios
            'create-users',
            'read-users',
            'update-users',
            'delete-users',

            //roles
            'create-roles',
            'read-roles',
            'update-roles',
            'delete-roles',
            //permisos
            'create-permissions',
            'read-permissions',
            'update-permissions',
            'delete-permissions',
            //setting
            'read-setting',
            'update-setting',
        ];
        foreach($permissions as $permission){
            Permission::create(['name' =>$permission]);
        }
        Role::create(['name' => 'admin'])
        ->givePermissionTo(Permission::all());

        Role::create(['name' => 'editor'])
        ->givePermissionTo([
            'create-categories',
            'read-categories',
            'update-categories',
            'delete-categories',
            'create-products',
            'read-products',
            'update-products',
            'delete-products',
            'create-warehouses',
            'read-warehouses',
            'update-warehouses',
            'delete-warehouses',
            'create-suppliers',
            'read-suppliers',
            'update-suppliers',
            'delete-suppliers',
            'create-customers',
            'read-customers',
            'update-customers',
            'delete-customers',

            ]);

        Role::create(['name' => 'viewer'])
            ->givePermissionTo([
                'read-categories',
                'read-products',
                'read-warehouses',
                'read-suppliers',
                'read-customers',
                'read-quotes',
                'read-sales',
                'read-movements',
                'read-transfers',
                'read-top-products',
                'read-top-customers',
                'read-low-stock',
            ]);
            User::factory()->create([
            'name' => 'Amy',
            'email' => 'amygarcia9618@gmail.com',
            'password' => bcrypt('amyjubi18'),
        ])->assignRole('admin');



    }
}
