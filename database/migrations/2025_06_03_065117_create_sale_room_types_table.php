<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sale_room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->decimal('value', 10, 2); 
            $table->enum('type', ['percent', 'fixed']); 
            $table->foreignId('room_type_id')->constrained()->onDelete('cascade'); 
            $table->dateTime('start_date')->nullable(); // 
            $table->dateTime('end_date')->nullable(); // 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::table('sale_room_types', function (Blueprint $table) {
            $table->dropForeign(['room_type_id']);
        });

        Schema::dropIfExists('sale_room_types');
    }
};