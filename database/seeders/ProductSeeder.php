<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        // Ensure we have users to assign products
        if ($users->isEmpty()) {
            echo "No users found to assign products!";
            return;
        }

        // Explicitly add test products
        $testProducts = [
            ['name' => 'Product 1 for Test', 'value' => 100.00, 'quantity' => 5, 'owner_id' => $users->first()->id ?? null],
            ['name' => 'Product 2 for User 1', 'value' => 150.00, 'quantity' => 3, 'owner_id' => $users->skip(1)->first()->id ?? null],
            ['name' => 'Product 3 for User 2', 'value' => 200.00, 'quantity' => 2, 'owner_id' => $users->skip(2)->first()->id ?? null],
            ['name' => 'Product 4 for User 3', 'value' => 250.00, 'quantity' => 4, 'owner_id' => $users->skip(3)->first()->id ?? null],
        ];

        foreach ($testProducts as $product) {
            if ($product['owner_id']) {
                Product::create($product);
            }
        }

        // Define additional products
        $products = [
            ['name' => 'Laptop', 'value' => 1200.00, 'quantity' => 1],
            ['name' => 'Smartphone', 'value' => 800.00, 'quantity' => 5],
            ['name' => 'Headphones', 'value' => 150.00, 'quantity' => 10],
            ['name' => 'Smartwatch', 'value' => 250.00, 'quantity' => 3],
            ['name' => 'Tablet', 'value' => 500.00, 'quantity' => 7],
            ['name' => 'Monitor', 'value' => 300.00, 'quantity' => 4],
            ['name' => 'Keyboard', 'value' => 100.00, 'quantity' => 6],
            ['name' => 'Mouse', 'value' => 50.00, 'quantity' => 8],
        ];

        // Assign a random product to each user
        foreach ($users as $user) {
            $product = $products[array_rand($products)];

            Product::create([
                'name' => $product['name'],
                'owner_id' => $user->id,
                'value' => $product['value'],
                'quantity' => $product['quantity'],
            ]);
        }
    }
}
