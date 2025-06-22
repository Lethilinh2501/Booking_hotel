<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $rooms = Room::all();
        return view('admin.bookings.create', compact('users', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        Booking::create($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Tạo đặt phòng thành công!');
    }

    public function show($id)
{
    $booking = Booking::with('user')->findOrFail($id);
    return view('admin.bookings.detail', compact('booking'));
}


    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $rooms = Room::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật đặt phòng thành công!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Xoá đặt phòng thành công!');
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,confirmed,canceled,completed'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
