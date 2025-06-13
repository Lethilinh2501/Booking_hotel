<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicePlus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'is_active'];

    public function bookingServicePluses()
    {
        return $this->hasMany(BookingServicePlus::class);
    }
}
