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
        // Migration: create_booking_guest_table.php
        Schema::create('booking_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('guest_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_guests');
    }
};
