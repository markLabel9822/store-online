<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'This is the description Product 1',
            'price' => 2000,
            'status' => 'active',
            'product_category_id' => 1,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'This is the description Product 2.',
            'price' => 3000,
            'status' => 'active',
            'product_category_id' => 2,
        ]);
    }
}
