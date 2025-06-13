@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">➕ Thêm đơn đặt phòng mới</h2>
        <a href="{{ route('admin.banners.listBanner') }}" class="btn btn-secondary">🏠 Về Trang chủ</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Tên khách hàng</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="room_type" class="form-label">Loại phòng</label>
            <input type="text" name="room_type" class="form-control" value="{{ old('room_type') }}" required>
        </div>

        <div class="mb-3">
            <label for="check_in_date" class="form-label">Ngày nhận phòng</label>
            <input type="date" name="check_in_date" class="form-control" value="{{ old('check_in_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="check_out_date" class="form-label">Ngày trả phòng</label>
            <input type="date" name="check_out_date" class="form-control" value="{{ old('check_out_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Tổng tiền (VNĐ)</label>
            <input type="number" name="total_amount" class="form-control" value="{{ old('total_amount') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" class="form-select" required>
                <option value="Đang chờ" {{ old('status') == 'Đang chờ' ? 'selected' : '' }}>Đang chờ</option>
                <option value="Đã xác nhận" {{ old('status') == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="Đã huỷ" {{ old('status') == 'Đã huỷ' ? 'selected' : '' }}>Đã huỷ</option>
            </select>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary me-2">⬅️ Quay lại</a>
            <button type="submit" class="btn btn-primary">💾 Lưu</button>
        </div>

    </form>
</div>
@endsection
