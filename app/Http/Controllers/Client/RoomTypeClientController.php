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


}
