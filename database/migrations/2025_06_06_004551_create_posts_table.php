<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // mô tả ngắn
            $table->longText('content');
            $table->string('image')->nullable(); // đường dẫn ảnh đại diện
            $table->foreignId('category_id')->constrained('post_categories')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // chỉ Admin mới tạo
            $table->timestamp('published_at')->nullable(); // ngày đăng
            $table->boolean('is_featured')->default(false); // bài nổi bật
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
            $table->softDeletes(); // thêm cột deleted_at để soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
