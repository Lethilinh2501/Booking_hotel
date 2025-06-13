<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::paginate(5);
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        return view('admin.rules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'required|boolean'
        ]);

        Rule::create($request->all());
        return redirect()->route('admin.rules.index')->with('success', 'Thêm nội quy thành công!');
    }

    public function edit($id)
    {
        $rule = Rule::findOrFail($id);
        return view('admin.rules.edit', compact('rule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_active' => 'required|boolean'
        ]);

        $rule = Rule::findOrFail($id);
        $rule->update($request->all());
        return redirect()->route('admin.rules.index')->with('success', 'Cập nhật nội quy thành công!');
    }

    public function destroy($id)
    {
        Rule::findOrFail($id)->delete();
        return redirect()->route('admin.rules.index')->with('success', 'Xoá nội quy thành công!');
    }
}


