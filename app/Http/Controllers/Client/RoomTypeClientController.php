<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RoomType;

class RoomTypeClientController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::where('is_active', 1)->get();
        return view('client.rooms.roomtype', compact('roomTypes'));
    }

public function showDetail($id)
    {
        $roomType = RoomType::where('is_active', 1)->findOrFail($id);
        $amenities = $roomType->amenities; // Giả sử RoomType có quan hệ với Amenity
        return view('client.rooms.roomdetail', compact('roomType', 'amenities'));
    }
}
