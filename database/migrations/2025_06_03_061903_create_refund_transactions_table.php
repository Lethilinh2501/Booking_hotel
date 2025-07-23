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
        // Migration: create_refund_transactions_table.php
        Schema::create('refund_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refund_id')->constrained()->onDelete('cascade');
            $table->string('transaction_type'); // refund, refund_request, refund_reject
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('payment_method')->nullable(); // vnpay, momo, none
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_transactions');
    }
};
