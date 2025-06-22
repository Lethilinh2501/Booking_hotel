<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class SaleRoomType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name',
        'value',
        'type',
        'room_type_id',
        'start_date',
        'end_date',
        'status',];

    protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
    'status' => 'string',
];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
