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
        // Migration: create_booking_room_type_services_table.php
        Schema::create('booking_room_type_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('booking_id')->unsigned();
            $table->bigInteger('room_type_service_id')->unsigned();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 2);
            $table->timestamps();
            $table->softDeletes();

            // Ràng buộc khóa ngoại cho booking_id
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->onDelete('cascade');

            // Ràng buộc khóa ngoại cho room_type_service_id
            $table->foreign('room_type_service_id')
                ->references('id')
                ->on('room_type_services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_room_type_services');
    }
};
