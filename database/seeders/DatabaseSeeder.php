<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear the tables before seeding to avoid conflicts
        DB::table('users')->truncate();
        DB::table('products')->truncate();
        DB::table('transactions')->truncate();
        DB::table('user_products')->truncate();
        DB::table('equivalences')->truncate();

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test',
            'password' => bcrypt('password'),
            'is_approved' => true,
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'is_approved' => true,
        ]);

        User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@user1',
            'password' => bcrypt('password'),
            'is_approved' => true,
        ]);

        User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@user2',
            'password' => bcrypt('password'),
            'is_approved' => true,
        ]);

        User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@user3',
            'password' => bcrypt('password'),
            'is_approved' => true,
        ]);

        User::factory()->create([
            'name' => 'user4',
            'email' => 'user4@user4',
            'password' => bcrypt('password'),
            'is_approved' => true,
        ]);

        $this->call([
            ProductSeeder::class,
            EquivalenceSeeder::class,
            UserProductSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
