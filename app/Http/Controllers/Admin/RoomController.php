<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    // Xử lý lưu phòng
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_type_id' => 'required|exists:room_types,id',
            'floor' => 'required|integer|min:2',
            'status' => 'required|in:available,booked,maintenance',
        ], [
            'name.required' => 'Vui lòng nhập tên phòng',
            'room_type_id.required' => 'Vui lòng chọn loại phòng',
            'floor.required' => 'Vui lòng nhập số tầng',
            'floor.integer' => 'Tầng phải là một số nguyên',
            'floor.min' => 'Tầng không được nhỏ hơn 2',
            'status.required' => 'Vui lòng chọn trạng thái phòng',
        ]);


        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('message', 'Thêm phòng mới thành công!');
    }

    public function show($id)
    {
        $room = Room::with('roomType')->findOrFail($id);
        return view('admin.rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::where('is_active', 1)->get();

        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'room_type_id' => 'required|exists:room_types,id',
            'floor' => 'required|integer|min:2',
            'status' => 'required|in:available,booked,maintenance',
        ], [
            'name.required' => 'Vui lòng nhập tên phòng',
            'room_type_id.required' => 'Vui lòng chọn loại phòng',
            'floor.required' => 'Vui lòng nhập số tầng',
            'floor.integer' => 'Tầng phải là một số nguyên',
            'floor.min' => 'Tầng không được nhỏ hơn 2',
            'status.required' => 'Vui lòng chọn trạng thái phòng',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('message', 'Cập nhật phòng thành công!');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete(); // Xóa mềm
        return redirect()->route('admin.rooms.index')->with('message', 'Đã xóa phòng thành công!');
    }

    public function trash()
    {
    return 'Vào được trash';

        // $rooms = Room::onlyTrashed()->with('roomType')->paginate(10);
        // return view('admin.rooms.trash', compact('rooms'));
    }

    public function restore($id)
    {
        $room = Room::withTrashed()->findOrFail($id);
        $room->restore();

        return redirect()->route('admin.rooms.trash')->with('message', 'Khôi phục phòng thành công!');
    }

    public function forceDelete($id)
    {
        $room = Room::withTrashed()->findOrFail($id);
        $room->forceDelete();

        return redirect()->route('admin.rooms.trash')->with('message', 'Xoá vĩnh viễn phòng thành công!');
    }
}
