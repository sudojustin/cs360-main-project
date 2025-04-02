<?php

namespace Database\Seeders;

use App\Models\Equivalence;
use App\Models\Product;
use Illuminate\Database\Seeder;

class EquivalenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates various equivalence relationships between products.
     */
    public function run(): void
    {
        // Get all products
        $products = Product::all();
        
        if ($products->count() < 2) {
            echo "Not enough products found to create equivalences!";
            return;
        }
        
        // Map to easily find products by name
        $productMap = [];
        foreach ($products as $product) {
            $productMap[$product->name] = $product;
        }
        
        // Define some essential equivalence relationships
        $equivalences = [
            // Raw Materials exchanges
            [
                'p_name' => 'Iron Ingot (1 kg)',
                'e_name' => 'Bronze Ingot (1 kg)',
                'weight' => 0.67, // Iron is more valuable than bronze
                'cost_p' => 0.04,
                'cost_e' => 0.05
            ],
            [
                'p_name' => 'Copper Ingot (1 kg)',
                'e_name' => 'Bronze Ingot (1 kg)',
                'weight' => 1.33, // Bronze is more valuable than copper
                'cost_p' => 0.05,
                'cost_e' => 0.05
            ],
            [
                'p_name' => 'Gold Nugget (50 g)',
                'e_name' => 'Silver Nugget (100 g)',
                'weight' => 0.60, // Gold is more valuable than silver
                'cost_p' => 0.07,
                'cost_e' => 0.06
            ],
            
            // Textiles exchanges
            [
                'p_name' => 'Silk (1 m)',
                'e_name' => 'Wool (1 kg)',
                'weight' => 0.16, // Silk is much more valuable than wool
                'cost_p' => 0.08,
                'cost_e' => 0.03
            ],
            [
                'p_name' => 'Linen (1 m)',
                'e_name' => 'Cotton (1 kg)',
                'weight' => 0.85, // Linen is slightly more valuable than cotton
                'cost_p' => 0.04,
                'cost_e' => 0.04
            ],
            
            // Food exchanges
            [
                'p_name' => 'Olive Oil (1 L)',
                'e_name' => 'Wine (1 amphora)',
                'weight' => 0.85, // Wine is slightly more valuable
                'cost_p' => 0.06,
                'cost_e' => 0.06
            ],
            [
                'p_name' => 'Wheat (10 kg)',
                'e_name' => 'Barley (10 kg)',
                'weight' => 0.80, // Wheat is more valuable than barley
                'cost_p' => 0.03,
                'cost_e' => 0.03
            ],
            
            // Services with goods
            [
                'p_name' => 'Blacksmith Service (1 hr)',
                'e_name' => 'Iron Ingot (1 kg)',
                'weight' => 0.72, // Service is less valuable than material
                'cost_p' => 0.02,
                'cost_e' => 0.05
            ],
            [
                'p_name' => 'Carpentry Service (1 hr)',
                'e_name' => 'Timber (1 board)',
                'weight' => 0.55, // Service is more valuable than raw material
                'cost_p' => 0.02,
                'cost_e' => 0.04
            ],
        ];
        
        // Create the equivalence relationships
        foreach ($equivalences as $eq) {
            if (!isset($productMap[$eq['p_name']]) || !isset($productMap[$eq['e_name']])) {
                echo "Product not found: {$eq['p_name']} or {$eq['e_name']}\n";
                continue;
            }
            
            Equivalence::create([
                'productp_id' => $productMap[$eq['p_name']]->id,
                'producte_id' => $productMap[$eq['e_name']]->id,
                'weight_percentage' => $eq['weight'],
                'transfer_cost_p' => $eq['cost_p'],
                'transfer_cost_e' => $eq['cost_e'],
            ]);
            
            // Also create the inverse relationship with adjusted weight
            // This allows trading in both directions
            $inverseWeight = 1 / $eq['weight']; // Inverse relationship
            
            Equivalence::create([
                'productp_id' => $productMap[$eq['e_name']]->id,
                'producte_id' => $productMap[$eq['p_name']]->id,
                'weight_percentage' => $inverseWeight,
                'transfer_cost_p' => $eq['cost_e'], // Swap costs too
                'transfer_cost_e' => $eq['cost_p'],
            ]);
        }
    }
}
