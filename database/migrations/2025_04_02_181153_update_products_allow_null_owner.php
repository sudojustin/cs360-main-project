<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Make owner_id nullable to allow for predefined products with no owner.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Modify owner_id to allow NULL values
            $table->unsignedBigInteger('owner_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * Revert owner_id to non-nullable.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert back to non-nullable
            $table->unsignedBigInteger('owner_id')->nullable(false)->change();
        });
    }
};
