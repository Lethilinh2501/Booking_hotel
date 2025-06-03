<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingServicePlus extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'service_plus_id', 'quantity'];

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function servicePlus() {
        return $this->belongsTo(ServicePlus::class);
    }
}
