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
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('counter_quantity_p')->nullable()->after('quantity_p');
            $table->integer('counter_quantity_e')->nullable()->after('quantity_e');
            $table->foreignId('counteroffer_by')->nullable()->after('last_action_by')
                ->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('counter_quantity_p');
            $table->dropColumn('counter_quantity_e');
            $table->dropColumn('counteroffer_by');
        });
    }
};
