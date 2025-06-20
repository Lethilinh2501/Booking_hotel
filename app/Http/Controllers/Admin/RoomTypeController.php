<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    // Hiển thị danh sách room type
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('admin.room_types.index', compact('roomTypes'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('admin.room_types.create');
    }

    // Xử lý lưu room type mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer|min:1'
        ]);

        RoomType::create($request->all());

        return redirect()->route('admin.roomtypes.index')->with('success', 'Thêm loại phòng thành công!');
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('admin.room_types.edit', compact('roomType'));
    }

    // Cập nhật room type
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer|min:1'
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());

        return redirect()->route('admin.roomtypes.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa room type
    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return redirect()->route('admin.roomtypes.index')->with('success', 'Xóa thành công!');
    }
}
