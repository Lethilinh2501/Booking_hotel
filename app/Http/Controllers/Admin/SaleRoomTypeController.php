<?php

namespace App\Http\Controllers\Admin;

use App\Models\SaleRoomType;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SaleRoomTypeController extends Controller
{
    public function index()
    {
        $saleRoomTypes = SaleRoomType::with('roomType')->latest()->paginate(10);
        return view('admin.sale_room_types.index', compact('saleRoomTypes'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.sale_room_types.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'room_type_id' => 'required|exists:room_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        SaleRoomType::create($request->all());

        return redirect()->route('admin.sale-room-types.index')
            ->with('success', 'Sale room type created successfully.');
    }

    public function show($id)
    {
        $saleRoomType = SaleRoomType::findOrFail($id);
        return view('admin.sale_room_types.show', compact('saleRoomType'));
    }

    public function edit($id)
    {
        $saleRoomType = SaleRoomType::findOrFail($id);
        $roomTypes = RoomType::all();
        return view('admin.sale_room_types.edit', compact('saleRoomType', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $saleRoomType = SaleRoomType::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'room_type_id' => 'required|exists:room_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $saleRoomType->update($request->all());

        return redirect()->route('admin.sale-room-types.index')
            ->with('success', 'Sale room type updated successfully.');
    }

    public function destroy($id)
    {
        $saleRoomType = SaleRoomType::findOrFail($id);
        $saleRoomType->delete();

        return redirect()->route('admin.sale-room-types.index')
            ->with('success', 'Sale room type deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $saleRoomType = SaleRoomType::findOrFail($id);
        $saleRoomType->update([
            'status' => !$saleRoomType->status
        ]);

        return redirect()->back()
            ->with('success', 'Status updated successfully.');
    }
}