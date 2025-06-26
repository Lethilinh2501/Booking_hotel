<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    // Hiển thị danh sách loại phòng
    public function index()
    {
        $roomTypes = RoomType::with('roomTypeImages')->get();
        return view('admin.roomtypes.index', compact('roomTypes'));
    }

    // Form thêm loại phòng
    public function create()
    {
        return view('admin.roomtypes.create');
    }

    // Lưu loại phòng mới
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric',
            'max_capacity' => 'required|numeric',
            'is_active'    => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $roomType = RoomType::create($request->only('name', 'price', 'max_capacity', 'is_active'));

        // Ảnh đại diện
        if ($request->hasFile('image')) {
            $filename = $this->uploadImage($request->file('image'), 'uploads/roomtypes');
            $roomType->roomTypeImages()->create([
                'image'   => $filename,
                'is_main' => 1
            ]);
        }

        // Ảnh gallery
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $filename = $this->uploadImage($img, 'uploads/roomtypes/gallery');
                $roomType->roomTypeImages()->create([
                    'image'   => $filename,
                    'is_main' => 0
                ]);
            }
        }

        return redirect()->route('admin.roomtypes.index')->with('success', 'Thêm loại phòng thành công!');
    }

    // Chi tiết loại phòng
    public function show($id)
    {
        $roomType = RoomType::with('roomTypeImages')->findOrFail($id);
        return view('admin.roomtypes.show', compact('roomType'));
    }

    // Form sửa loại phòng
    public function edit($id)
    {
        $roomType = RoomType::with('roomTypeImages')->findOrFail($id);
        return view('admin.roomtypes.edit', compact('roomType'));
    }

    // Cập nhật loại phòng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric',
            'max_capacity' => 'required|numeric',
            'is_active'    => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->only('name', 'price', 'max_capacity', 'is_active'));

        // Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh đại diện cũ
            $roomType->roomTypeImages()->where('is_main', 1)->delete();

            $filename = $this->uploadImage($request->file('image'), 'uploads/roomtypes');
            $roomType->roomTypeImages()->create([
                'image'   => $filename,
                'is_main' => 1
            ]);
        }

        // Thêm ảnh gallery nếu có
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $filename = $this->uploadImage($img, 'uploads/roomtypes/gallery');
                $roomType->roomTypeImages()->create([
                    'image'   => $filename,
                    'is_main' => 0
                ]);
            }
        }

        return redirect()->route('admin.roomtypes.index')->with('success', 'Cập nhật loại phòng thành công!');
    }

    // Xoá loại phòng
    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);

        // Xóa ảnh liên quan
        $roomType->roomTypeImages()->delete();

        // Xóa loại phòng
        $roomType->delete();

        return back()->with('success', 'Đã xóa loại phòng!');
    }

    // Xử lý upload ảnh
    private function uploadImage($file, $path)
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $filename);
        return $path . '/' . $filename;
    }
}
