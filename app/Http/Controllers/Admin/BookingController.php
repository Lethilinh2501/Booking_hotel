<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Models\ServicePlus;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Đơn đặt phòng mới nhất';

        // Khởi tạo query
        $query = Booking::with('user', 'rooms', 'refund', 'refund.refundPolicy')->latest();

        // Lọc theo khoảng thời gian
        if ($request->has('start_date') && $request->has('end_date') && $request->input('start_date') && $request->input('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00';
            $endDate = $request->input('end_date') . ' 23:59:59';
            if ($startDate) {
                $query->where('check_in', '>=', $startDate);
            }
            if ($endDate) {
                $query->where('check_out', '<=', $endDate);
            }
        }

        // Lọc theo trạng thái
        if ($request->has('status') && $request->input('status') !== null) {
            $query->where('status', $request->input('status'));
        }

        // Phân trang
        $bookings = $query->paginate(10);

        // Truyền dữ liệu lọc để hiển thị lại trên giao diện
        $filterData = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
        ];

        return view('admin.bookings.index', compact('bookings', 'title', 'filterData'));
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
        $booking = Booking::with([
            'user',
            'rooms.roomType' => function ($query) {
                $query->with(['amenities', 'rulesAndRegulations', 'services']);
            },
            'rooms' => function ($query) {
                $query->withTrashed();
            },
            'servicePlus',
            'payments',
            'guests',
        ])->findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['booking' => $booking]);
        }

        $title = 'Chi tiết đơn đặt phòng';
        $availableServicePlus = ServicePlus::where('is_active', 1)->get();
        return view('admin.bookings.detail', compact('title', 'booking', 'availableServicePlus'));
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
