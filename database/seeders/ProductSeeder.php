<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop',
            'owner_id' => 1, // Assuming user ID 1 owns this product
            'value' => 1200.00,
            'quantity' => 1,
        ]);

        Product::create([
            'name' => 'Smartphone',
            'owner_id' => 2, // Assuming user ID 2 owns this product
            'value' => 800.00,
            'quantity' => 5,
        ]);

        Product::create([
            'name' => 'Headphones',
            'owner_id' => 1, // Assuming user ID 1 owns this product
            'value' => 150.00,
            'quantity' => 10,
        ]);

        Product::create([
            'name' => 'Smartwatch',
            'owner_id' => 2, // Assuming user ID 2 owns this product
            'value' => 250.00,
            'quantity' => 3,
        ]);

        // Additional products
        Product::create([
            'name' => 'Tablet',
            'owner_id' => 1,
            'value' => 500.00,
            'quantity' => 7,
        ]);

        Product::create([
            'name' => 'Monitor',
            'owner_id' => 2,
            'value' => 300.00,
            'quantity' => 4,
        ]);

        Product::create([
            'name' => 'Keyboard',
            'owner_id' => 1,
            'value' => 100.00,
            'quantity' => 6,
        ]);

        Product::create([
            'name' => 'Mouse',
            'owner_id' => 2,
            'value' => 50.00,
            'quantity' => 8,
        ]);
    }
}
