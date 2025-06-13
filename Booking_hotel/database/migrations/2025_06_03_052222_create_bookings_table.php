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
        // Migration: create_bookings_table.php
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->nullable();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->dateTime('actual_check_in')->nullable();
            $table->dateTime('actual_check_out')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 15, 2)->default(0.00);
            $table->decimal('discount_amount', 15, 2)->nullable();
            $table->decimal('base_price', 15, 2)->nullable();
            $table->decimal('service_total', 15, 2)->nullable();
            $table->decimal('tax_fee', 15, 2)->nullable();
            $table->integer('total_guests');
            $table->integer('children_count')->default(0);
            $table->integer('room_quantity')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->text('special_request')->nullable();
            $table->enum('service_plus_status', ['none', 'not_yet_paid', 'paid']);
            $table->enum('status', ['unpaid', 'partial', 'paid', 'check_in', 'check_out', 'cancelled', 'cancelled_without_refund', 'refunded']);
            $table->decimal('service_plus_total', 20, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
