@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Thêm Khuyến Mãi</h2>

            <div class="card p-4">
                <form action="{{ route('admin.promotions.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên khuyến mãi</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label">Mã khuyến mãi</label>
                        <input type="text" class="form-control" id="code" name="code"
                            value="{{ old('code') }}">
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Giá trị giảm</label>
                        <input type="number" step="0.01" class="form-control" id="value" name="value"
                            value="{{ old('value') }}">
                        @error('value')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Loại giảm</label>
                        <select name="type" id="type" class="form-select">
                            <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Giá cố định</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            value="{{ old('quantity') }}">
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="min_booking_amount" class="form-label">Giá trị đặt phòng tối thiểu</label>
                        <input type="number" class="form-control" id="min_booking_amount" name="min_booking_amount"
                            value="{{ old('min_booking_amount') }}">
                        @error('min_booking_amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="max_discount_value" class="form-label">Giảm tối đa</label>
                        <input type="number" class="form-control" id="max_discount_value" name="max_discount_value"
                            value="{{ old('max_discount_value') }}">
                        @error('max_discount_value')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                            value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Đang hoạt động
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động
                            </option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
                </form>
            </div>
        </div>
    </main>
@endsection
