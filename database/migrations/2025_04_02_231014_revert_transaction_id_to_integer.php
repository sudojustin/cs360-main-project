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
        // Drop and recreate the transactions table with integer transaction_id
        Schema::dropIfExists('transactions');
        
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id'); // Integer auto-increment primary key
            $table->foreignId('initiator_id')->constrained('users')->onDelete('cascade'); // A
            $table->foreignId('counterparty_id')->constrained('users')->onDelete('cascade'); // X
            $table->foreignId('partner_b_id')->nullable()->constrained('users')->onDelete('cascade'); // B
            $table->foreignId('partner_y_id')->nullable()->constrained('users')->onDelete('cascade'); // Y
            $table->foreignId('productp_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity_p')->default(1);
            $table->foreignId('producte_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity_e')->default(1);
            $table->string('hashkey', 16)->nullable();
            $table->string('hash_key', 16)->nullable();
            $table->string('hash_first', 8)->nullable();
            $table->string('hash_second', 8)->nullable();
            $table->decimal('fee_amount', 10, 2)->default(0);
            $table->decimal('transaction_fee_total', 10, 2)->default(0);
            $table->string('status')->default('Pending');
            $table->foreignId('last_action_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop and recreate the transactions table with string transaction_id
        Schema::dropIfExists('transactions');
        
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_id')->primary(); // String primary key
            $table->foreignId('initiator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('counterparty_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('partner_b_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('partner_y_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('productp_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity_p')->default(1);
            $table->foreignId('producte_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity_e')->default(1);
            $table->string('hashkey', 16)->nullable();
            $table->string('hash_key', 16)->nullable();
            $table->string('hash_first', 8)->nullable();
            $table->string('hash_second', 8)->nullable();
            $table->decimal('fee_amount', 10, 2)->default(0);
            $table->decimal('transaction_fee_total', 10, 2)->default(0);
            $table->string('status')->default('Pending');
            $table->foreignId('last_action_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
        });
    }
};
