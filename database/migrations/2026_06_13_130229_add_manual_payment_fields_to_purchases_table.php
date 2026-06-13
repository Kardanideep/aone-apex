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
        Schema::table('purchases', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('stripe_session_id');
            $table->string('screenshot')->nullable()->after('transaction_id');
            $table->foreignId('sponsor_id')->nullable()->after('screenshot')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['sponsor_id']);
            $table->dropColumn(['transaction_id', 'screenshot', 'sponsor_id']);
        });
    }
};
