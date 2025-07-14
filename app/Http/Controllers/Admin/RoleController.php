<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission_groups = Permission::get()->groupBy('guard_name');
        return view('admin.roles.create', compact('permission_groups'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => $data['guard_name'] ?? 'web',
            ]);

            if (!empty($data['permissions'])) {
                $role->syncPermissions($data['permissions']);
            }

            return redirect()->route('admin.roles.index')->with('success', 'Tạo mới thành công');
        } catch (\Throwable $th) {
            return back()->with('error', 'Lỗi: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permission_groups = Permission::get()->groupBy('guard_name');

        return view('admin.roles.edit', compact('role', 'permission_groups'));
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
            'permissions' => ['nullable', 'array'],
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $validated['name'],
        ]);

        // Gán lại quyền (nếu có)
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Cập nhật vai trò thành công!');
    }


    public function destroy(string $id)
    {
        $role = Role::withCount('users')->findOrFail($id);

        $protectedRoles = ['super admin', 'admin', 'lễ tân', 'customer'];

        if (in_array(strtolower($role->name), $protectedRoles)) {
            return back()->with('error', "Không thể xóa vai trò đặc biệt: {$role->name}");
        }

        if ($role->users_count > 0) {
            return back()->with('error', 'Không thể xóa vai trò vì đã có người dùng');
        }

        $role->delete();

        return back()->with('success', 'Xóa vai trò thành công');
    }
}
