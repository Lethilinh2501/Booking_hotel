<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->dateTime('actual_check_in')->nullable();
            $table->dateTime('actual_check_out')->nullable();
            $table->decimal('total_price', 15, 2)->default(0);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('base_price', 15, 2)->default(0);
            $table->decimal('service_total', 15, 2)->default(0);
            $table->decimal('tax_fee', 15, 2)->default(0);
            $table->unsignedTinyInteger('total_guests')->default(1);
            $table->unsignedTinyInteger('children_count')->default(0);
            $table->unsignedTinyInteger('room_quantity')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('special_request')->nullable();
            $table->string('service_plus_status')->nullable(); // optional enum
            $table->enum('status', [
                'unpaid',
                'partial',
                'paid',
                'check_in',
                'check_out',
                'cancelled',
                'cancelled_without_refund',
                'refunded'
            ])->default('unpaid');
            $table->decimal('service_plus_total', 15, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
