<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates predefined products with fixed values for an ancient marketplace.
     * Users will later specify the quantities they own.
     */
    public function run(): void
    {
        // Define predefined products with their values for an ancient marketplace
        $products = [
            // Metals and Raw Materials
            ['name' => 'Bronze Ingot (1 kg)', 'value' => 60.00],
            ['name' => 'Iron Ingot (1 kg)', 'value' => 90.00],
            ['name' => 'Copper Ingot (1 kg)', 'value' => 45.00],
            ['name' => 'Silver Nugget (100 g)', 'value' => 180.00],
            ['name' => 'Gold Nugget (50 g)', 'value' => 300.00],
            ['name' => 'Clay (10 kg)', 'value' => 10.00],
            ['name' => 'Stone (10 kg)', 'value' => 7.00],
            ['name' => 'Timber (1 board)', 'value' => 30.00],
            
            // Textiles and Materials
            ['name' => 'Wool (1 kg)', 'value' => 22.00],
            ['name' => 'Linen (1 m)', 'value' => 45.00],
            ['name' => 'Silk (1 m)', 'value' => 140.00],
            ['name' => 'Cotton (1 kg)', 'value' => 38.00],
            ['name' => 'Leather (1 hide)', 'value' => 55.00],
            ['name' => 'Dye (100 g)', 'value' => 50.00],
            
            // Spices and Luxury Goods
            ['name' => 'Salt (500 g)', 'value' => 50.00],
            ['name' => 'Pepper (100 g)', 'value' => 75.00],
            ['name' => 'Saffron (10 g)', 'value' => 160.00],
            ['name' => 'Cinnamon (100 g)', 'value' => 110.00],
            ['name' => 'Incense (100 g)', 'value' => 95.00],
            ['name' => 'Myrrh (50 g)', 'value' => 140.00],
            
            // Food and Agriculture
            ['name' => 'Wheat (10 kg)', 'value' => 15.00],
            ['name' => 'Barley (10 kg)', 'value' => 12.00],
            ['name' => 'Olive Oil (1 L)', 'value' => 38.00],
            ['name' => 'Wine (1 amphora)', 'value' => 45.00],
            ['name' => 'Honey (500 g)', 'value' => 30.00],
            ['name' => 'Dried Fish (1 kg)', 'value' => 22.00],
            ['name' => 'Dried Fruit (500 g)', 'value' => 25.00],
            
            // Crafted Goods
            ['name' => 'Pottery (1 vessel)', 'value' => 28.00],
            ['name' => 'Glassware (1 piece)', 'value' => 75.00],
            ['name' => 'Bronze Tools (1 set)', 'value' => 70.00],
            ['name' => 'Iron Tools (1 set)', 'value' => 105.00],
            ['name' => 'Wooden Furniture (1 piece)', 'value' => 90.00],
            ['name' => 'Woven Basket (1 piece)', 'value' => 18.00],
            ['name' => 'Oil Lamp (1 piece)', 'value' => 35.00],
            
            // Services (measured in hours)
            ['name' => 'Blacksmith Service (1 hr)', 'value' => 65.00],
            ['name' => 'Carpentry Service (1 hr)', 'value' => 55.00],
            ['name' => 'Scribal Service (1 hr)', 'value' => 75.00],
            ['name' => 'Masonry Service (1 hr)', 'value' => 70.00],
        ];

        // Create the predefined products (not assigned to any user)
        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'owner_id' => null, // No owner initially
                'value' => $product['value'],
                'quantity' => 0, // No quantity initially, users will specify later
            ]);
        }
    }
}
