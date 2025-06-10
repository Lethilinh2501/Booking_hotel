<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function listStaff()
    {
        $listStaff = Staff::with(['role'])
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view('admin.staffs.list-staff')
            ->with(['listStaff' => $listStaff]);
    }

    public function addStaff()
    {
        $listRole = Role::all();
        return view('admin.staffs.add-staff')
            ->with('listRole', $listRole);
    }

    public function addPostStaff(Request $req)
    {
        $validated = $req->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:staffs,email',
            'phone'    => 'required|string|max:20',
            'role_id'  => 'required|exists:roles,id',
        ], [
            'name.required'     => 'Vui lòng nhập tên nhân viên.',
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không hợp lệ.',
            'email.unique'      => 'Email đã tồn tại.',
            'phone.required'    => 'Vui lòng nhập số điện thoại.',
            'role_id.required'  => 'Vui lòng chọn chức vụ.',
            'role_id.exists'    => 'Chức vụ không hợp lệ.',
        ]);

        Staff::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'],
            'role_id'   => $validated['role_id'],
            'is_active' => $req->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.staff.listStaff')->with([
            'message' => 'Thêm mới nhân viên thành công!'
        ]);
    }

    public function detailStaff($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staffs.detail-staff', compact('staff'));
    }

    public function deleteStaff(Request $request)
    {
        $id = $request->input('id');
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('admin.staffs.listStaff')->with('message', 'Xóa nhân viên thành công!');
    }

    // Hiển thị form cập nhật
    public function updateStaff($idStaff)
    {
        $staff = Staff::findOrFail($idStaff);
        $roles = Role::all(); // Nếu có phân vai trò
        return view('admin.staffs.update-staff', compact('staff', 'roles'));
    }

    // Xử lý form cập nhật
    public function updatePatchStaff(Request $request, $idStaff)
    {
        $staff = Staff::findOrFail($idStaff);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email,' . $idStaff,
            'phone' => 'required|string|max:20',
            'role_id' => 'nullable|exists:roles,id',
            'is_active' => 'nullable|boolean',
        ]);

        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.staffs.listStaff')->with('message', 'Cập nhật nhân viên thành công!');
    }
}
