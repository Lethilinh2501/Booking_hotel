<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeImageController extends Controller
{
    public function index($roomTypeId)
    {
        $roomType = RoomType::with('roomTypeImages')->findOrFail($roomTypeId);
        return view('admin.roomtypes.images.index', compact('roomType'));
    }

    public function create($roomTypeId)
    {
        $roomType = RoomType::findOrFail($roomTypeId);
        return view('admin.roomtypes.images.create', compact('roomType'));
    }

    public function store(Request $request, $roomTypeId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_main' => 'nullable|boolean',
        ]);

        $roomType = RoomType::findOrFail($roomTypeId);

        if ($request->has('is_main') && $request->is_main) {
            RoomTypeImage::where('room_type_id', $roomType->id)->update(['is_main' => false]);
        }

        $path = $request->file('image')->store('uploads', 'public');

        RoomTypeImage::create([
            'room_type_id' => $roomType->id,
            'image' => $path,
            'is_main' => $request->has('is_main') ? 1 : 0,
        ]);

        return redirect()->route('admin.roomtypes.images.index', $roomType->id)->with('success', 'Thêm ảnh thành công.');
    }

    public function edit($roomTypeId, $imageId)
    {
        $roomType = RoomType::findOrFail($roomTypeId);
        $image = RoomTypeImage::findOrFail($imageId);
        return view('admin.roomtypes.images.edit', compact('roomType', 'image'));
    }

    public function update(Request $request, $roomTypeId, $imageId)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_main' => 'nullable|boolean',
        ]);

        $roomType = RoomType::findOrFail($roomTypeId);
        $image = RoomTypeImage::findOrFail($imageId);

        if ($request->has('is_main') && $request->is_main) {
            RoomTypeImage::where('room_type_id', $roomType->id)->update(['is_main' => false]);
        }

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $path = $request->file('image')->store('uploads', 'public');
            $image->image = $path;
        }

        $image->is_main = $request->has('is_main') ? 1 : 0;
        $image->save();

        return redirect()->route('admin.roomtypes.images.index', $roomType->id)->with('success', 'Cập nhật ảnh thành công.');
    }

    public function destroy($roomTypeId, $imageId)
    {
        $image = RoomTypeImage::findOrFail($imageId);
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();

        return redirect()->route('admin.roomtypes.images.index', $roomTypeId)->with('success', 'Xóa ảnh thành công.');
    }
}
