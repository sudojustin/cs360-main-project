<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the equivalences table that defines the relationship between products.
     */
    public function up(): void
    {
        // First drop the table if it exists (to clean up previous attempts)
        Schema::dropIfExists('equivalences');
        
        // Then create a fresh table
        Schema::create('equivalences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productp_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('producte_id')->constrained('products')->onDelete('cascade');
            $table->decimal('weight_percentage', 5, 2)->default(1.00); // w% - Default to 100%
            $table->decimal('transfer_cost_p', 5, 2)->default(0.05);   // c'% - Default to 5%
            $table->decimal('transfer_cost_e', 5, 2)->default(0.03);   // c"% - Default to 3%
            $table->timestamps();
            
            // Ensure each product pair is unique
            $table->unique(['productp_id', 'producte_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equivalences');
    }
};
