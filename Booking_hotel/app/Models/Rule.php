<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rules'; // Nếu tên bảng là 'rules'

    protected $fillable = [
        'title',
        'content',
        'is_active',
    ];
}

