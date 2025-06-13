@extends('admin.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📦 Danh sách đơn đặt phòng</h2>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">➕ Thêm đơn mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ number_format($order->total_price) }} VNĐ</td>
                    <td>{{ $order->status }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block"
                              onsubmit="return confirm('Bạn có chắc muốn xoá đơn này không?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

</div>
@endsection
