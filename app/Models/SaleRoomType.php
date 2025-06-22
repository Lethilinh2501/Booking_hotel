<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleRoomType extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'boolean',
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