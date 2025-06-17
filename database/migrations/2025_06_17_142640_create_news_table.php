<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
          $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('content');
        $table->string('image')->nullable();
        $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
        $table->boolean('is_featured')->default(false);

        // Khóa ngoại liên kết với bảng news_categories
        $table->foreignId('news_category_id')->constrained('news_categories')->onDelete('cascade');

        $table->timestamp('published_at')->nullable();
        $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
};