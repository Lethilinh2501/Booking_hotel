<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
        'is_featured',
        'news_category_id',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Mối quan hệ: Một tin tức thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}