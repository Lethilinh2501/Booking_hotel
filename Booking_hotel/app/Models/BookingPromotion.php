<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingPromotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['booking_id', 'promotion_id'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
