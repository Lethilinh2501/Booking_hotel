<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::paginate(10);
        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.policies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        Policy::create($request->all());

        return redirect()->route('admin.policies.index')->with('success', 'Thêm chính sách thành công!');
    }

    public function edit($id)
    {
        $policy = Policy::findOrFail($id);
        return view('admin.policies.edit', compact('policy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $policy = Policy::findOrFail($id);
        $policy->update($request->all());

        return redirect()->route('admin.policies.index')->with('success', 'Cập nhật chính sách thành công!');
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect()->route('admin.policies.index')->with('success', 'Xoá chính sách thành công!');
    }
}
