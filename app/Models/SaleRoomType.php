<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleRoomType extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'value',
    'type',
    'room_type_id',
    'start_date',
    'end_date',
    'status',
];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
