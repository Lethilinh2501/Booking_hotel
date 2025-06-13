<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    protected $table = 'staffs';

    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'role_id', 'is_active'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function attendances()
    {
        return $this->hasMany(StaffAttendance::class);
    }

    public function shifts()
    {
        return $this->belongsToMany(StaffShift::class, 'staff_shifts_staff');
    }
}
