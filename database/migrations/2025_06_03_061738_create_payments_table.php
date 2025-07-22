<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('method'); // ví dụ: 'vnpay', 'cash'
            $table->decimal('amount', 15, 2);
            $table->boolean('is_partial')->default(false); // thanh toán một phần
            $table->string('status'); // ví dụ: completed, failed, pending
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('booking_id');

            $table->timestamps();
            $table->softDeletes();

            // Liên kết khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
