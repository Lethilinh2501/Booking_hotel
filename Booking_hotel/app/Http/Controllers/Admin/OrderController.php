<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
   public function index()
{
    $orders = Order::orderBy('id', 'desc')->paginate(10);
    return view('admin.orders.index', compact('orders'));
}


    // Hiển thị form tạo mới đơn hàng
    public function create()
    {
        return view('admin.orders.create');
    }

    // Xử lý lưu đơn hàng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            // Thêm các trường khác nếu có
        ]);

        Order::create($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    // Xử lý cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total_price' => 'required|numeric',
            // Thêm các trường khác nếu có
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật!');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa!');
    }

    // Cập nhật trạng thái đơn hàng (ví dụ: đổi trạng thái đang xử lý, đã giao, đã hủy)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }
}
