<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    // Hiển thị danh sách tiện nghi
    public function index()
    {
        $amenities = Amenity::orderBy('id', 'desc')->paginate(10);
        return view('admin.amenities.index', compact('amenities'));
    }

    // Hiển thị form thêm tiện nghi mới
    public function create()
    {
        return view('admin.amenities.create');
    }

    // Lưu tiện nghi mới vào DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:amenities,name',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Ô tên tiện nghi không được để trống.',
            'name.unique' => 'Tên tiện nghi đã tồn tại rồi!',
            'is_active.required' => 'Vui lòng chọn trạng thái hiển thị.',
        ]);

        Amenity::create($request->all());

        return redirect()->route('admin.amenities.index')->with('success', 'Thêm tiện nghi thành công!');
    }

    // Hiển thị form sửa tiện nghi
    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('admin.amenities.edit', compact('amenity'));
    }

    // Cập nhật tiện nghi
    public function update(Request $request, $id)
    {
        $amenity = Amenity::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:amenities,name,' . $amenity->id,
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Ô tên tiện nghi không được để trống.',
            'name.unique' => 'Tên tiện nghi đã tồn tại rồi!',
            'is_active.required' => 'Vui lòng chọn trạng thái hiển thị.',
        ]);

        $amenity->update($request->all());

        return redirect()->route('admin.amenities.index')->with('success', 'Cập nhật tiện nghi thành công!');
    }

    // Xoá tiện nghi
    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();

        return redirect()->route('admin.amenities.index')->with('success', 'Xoá tiện nghi thành công!');
    }
}
