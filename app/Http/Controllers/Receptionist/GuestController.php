<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function listGuest()
    {
        $listGuest = Guest::paginate(7);
        return view('receptionist.guests.list-guest', compact('listGuest'));
    }
}
