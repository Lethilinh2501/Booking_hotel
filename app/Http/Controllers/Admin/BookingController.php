<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
   public function index(Request $request)
{
    $query = Booking::query()->with(['user', 'rooms']); // SỬA Ở ĐÂY

    if ($request->filled('start_date')) {
        $query->whereDate('check_in', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('check_out', '<=', $request->end_date);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $bookings = $query->latest()->paginate(10);

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
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:confirmed,paid,check_in,check_out,cancelled,refunded'
        ]);

        $booking = Booking::create($request->except('room_id'));

        // Gắn phòng vào booking (nếu dùng belongsToMany)
        $booking->rooms()->attach($request->room_id);

        return redirect()->route('admin.bookings.index')->with('success', 'Tạo đặt phòng thành công!');
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'rooms'])->findOrFail($id);
        return view('admin.bookings.detail', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::with('rooms')->findOrFail($id);
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
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:confirmed,paid,check_in,check_out,cancelled,refunded'
        ]);

        $booking->update($request->except('room_id'));

        // Đồng bộ lại phòng
        $booking->rooms()->sync([$request->room_id]);

        return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật đặt phòng thành công!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->rooms()->detach(); // gỡ quan hệ phòng trước khi xóa
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Xóa đặt phòng thành công!');
    }
}
