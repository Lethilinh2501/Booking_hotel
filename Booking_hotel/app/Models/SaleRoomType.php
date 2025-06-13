<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleRoomType extends Model
{
    use HasFactory;

    protected $fillable = ['room_type_id', 'sale_price', 'start_date', 'end_date'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
