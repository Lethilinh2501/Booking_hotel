<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::paginate(10);
        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenities.create');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'is_active' => 'boolean',
    ]);

    Amenity::create([
        'name' => $request->name,
        'description' => $request->description,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.amenities.index')->with('success', 'Thêm tiện nghi thành công!');
}




    public function edit($id)
{
    $amenity = Amenity::findOrFail($id);
    return view('admin.amenities.edit', compact('amenity'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean',
    ]);

    $amenity = Amenity::findOrFail($id);

    $amenity->name = $request->name;
    $amenity->description = $request->description;
    $amenity->is_active = $request->is_active;
    $amenity->save();

    return redirect()->route('admin.amenities.index')->with('success', 'Cập nhật tiện nghi thành công!');
}

   public function destroy($id)
{
    $amenity = Amenity::findOrFail($id);
    $amenity->delete();

    return redirect()->route('admin.amenities.index')->with('success', 'Xoá tiện nghi thành công!');
}

}
