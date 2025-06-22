<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Validation\Rule;

class PromotionController extends Controller
{
    // Danh sách khuyến mãi
    public function index()
    {
        $promotions = Promotion::orderBy('id', 'desc')->paginate(7);
        return view('admin.promotions.index', compact('promotions'));
    }

    // Form thêm mới
    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:promotions,code',
            'value' => 'required|numeric|min:0|max:3000000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'min_booking_amount' => 'required|integer|min:0|max:3000000',
            'max_discount_value' => 'required|integer|min:0|max:3000000',
            'quantity' => 'required|integer|min:1|max:1000',
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ], [
            'name.required' => 'Vui lòng nhập tên khuyến mãi.',
            'name.max' => 'Tên khuyến mãi không được vượt quá 255 ký tự.',
            'code.required' => 'Vui lòng nhập mã khuyến mãi.',
            'code.max' => 'Mã khuyến mãi không được vượt quá 50 ký tự.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'value.required' => 'Vui lòng nhập giá trị khuyến mãi.',
            'value.numeric' => 'Giá trị khuyến mãi phải là số.',
            'value.min' => 'Giá trị khuyến mãi không được âm.',
            'value.max' => 'Giá trị khuyến mãi không được vượt quá 3.000.000.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'min_booking_amount.required' => 'Vui lòng nhập số tiền đặt tối thiểu.',
            'min_booking_amount.integer' => 'Số tiền đặt tối thiểu phải là số nguyên.',
            'min_booking_amount.min' => 'Số tiền đặt tối thiểu không được âm.',
            'min_booking_amount.max' => 'Số tiền đặt tối thiểu không vượt quá 3.000.000.',
            'max_discount_value.required' => 'Vui lòng nhập giá trị giảm tối đa.',
            'max_discount_value.integer' => 'Giá trị giảm tối đa phải là số nguyên.',
            'max_discount_value.min' => 'Giá trị giảm tối đa không được âm.',
            'max_discount_value.max' => 'Giá trị giảm tối đa không vượt quá 3.000.000.',
            'quantity.required' => 'Vui lòng nhập số lượng mã khuyến mãi.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng tối thiểu là 1.',
            'quantity.max' => 'Số lượng tối đa là 1000.',
            'type.required' => 'Vui lòng chọn loại khuyến mãi.',
            'type.in' => 'Loại khuyến mãi không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái khuyến mãi.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);
        
        Promotion::create($request->all());

        return redirect()->route('admin.promotions.index')->with('success', 'Thêm khuyến mãi thành công!');
    }
    // Form chỉnh sửa
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('promotions', 'code')->ignore($id)
            ],
            'value' => 'required|numeric|min:0|max:3000000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'min_booking_amount' => 'required|integer|min:0|max:3000000',
            'max_discount_value' => 'required|integer|min:0|max:3000000',
            'quantity' => 'required|integer|min:1|max:1000',
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ], [
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'name.max' => 'Tên khuyến mãi không được vượt quá 255 ký tự.',
            'code.required' => 'Vui lòng nhập mã khuyến mãi.',
            'code.max' => 'Mã khuyến mãi không được vượt quá 50 ký tự.',
            'value.required' => 'Vui lòng nhập giá trị khuyến mãi.',
            'value.numeric' => 'Giá trị khuyến mãi phải là số.',
            'value.min' => 'Giá trị khuyến mãi không được âm.',
            'value.max' => 'Giá trị khuyến mãi không được vượt quá 3.000.000.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'min_booking_amount.required' => 'Vui lòng nhập số tiền đặt tối thiểu.',
            'min_booking_amount.integer' => 'Số tiền đặt tối thiểu phải là số nguyên.',
            'min_booking_amount.min' => 'Số tiền đặt tối thiểu không được âm.',
            'min_booking_amount.max' => 'Số tiền đặt tối thiểu không vượt quá 3.000.000.',
            'max_discount_value.required' => 'Vui lòng nhập giá trị giảm tối đa.',
            'max_discount_value.integer' => 'Giá trị giảm tối đa phải là số nguyên.',
            'max_discount_value.min' => 'Giá trị giảm tối đa không được âm.',
            'max_discount_value.max' => 'Giá trị giảm tối đa không vượt quá 3.000.000.',
            'quantity.required' => 'Vui lòng nhập số lượng mã khuyến mãi.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng tối thiểu là 1.',
            'quantity.max' => 'Số lượng tối đa là 1000.',
            'type.required' => 'Vui lòng chọn loại khuyến mãi.',
            'type.in' => 'Loại khuyến mãi không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái khuyến mãi.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->all());

        return redirect()->route('admin.promotions.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    }
    // Xóa mềm
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return redirect()->route('admin.promotions.index')->with('success', 'Xóa khuyến mãi thành công!');
    }
}
