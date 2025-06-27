<?php

namespace App\Http\Controllers\Admin;

use App\Models\SaleRoomType;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRoomTypeRequest; 
use Carbon\Carbon;

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

    public function store(SaleRoomTypeRequest $request) 
    {
        SaleRoomType::create($request->validated());

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
        \Log::info('Edit SaleRoomType Status:', ['id' => $id, 'status' => $saleRoomType->status]);
        
        $roomTypes = RoomType::all();
        return view('admin.sale_room_types.edit', compact('saleRoomType', 'roomTypes'));
    }

    public function update(SaleRoomTypeRequest $request, $id)
    {
        $saleRoomType = SaleRoomType::findOrFail($id);
        
        $data = $request->validated();
        $data['type'] = $data['type'] === 'percent' ? 'percent' : 'fixed';
        
        $saleRoomType->update($data);

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
        $newStatus = $saleRoomType->status === 'active' ? 'inactive' : 'active';
        
        $saleRoomType->update(['status' => $newStatus]);

        return redirect()->back()
            ->with('success', 'Trạng thái đã được cập nhật thành công');
    }
}