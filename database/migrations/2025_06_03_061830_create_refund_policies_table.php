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
        // Migration: create_refund_policies_table.php
        Schema::create('refund_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('days_before_checkin')->default(0);
            $table->decimal('refund_percentage', 5, 2)->default(0);
            $table->decimal('cancellation_fee_percentage', 5, 2)->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_policies');
    }
};
