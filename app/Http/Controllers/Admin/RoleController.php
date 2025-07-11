<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    // Danh sách role
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    // Form tạo role mới
    public function create()
    {
        return view('admin.roles.create');
    }

    // Lưu role mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|max:255',
        ]);

        Role::create($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Tạo role thành công!');
    }

    // Xem chi tiết role
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    // Form chỉnh sửa role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

   public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('roles', 'name')->ignore($id),
        ],
        'guard_name' => 'required|string|max:255',
    ]);

    $role = Role::findOrFail($id);
    $role->update($validated);

    return redirect()->route('admin.roles.index')->with('success', 'Cập nhật role thành công!');
}

    // Xóa role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Xóa role thành công!');
    }
}
