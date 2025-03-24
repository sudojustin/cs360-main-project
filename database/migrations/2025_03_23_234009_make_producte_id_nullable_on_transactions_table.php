<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add new nullable producte_id_new column
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('producte_id_new')->nullable()->constrained('products')->onDelete('cascade');
        });

        // Migrate data from the old column to the new one
        DB::table('transactions')->update(['producte_id_new' => DB::raw('producte_id')]);

        // Disable foreign key constraints temporarily
        DB::statement('PRAGMA foreign_keys=off;'); 

        // Drop the old column (SQLite workaround)
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['producte_id']); // Drop foreign key constraint before dropping the column
            $table->dropColumn('producte_id');
        });

        // Rename the new column to match the old column name
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('producte_id_new', 'producte_id');
        });

        // Re-enable foreign key constraints
        DB::statement('PRAGMA foreign_keys=on;'); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key constraints temporarily
        DB::statement('PRAGMA foreign_keys=off;');

        // Revert changes: drop the modified producte_id column and recreate the old one if needed
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('producte_id')->nullable(false)->constrained('products')->onDelete('cascade');
        });

        // Optionally migrate data back
        DB::table('transactions')->update(['producte_id' => DB::raw('producte_id')]);

        // Drop the new column
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('producte_id');
        });

        // Re-enable foreign key constraints
        DB::statement('PRAGMA foreign_keys=on;');
    }
};
