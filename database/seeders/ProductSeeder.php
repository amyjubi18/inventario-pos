<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();

        Product::create([
            'name' => 'Producto de Prueba 1',
            'description' => 'Descripción del producto 1',
            'price' => 10.00,
            'stock' => 50,
            'category_id' => $category->id ?? 1
        ]);

        Product::create([
            'name' => 'Producto de Prueba 2',
            'description' => 'Descripción del producto 2',
            'price' => 20.00,
            'stock' => 30,
            'category_id' => $category->id ?? 1
        ]);

        Product::create([
            'name' => 'Producto de Prueba 3',
            'description' => 'Descripción del producto 3',
            'price' => 15.00,
            'stock' => 25,
            'category_id' => $category->id ?? 1
        ]);
    }
}
