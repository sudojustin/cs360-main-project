<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create sample transactions for the bartering system.
     */
    public function run(): void
    {
        // This seeder doesn't need to create transactions with the new system
        // since transactions will be created by users through the UI based on 
        // their inventory and desired trades.
        
        // The new system uses UserProduct to track inventory and Equivalence
        // for trade calculations, so sample transactions would be less useful.
        
        // If needed, sample transactions could be added here in the future
        // once the system is fully operational.
        
        // Example of how a transaction could be created:
        /*
        // Find users
        $user1 = User::where('email', 'test@test')->first();
        $user2 = User::where('email', 'user1@user1')->first();
        
        if ($user1 && $user2) {
            // Get products from inventory
            $user1Product = UserProduct::where('user_id', $user1->id)->first();
            $user2Product = UserProduct::where('user_id', $user2->id)->first();
            
            if ($user1Product && $user2Product) {
                Transaction::create([
                    'initiator_id' => $user1->id,
                    'counterparty_id' => $user2->id,
                    'productp_id' => $user1Product->product_id,
                    'quantity_p' => 1,
                    'producte_id' => $user2Product->product_id,
                    'quantity_e' => 1,
                    'hashkey' => bin2hex(random_bytes(8)),
                    'transaction_fee_total' => 0,
                    'status' => 'Pending',
                    'created_at' => now(),
                ]);
            }
        }
        */
    }
}
