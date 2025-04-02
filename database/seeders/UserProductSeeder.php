<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Database\Seeder;

class UserProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Assigns random products to users with different quantities.
     */
    public function run(): void
    {
        // Get all users except admin
        $users = User::where('is_admin', false)->get();
        
        // Get all products
        $products = Product::all();
        
        if ($users->isEmpty() || $products->isEmpty()) {
            echo "No users or products found for UserProduct seeding!";
            return;
        }
        
        // Give each user 5-10 random products with varying quantities
        foreach ($users as $user) {
            // Select random number of products (5-10)
            $randomProducts = $products->random(rand(5, 10));
            
            foreach ($randomProducts as $product) {
                // Assign random quantity (1-10) for each product
                UserProduct::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 10)
                ]);
            }
        }
        
        // Make sure test user has specific items
        $testUser = User::where('email', 'test@test')->first();
        if ($testUser) {
            // Ensure test user has Wheat, Iron Tools, and Wine
            $essentialItems = [
                'Wheat (10 kg)' => rand(3, 8),
                'Iron Tools (1 set)' => rand(1, 3),
                'Wine (1 amphora)' => rand(2, 5)
            ];
            
            foreach ($essentialItems as $itemName => $quantity) {
                $product = $products->where('name', $itemName)->first();
                if ($product) {
                    $existingProduct = UserProduct::where('user_id', $testUser->id)
                                                  ->where('product_id', $product->id)
                                                  ->first();
                    
                    if ($existingProduct) {
                        $existingProduct->quantity = $quantity;
                        $existingProduct->save();
                    } else {
                        UserProduct::create([
                            'user_id' => $testUser->id,
                            'product_id' => $product->id,
                            'quantity' => $quantity
                        ]);
                    }
                }
            }
        }
    }
}
