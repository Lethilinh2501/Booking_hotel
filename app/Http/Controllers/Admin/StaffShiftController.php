<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffShift;
use Illuminate\Http\Request;

class StaffShiftController extends Controller
{
    public function index()
    {
        $staff_shifts = StaffShift::with('staff')->get();
        return view('admin.staff_shifts.index', compact('staff_shifts'));
    }

    public function create()
    {
        $staffs = Staff::all();
        return view('admin.staff_shifts.create', compact('staffs'));
    }

    // Xử lý lưu dữ liệu
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
        ], [
            'name.required'        => 'Vui lòng nhập tên ca.',
            'name.max'             => 'Tên ca không được vượt quá 255 ký tự.',
            'start_time.required'  => 'Vui lòng nhập giờ bắt đầu.',
            'start_time.date_format' => 'Giờ bắt đầu không đúng định dạng (HH:mm).',
            'end_time.required'    => 'Vui lòng nhập giờ kết thúc.',
            'end_time.date_format' => 'Giờ kết thúc không đúng định dạng (HH:mm).',
            'end_time.after'       => 'Giờ kết thúc phải sau giờ bắt đầu.',
        ]);

        StaffShift::create($validated);
        return redirect()->route('admin.staff_shifts.index')->with('message', 'Thêm ca làm việc thành công!');
    }

    public function edit($id)
    {
        $shift = StaffShift::findOrFail($id);
        return view('admin.staff_shifts.edit', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
        ], [
            'name.required'       => 'Vui lòng nhập tên ca.',
            'start_time.required' => 'Vui lòng chọn giờ bắt đầu.',
            'start_time.date_format' => 'Giờ bắt đầu phải đúng định dạng 24h (HH:mm).',
            'end_time.required'   => 'Vui lòng chọn giờ kết thúc.',
            'end_time.date_format' => 'Giờ kết thúc phải đúng định dạng 24h (HH:mm).',
            'end_time.after'      => 'Giờ kết thúc phải sau giờ bắt đầu.',
        ]);

        $shift = StaffShift::findOrFail($id);
        $shift->update($validated);

        return redirect()->route('admin.staff_shifts.index')->with('message', 'Cập nhật ca làm việc thành công!');
    }

    public function destroy(Request $request)
    {
        $shift = StaffShift::findOrFail($request->id);
        $shift->delete();
        return redirect()->route('admin.staff_shifts.index')->with('message', 'Đã xóa ca làm việc thành công!');
    }
}
