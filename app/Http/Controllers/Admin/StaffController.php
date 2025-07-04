<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffRole;
use App\Models\StaffShift;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function listStaff()
    {
        $listStaff = Staff::with(['role', 'user', 'shift'])
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view('admin.staffs.list-staff')
            ->with(['listStaff' => $listStaff]);
    }

    public function addStaff()
    {
        $listRole = StaffRole::all();
        $listShift = StaffShift::all();
        return view('admin.staffs.add-staff', compact('listRole', 'listShift'));
    }

    public function addPostStaff(Request $req)
    {
        $validated = $req->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
            'role_id'  => 'required|exists:staff_roles,id',
            'shift_id' => 'required|exists:staff_shifts,id',
        ], [
            'name.required'     => 'Vui lòng nhập tên nhân viên.',
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không hợp lệ.',
            'email.unique'      => 'Email đã tồn tại.',
            'phone.required'    => 'Vui lòng nhập số điện thoại.',
            'address.required'  => 'Vui lòng nhập địa chỉ.',
            'role_id.required'  => 'Vui lòng chọn chức vụ.',
            'role_id.exists'    => 'Chức vụ không hợp lệ.',
            'shift_id.required' => 'Vui lòng chọn ca làm việc.',
            'shift_id.exists'   => 'Ca làm việc không hợp lệ.',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'address'  => $validated['address'],
            'password' => bcrypt('123456'), // mật khẩu mặc định
        ]);

        Staff::create([
            'user_id'  => $user->id,
            'role_id'  => $validated['role_id'],
            'shift_id' => $validated['shift_id'],
            'status'   => $req->has('is_active') ? 'active' : 'inactive',
            'notes'    => null,
        ]);

        return redirect()->route('admin.staffs.listStaff')->with('message', 'Thêm mới nhân viên thành công!');
    }

    public function detailStaff($id)
    {
        $staff = Staff::findOrFail($id);
        $users  = User::all();
        $roles  = StaffRole::all();
        $shifts = $staff->shift;

        return view('admin.staffs.detail-Staff', compact(['staff', 'users', 'roles', 'shifts']));
    }

    public function deleteStaff(Request $request)
    {
        $id = $request->input('id');
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.staffs.listStaff')->with('message', 'Xóa nhân viên thành công!');
    }

    // Hiển thị form cập nhật
    public function updateStaff($id)
    {
        $staff = Staff::with('user')->findOrFail($id);
        $listRole = StaffRole::all();
        $listShift = StaffShift::all();
        return view('admin.staffs.update-staff', compact('staff', 'listRole', 'listShift'));
    }

    // Xử lý form cập nhật
    public function updatePatchStaff(Request $request, $id)
    {
        $staff = Staff::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $staff->user->id,
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
            'role_id'  => 'required|exists:staff_roles,id',
            'shift_id' => 'required|exists:staff_shifts,id',
        ], [
            'name.required'     => 'Vui lòng nhập tên nhân viên.',
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không hợp lệ.',
            'email.unique'      => 'Email đã tồn tại.',
            'phone.required'    => 'Vui lòng nhập số điện thoại.',
            'address.required'  => 'Vui lòng nhập địa chỉ.',
            'role_id.required'  => 'Vui lòng chọn chức vụ.',
            'role_id.exists'    => 'Chức vụ không hợp lệ.',
            'shift_id.required' => 'Vui lòng chọn ca làm việc.',
            'shift_id.exists'   => 'Ca làm không hợp lệ.',
        ]);

        // Update bảng users
        $staff->user->update([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // Update bảng staffs
        $staff->update([
            'role_id'  => $validated['role_id'],
            'shift_id' => $validated['shift_id'],
            'status'   => $request->has('is_active') ? 'active' : 'inactive',
            'notes'    => $request->notes,
        ]);

        return redirect()->route('admin.staffs.listStaff')->with('message', 'Cập nhật nhân viên thành công!');
    }
}
