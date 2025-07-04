@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Chi Tiết Đặt Phòng</h2>
        <div class="card p-4">
            <div class="row">
                <!-- Thông tin cơ bản -->
                <div class="col-md-3">
                    <h5>Thông tin cơ bản</h5>
                    <ul class="list-unstyled">
                        <li><strong>Loại phòng:</strong> {{ $booking->room_type }}</li>
                        <li><strong>Giá gốc:</strong> {{ number_format($booking->base_price, 0, ',', '.') }} VND</li>
                        <li><strong>Giảm giá:</strong> {{ number_format($booking->discount_amount, 0, ',', '.') }} VND</li>
                        <li><strong>Giá sau giảm:</strong> {{ number_format($booking->total_price, 0, ',', '.') }} VND</li>
                        <li><strong>Khách:</strong> {{ $booking->total_guests }}</li>
                        <li><strong>Trẻ em:</strong> {{ $booking->children_count }}</li>
                        <li><strong>Số phòng:</strong> {{ $booking->room_quantity }}</li>
                    </ul>
                </div>

                <!-- Mô tả -->
                <div class="col-md-3">
                    <h5>Mô tả</h5>
                    <p>{{ $booking->room_description ?? 'Không có mô tả' }}</p>
                </div>

                <!-- Tiện nghi -->
                <div class="col-md-3">
                    <h5>Tiện nghi</h5>
                    <ul class="list-unstyled">
                        <li>WiFi miễn phí</li>
                        <li>Điều hòa</li>
                        <li>TV màn hình phẳng</li>
                        <li>Máy sấy tóc</li>
                        <li>Chỗ để xe miễn phí</li>
                        <li>...</li>
                    </ul>
                </div>

                <!-- Quy tắc & Dịch vụ -->
                <div class="col-md-3">
                    <h5>Quy tắc & Dịch vụ</h5>
                    <ul class="list-unstyled">
                        <li>Không hút thuốc</li>
                        <li>Nhận phòng: {{ $booking->check_in }}</li>
                        <li>Trả phòng: {{ $booking->check_out }}</li>
                        <li>Dịch vụ giặt ủi (có phí)</li>
                        <li>Bữa sáng miễn phí</li>
                    </ul>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">← Quay lại</a>
            </div>
        </div>
    </div>
</main>
@endsection
