<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'full_name', 'phone', 'email', 'address'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bookings() {
        return $this->belongsToMany(Booking::class, 'booking_guest');
    }
}
