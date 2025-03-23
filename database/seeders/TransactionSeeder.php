<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for testing (using correct owner IDs)
        $test = User::find(1);
        $user1 = User::find(2);
        $user2 = User::find(3);
        $user3 = User::find(4);

        // Ensure users exist
        if (!$test || !$user1 || !$user2 || !$user3) {
            echo "One or more users not found!";
            return;
        }

        // Get the correct products based on the fixed owner IDs
        $product1 = Product::where('owner_id', $test->id)->where('name', 'Product 1 for Test')->first();
        $product2 = Product::where('owner_id', $user1->id)->where('name', 'Product 2 for User 1')->first();
        $product3 = Product::where('owner_id', $user2->id)->where('name', 'Product 3 for User 2')->first();
        $product4 = Product::where('owner_id', $user3->id)->where('name', 'Product 4 for User 3')->first();

        // Ensure products are found
        if (!$product1 || !$product2 || !$product3 || !$product4) {
            echo "One or more products not found!";
            return;
        }

        // Debugging Output
        echo "Product 1 ID: " . $product1->id . "\n";
        echo "Product 2 ID: " . $product2->id . "\n";
        echo "Product 3 ID: " . $product3->id . "\n";
        echo "Product 4 ID: " . $product4->id . "\n";

        // Create transactions with corrected user IDs
        Transaction::create([
            'initiator_id' => $test->id,
            'counterparty_id' => $user2->id,
            'status' => 'waiting for partner to send item',
            'productp_id' => $product1->id,
            'producte_id' => $product2->id,
            'hashkey' => bin2hex(random_bytes(8)), // Generates a random 16-character hex key
            'transaction_fee_total' => 0,
            'status' => 'Pending',
        ]);

        Transaction::create([
            'initiator_id' => $user1->id,
            'counterparty_id' => $test->id,
            'status' => 'waiting for partner to send item',
            'productp_id' => $product2->id,
            'producte_id' => $product1->id,
            'hashkey' => bin2hex(random_bytes(8)),
            'transaction_fee_total' => 0,
            'status' => 'Pending',
        ]);

        Transaction::create([
            'initiator_id' => $user2->id,
            'counterparty_id' => $user1->id,
            'status' => 'trade completed',
            'productp_id' => $product3->id,
            'producte_id' => $product2->id,
            'hashkey' => bin2hex(random_bytes(8)),
            'transaction_fee_total' => 0,
            'status' => 'Pending',
        ]);

        Transaction::create([
            'initiator_id' => $user3->id,
            'counterparty_id' => $user2->id,
            'status' => 'trade completed',
            'productp_id' => $product4->id,
            'producte_id' => $product3->id,
            'hashkey' => bin2hex(random_bytes(8)),
            'transaction_fee_total' => 0,
            'status' => 'Pending',
        ]);
    }
}
