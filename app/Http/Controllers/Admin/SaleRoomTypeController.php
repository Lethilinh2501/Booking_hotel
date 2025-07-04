<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\SaleRoomType;
use Illuminate\Http\Request;

class SaleRoomTypeController extends Controller
{
    public function index()
    {
        $sales = SaleRoomType::with('roomType')->latest()->get();
        return view('admin.sale_room_types.index', compact('sales'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.sale_room_types.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'value'        => 'required|numeric|min:0',
            'type'         => 'required|in:percent,fixed',
            'room_type_id' => 'required|exists:room_types,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'status'       => 'required|in:active,inactive',
        ], [
            'name.required'           => 'Vui lòng nhập tên chương trình.',
            'value.required'          => 'Vui lòng nhập giá trị khuyến mãi.',
            'value.numeric'           => 'Giá trị phải là số.',
            'value.min'               => 'Giá trị không được âm.',
            'type.required'           => 'Vui lòng chọn loại giảm giá.',
            'type.in'                 => 'Loại giảm giá không hợp lệ.',
            'room_type_id.required'   => 'Vui lòng chọn loại phòng.',
            'room_type_id.exists'     => 'Loại phòng không hợp lệ.',
            'start_date.required'     => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date'         => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required'       => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date'           => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
            'status.required'         => 'Vui lòng chọn trạng thái.',
            'status.in'               => 'Trạng thái không hợp lệ.',
        ]);

        SaleRoomType::create($validated);

        return redirect()->route('admin.sale_room_types.index')->with('message', 'Thêm khuyến mãi thành công!');
    }

    public function show($id)
    {
        $sale = SaleRoomType::with('roomType')->findOrFail($id);
        return view('admin.sale_room_types.show', compact('sale'));
    }

    // SaleRoomTypeController.php

    public function edit($id)
    {
        $sale = SaleRoomType::findOrFail($id);
        $roomTypes = RoomType::all();
        return view('admin.sale_room_types.edit', compact('sale', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $sale = SaleRoomType::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'value'        => 'required|numeric|min:0',
            'type'         => 'required|in:percent,fixed',
            'room_type_id' => 'required|exists:room_types,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'status'       => 'required|in:active,inactive',
        ], [
            'name.required' => 'Vui lòng nhập tên chương trình.',
            'value.required' => 'Vui lòng nhập giá trị khuyến mãi.',
            'value.numeric' => 'Giá trị phải là số.',
            'value.min' => 'Giá trị không được âm.',
            'type.required' => 'Vui lòng chọn loại giảm giá.',
            'type.in' => 'Loại giảm giá không hợp lệ.',
            'room_type_id.required' => 'Vui lòng chọn loại phòng.',
            'room_type_id.exists' => 'Loại phòng không hợp lệ.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        $sale->update($validated);

        return redirect()->route('admin.sale_room_types.index')
            ->with('message', 'Cập nhật khuyến mãi thành công!');
    }

    public function destroy($id)
    {
        $sale = SaleRoomType::findOrFail($id);
        $sale->delete();

        return redirect()->route('admin.sale_room_types.index')
            ->with('message', 'Xóa khuyến mãi thành công!');
    }
}
