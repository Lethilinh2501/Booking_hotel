<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status'
    ];

    public function parent()
    {
        return $this->belongsTo(NewsCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NewsCategory::class, 'parent_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id');
    }
}