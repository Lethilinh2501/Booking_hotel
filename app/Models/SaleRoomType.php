<?php
// app/Models/SaleRoomType.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class SaleRoomType extends Model
{
    // use SoftDeletes;

    protected $table = 'sale_room_types';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'value',
        'type',
        'room_type_id',
        'start_date',
        'end_date',
        'status',
    ];

    // protected $dates = [
    //     'start_date',
    //     'end_date',
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    protected $casts = [
        'status' => 'boolean', // active = true, inactive = false
    ];

    // Constants for status
    const STATUS_ACTIVE = true;
    const STATUS_INACTIVE = false;

    // Relationships
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    public function scopeCurrent($query)
    {
        $now = now()->format('Y-m-d');
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }
}