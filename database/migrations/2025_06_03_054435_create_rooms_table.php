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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự tăng
            $table->string('name'); // Tên phòng, ví dụ: "Phòng A101"
            $table->unsignedBigInteger('room_type_id'); // FK tới bảng room_types
            $table->unsignedInteger('floor')->nullable(); // Tầng, có thể để trống
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available'); // Trạng thái phòng
            $table->timestamps(); // created_at và updated_at
            $table->softDeletes(); // deleted_at (xóa mềm)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
