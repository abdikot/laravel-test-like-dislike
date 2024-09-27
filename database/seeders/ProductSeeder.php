<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'Ini Product 1',
            'price' => 100,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Ini Product 2',
            'price' => 200,
        ]);
    }
}
