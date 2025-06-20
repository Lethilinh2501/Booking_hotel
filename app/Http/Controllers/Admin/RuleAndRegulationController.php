<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RuleAndRegulation;
use Illuminate\Http\Request;

class RuleAndRegulationController extends Controller
{
    public function index()
    {
        $rules = RuleAndRegulation::all();
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        return view('admin.rules.create');
    }

    public function store(Request $request)
    {
        RuleAndRegulation::create($request->all());
        return redirect()->route('admin.rules.index')->with('success', 'Thêm quy định thành công!');
    }

    public function edit($id)
    {
        $rule = RuleAndRegulation::findOrFail($id);
        return view('admin.rules.edit', compact('rule'));
    }

    public function update(Request $request, $id)
    {
        $rule = RuleAndRegulation::findOrFail($id);
        $rule->update($request->all());
        return redirect()->route('admin.rules.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        RuleAndRegulation::destroy($id);
        return redirect()->route('admin.rules.index')->with('success', 'Xóa thành công!');
    }
}
