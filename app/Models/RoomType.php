<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name',
    'description',
    'price',
    'capacity',
  ];

  public function rooms()
  {
    return $this->hasMany(Room::class);
  }

  public function roomTypeServices()
  {
    return $this->hasMany(RoomTypeService::class);
  }
}