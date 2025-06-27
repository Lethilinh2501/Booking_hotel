<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('max_capacity');
            $table->float('size')->nullable();
            $table->enum('bed_type', ['single', 'double', 'queen', 'king', 'bunk', 'sofa'])->default('double');
            $table->integer('children_free_limit')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
