<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Payment;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    // Danh sách refund
    public function index()
    {
        $refunds = Refund::with('payment')->latest()->paginate(10);
        return view('admin.refunds.index', compact('refunds'));
    }

    // Form tạo mới refund
    public function create()
    {
        $payments = Payment::all();
        return view('admin.refunds.create', compact('payments'));
    }

    // Lưu refund mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'amount'     => 'required|numeric|min:1',
            'status'     => 'required|string|max:255',
        ]);

        Refund::create($validated);

        return redirect()->route('admin.refunds.index')->with('success', 'Tạo refund thành công!');
    }

    // Xem chi tiết refund
    public function show($id)
    {
        $refund = Refund::with('payment')->findOrFail($id);
        return view('admin.refunds.show', compact('refund'));
    }

    // Form chỉnh sửa refund
    public function edit($id)
    {
        $refund   = Refund::with('payment')->findOrFail($id);
        $payments = Payment::all();
        return view('admin.refunds.edit', compact('refund', 'payments'));
    }

    // Cập nhật refund
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'amount'     => 'required|numeric|min:1',
            'status'     => 'required|string|max:255',
        ]);

        $refund = Refund::findOrFail($id);
        $refund->update($validated);

        return redirect()->route('admin.refunds.index')->with('success', 'Cập nhật refund thành công!');
    }

    // Xóa refund
    public function destroy($id)
    {
        $refund = Refund::findOrFail($id);
        $refund->delete();

        return redirect()->route('admin.refunds.index')->with('success', 'Xóa refund thành công!');
    }
}
