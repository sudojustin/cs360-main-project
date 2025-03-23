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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id'); // Primary key
            $table->foreignId('initiator_id')->constrained('users')->onDelete('cascade'); // FK: A
            $table->foreignId('counterparty_id')->constrained('users')->onDelete('cascade'); // FK: X
            $table->foreignId('partner_initiator_id')->nullable()->constrained('users')->onDelete('cascade'); // FK: B
            $table->foreignId('partner_counterparty_id')->nullable()->constrained('users')->onDelete('cascade'); // FK: Y
            $table->foreignId('productp_id')->constrained('products')->onDelete('cascade'); // FK: Product P
            $table->foreignId('producte_id')->constrained('products')->onDelete('cascade'); // FK: Product E
            $table->string('hashkey', 16)->unique(); // Secure 16-digit key
            $table->decimal('transaction_fee_total', 10, 2); // Total fee with precision
            $table->timestamp('created_at')->useCurrent(); // Auto-set on creation
            $table->timestamp('completed_at')->nullable(); // Nullable completion time
            $table->enum('status', ['Pending', 'Verified', 'Completed'])->default('Pending'); // Transaction status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
