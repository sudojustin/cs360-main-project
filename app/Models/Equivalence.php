<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equivalence extends Model
{
    public function up()
    {
        Schema::create('equivalences', function (Blueprint $table) {
            $table->id("equivalence_id"); // Primary key
            $table->foreignId('productp_id')->constrained('products')->onDelete('cascade'); // Foreign key
            $table->foreignId('producte_id')->constrained('products')->onDelete('cascade'); // Foreign key
            $table->decimal('weight_percentage', 5, 2); // Example: 80.00% = 0.8
            $table->timestamp('last_update')->useCurrent(); // Auto-updates on modifications
        });
    }

    public function down()
    {
        Schema::dropIfExists('equivalences');
    }
}
