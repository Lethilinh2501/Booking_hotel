<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingRoomTypeService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['booking_id', 'room_type_service_id', 'quantity', 'price'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function roomTypeService()
    {
        return $this->belongsTo(RoomTypeService::class);
    }
}
