<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category_id',
        'author_id',
        'published_at',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',  // <-- quan trọng
        'is_featured' => 'boolean',
    ];

    // Tạo slug tự động khi tạo/sửa bài viết
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    // Sử dụng slug thay vì id trong route
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Quan hệ với danh mục bài viết (post_categories)
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    // Quan hệ với tác giả (users)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
