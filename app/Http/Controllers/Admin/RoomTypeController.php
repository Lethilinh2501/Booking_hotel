<?php

// app/Http/Controllers/Admin/RoomTypeController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::latest()->paginate(10);
        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room-types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',

        ]);

        RoomType::create($data);

        return redirect()->route('admin.room-types.index')->with('success', 'Thêm loại phòng thành công!');
    }

    public function show($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('admin.room-types.show', compact('roomType'));
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('admin.room-types.edit', compact('roomType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());

        return redirect()->route('admin.room-types.index')->with('success', 'Cập nhật loại phòng thành công.');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete(); // Xóa mềm
        return redirect()->route('admin.room-types.index')->with('success', 'Đã chuyển vào thùng rác!');
    }


    // Trash
    // public function trash()
    // {
    //     $roomTypes = RoomType::onlyTrashed()->paginate(10);
    //     return view('admin.room-types.trash', compact('roomTypes'));
    // }

    // public function restore($id)
    // {
    //     $roomType = RoomType::onlyTrashed()->findOrFail($id);
    //     $roomType->restore();
    //     return redirect()->route('admin.room-types.trash')->with('success', 'Khôi phục thành công.');
    // }

    // public function forceDelete($id)
    // {
    //     $roomType = RoomType::onlyTrashed()->findOrFail($id);
    //     $roomType->forceDelete();
    //     return redirect()->route('admin.room-types.trash')->with('success', 'Xóa vĩnh viễn thành công.');
    // }
}