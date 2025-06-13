<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeRar extends Model
{
    use HasFactory;

    protected $fillable = ['room_type_id', 'requirement'];

    public function roomType() {
        return $this->belongsTo(RoomType::class);
    }
}