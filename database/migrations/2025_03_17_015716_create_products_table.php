<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Product name
            $table->unsignedBigInteger('owner_id'); // Foreign key for owner
            $table->decimal('value', 10, 2); // Product value
            $table->integer('quantity')->default(1); // Quantity available
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade'); // Set foreign key constraint
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
