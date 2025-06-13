<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Migration: create_abouts_table.php
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('about');
            $table->boolean('is_use')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
