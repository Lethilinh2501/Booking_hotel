<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Payment;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * Hiển thị danh sách yêu cầu hoàn tiền.
     */
    public function index()
    {
        $refunds = Refund::with('payment')->latest()->paginate(10);
        return view('admin.refunds.index', compact('refunds'));
    }

    /**
     * Hiển thị form chỉnh sửa yêu cầu hoàn tiền.
     */
    public function edit($id)
    {
        $refund = Refund::with('payment')->findOrFail($id);
        $payments = Payment::latest()->get(); // có thể paginate hoặc limit nếu nhiều

        return view('admin.refunds.edit', compact('refund', 'payments'));
    }

    /**
     * Cập nhật yêu cầu hoàn tiền.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $refund = Refund::findOrFail($id);
        $refund->payment_id = $request->payment_id;
        $refund->status = $request->status;
        $refund->save();

        return redirect()
            ->route('admin.refunds.index')
            ->with('success', '✅ Cập nhật yêu cầu hoàn tiền thành công!');
    }

    /**
     * (Tuỳ chọn) Xoá yêu cầu hoàn tiền.
     */
    public function destroy($id)
    {
        $refund = Refund::findOrFail($id);
        $refund->delete();

        return back()->with('success', '🗑️ Đã xoá yêu cầu hoàn tiền!');
    }
}
