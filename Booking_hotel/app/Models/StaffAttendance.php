<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'date', 'status'];

    public function staffs()
    {
        return $this->belongsTo(Staff::class);
    }
}
