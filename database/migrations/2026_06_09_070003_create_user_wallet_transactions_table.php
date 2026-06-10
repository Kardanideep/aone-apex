<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type', ['credit', 'debit']);
            $table->enum('source', ['direct_income', 'salary_income', 'level_income', 'withdrawal', 'bonus']);
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->enum('status', ['completed', 'pending', 'rejected'])->default('completed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_wallet_transactions');
    }
};
