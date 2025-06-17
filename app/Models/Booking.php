<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_code',
        'check_in',
        'check_out',
        'actual_check_in',
        'actual_check_out',
        'total_price',
        'discount_amount',
        'base_price',
        'service_total',
        'tax_fee',
        'total_guests',
        'children_count',
        'room_quantity',
        'status',
        'user_id',
        'special_request',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookingGuests()
    {
        return $this->hasMany(BookingGuest::class);
    }

    public function bookingPromotions()
    {
        return $this->hasMany(BookingPromotion::class);
    }

    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class);
    }

    public function roomTypeServices()
    {
        return $this->hasMany(BookingRoomTypeService::class);
    }

    public function servicePluses()
    {
        return $this->hasMany(BookingServicePlus::class);
    }
}
