<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeService extends Model
{
    use HasFactory;

    protected $fillable = ['room_type_id', 'service_id', 'price'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookingRoomTypeServices()
    {
        return $this->hasMany(BookingRoomTypeService::class);
    }
}
