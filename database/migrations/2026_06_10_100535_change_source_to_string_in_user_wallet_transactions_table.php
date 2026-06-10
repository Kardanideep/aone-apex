<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_wallet_transactions', function (Blueprint $table) {
            $table->string('source')->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_wallet_transactions', function (Blueprint $table) {
            // Can't revert back to enum easily if new values are inserted
        });
    }
};
