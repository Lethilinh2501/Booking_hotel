<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index()
    {
        $title = 'Tài khoản quản trị viên';
        $admin_account = User::role('admin')->get();
        return view('admin.admin_account.index', compact('admin_account', 'title'));
    }

    public function edit(User $admin, $id)
    {
        $title = 'Chỉnh sửa tài khoản quản trị viên';
        $admin = User::role('admin', 'web')->where('id', $id)->first();
        return view('admin.admin_account.edit', compact('admin', 'title'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::role('admin', 'web')->where('id', $id)->first();
        $admin->update([
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.admin_accounts.index')
            ->with('success', 'Cập nhật trạng thái thành công.');
    }
}
