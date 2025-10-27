<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'identity_id' => 1,
            'name' => 'Cliente de Prueba',
            'document_number' => '12345678',
            'email' => 'cliente@example.com',
            'phone' => '999999999',
            'address' => 'Dirección de prueba'
        ]);
    }
}
