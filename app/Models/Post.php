<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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
