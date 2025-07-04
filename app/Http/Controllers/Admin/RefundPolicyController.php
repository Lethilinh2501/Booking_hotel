<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefundPolicy;
use Illuminate\Http\Request;

class RefundPolicyController extends Controller
{
    // Danh sách chính sách
    public function index()
    {
        $policies = RefundPolicy::paginate(10);
        return view('admin.refund-policies.index', compact('policies'));
    }

    // Form tạo mới
    public function create()
    {
        return view('admin.refund-policies.create');
    }

    // Lưu chính sách mới
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        RefundPolicy::create($request->all());

        return redirect()->route('admin.refund-policies.index')->with('success', 'Thêm chính sách thành công!');
    }

    // Xem chi tiết
    public function show($id)
    {
        $policy = RefundPolicy::findOrFail($id);
        return view('admin.refund-policies.show', compact('policy'));
    }

    // Form sửa
    public function edit($id)
    {
        $policy = RefundPolicy::findOrFail($id);
        return view('admin.refund-policies.edit', compact('policy'));
    }

    // Cập nhật chính sách
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $policy = RefundPolicy::findOrFail($id);
        $policy->update($request->all());

        return redirect()->route('admin.refund-policies.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa chính sách
    public function destroy($id)
    {
        $policy = RefundPolicy::findOrFail($id);
        $policy->delete();

        return redirect()->route('admin.refund-policies.index')->with('success', 'Xóa thành công!');
    }
}
