<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Refund;

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
        'guest_id',
        'special_request',
        'service_plus_status', // Thêm trường này
        'paid_amount',
        'service_plus_total'

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

    // public function servicePluses()
    // {
    //     return $this->hasMany(BookingServicePlus::class);
    // }
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'booking_rooms', 'booking_id', 'room_id');
    }
    public function guests()
    {
        return $this->hasMany(BookingGuest::class);
    }
        public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id');
  
    public function refund()
    {
        return $this->hasOne(Refund::class);
    }
    public function servicePlus()
    {
        return $this->belongsToMany(ServicePlus::class, 'booking_service_plus', 'booking_id', 'service_plus_id')
            ->withTimestamps(); // nếu bảng trung gian có cột created_at, updated_at
    }
}
