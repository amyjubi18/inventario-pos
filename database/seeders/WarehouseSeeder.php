<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::create([
            'name' => 'Almacen Principal',
            'location' => 'Oficina Principal, Calle principal',
        ]);
        Warehouse::create(attributes: [
            'name' => 'Almacen Secundario',
            'location' => 'Oficina sucre, Calle sucre',
        ]);
    }
}
