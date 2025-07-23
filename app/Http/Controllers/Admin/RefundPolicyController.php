<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefundPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefundPolicyController extends Controller
{
    public function index()
    {
        $policies = RefundPolicy::paginate(10);
        return view('admin.refund-policies.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.refund-policies.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'penalty_percent' => 'required|integer|min:0|max:100',
            'days_before_checkin' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Tiêu đề không được để trống.',
            'name.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'penalty_percent.required' => 'Vui lòng nhập phí phạt.',
            'penalty_percent.integer' => 'Phí phạt phải là số nguyên.',
            'penalty_percent.min' => 'Phí phạt không được nhỏ hơn :min%.',
            'penalty_percent.max' => 'Phí phạt không được vượt quá :max%.',
            'days_before_checkin.required' => 'Vui lòng nhập số ngày trước check-in.',
            'days_before_checkin.integer' => 'Số ngày phải là số nguyên.',
            'days_before_checkin.min' => 'Số ngày không được nhỏ hơn :min.',
            'is_active.required' => 'Vui lòng chọn trạng thái.',
            'is_active.boolean' => 'Trạng thái không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        RefundPolicy::create($request->only([
            'name',
            'content',
            'penalty_percent',
            'days_before_checkin',
            'is_active'
        ]));

        return redirect()->route('admin.refund-policies.index')->with('success', 'Thêm chính sách thành công.');
    }

    public function show($id)
    {
        $policy = RefundPolicy::findOrFail($id);
        return view('admin.refund-policies.show', compact('policy'));
    }

    public function edit($id)
    {
        $policy = RefundPolicy::findOrFail($id);
        return view('admin.refund-policies.edit', compact('policy'));
    }

    public function update(Request $request, RefundPolicy $refundPolicy)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'penalty_percent' => 'required|integer|min:0|max:100',
            'days_before_checkin' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Tiêu đề không được để trống.',
            'name.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'penalty_percent.required' => 'Vui lòng nhập phí phạt.',
            'penalty_percent.integer' => 'Phí phạt phải là số nguyên.',
            'penalty_percent.min' => 'Phí phạt không được nhỏ hơn :min%.',
            'penalty_percent.max' => 'Phí phạt không được vượt quá :max%.',
            'days_before_checkin.required' => 'Vui lòng nhập số ngày trước check-in.',
            'days_before_checkin.integer' => 'Số ngày phải là số nguyên.',
            'days_before_checkin.min' => 'Số ngày không được nhỏ hơn :min.',
            'is_active.required' => 'Vui lòng chọn trạng thái.',
            'is_active.boolean' => 'Trạng thái không hợp lệ.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $refundPolicy->update($request->only([
            'name',
            'content',
            'penalty_percent',
            'days_before_checkin',
            'is_active'
        ]));

        return redirect()->route('admin.refund-policies.index')->with('success', 'Cập nhật chính sách thành công.');
    }
    public function destroy($id)
    {
        $policy = RefundPolicy::findOrFail($id);
        $policy->delete();

        return redirect()->route('admin.refund-policies.index')->with('success', 'Xóa thành công!');
    }
}
