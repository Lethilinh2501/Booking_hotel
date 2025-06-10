<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'avatar',
        'address',
        'id_number',
        'id_photo',
        'birth_date',
        'country',
        'gender',
        'email',
        'password',
        'is_active',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Quan hệ ví dụ:
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function guest()
    {
        return $this->hasOne(Guest::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
