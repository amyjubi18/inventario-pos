<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronicos',
            'description' => 'Productos Electronicos'
            ],
            [
                'name' => 'Ropa',
            'description' => 'Productos de ropa'
            ],
            [
                'name' => 'Hogar',
            'description' => 'Productos para el hogar'
            ],
            [
                'name' => 'Juguetes',
            'description' => 'Productos de juguetes'
            ],
            [
                'name' => 'Alimentos',
            'description' => 'Productos de alimentos'
            ],
            ];

            foreach($categories as $category){
                Category::create($category);
            }

    }
}
