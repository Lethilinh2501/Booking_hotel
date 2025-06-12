<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'contacts'; // Sử dụng bảng contacts hiện có

    protected $fillable = [
        'title', // sẽ dùng làm tên danh mục
        'content', // sẽ dùng làm mô tả
        'status'
    ];

    // Chuyển đổi tên trường cho phù hợp

    public function getNameAttribute()
    {
        return $this->attributes['title'];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['title'] = $value;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['content'];
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['content'] = $value;
    }

    // Scope để lấy danh mục active
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}