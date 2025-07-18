@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Chi tiết đơn đặt phòng</h2>

        <div class="row g-4">
            <!-- Thông tin người đặt -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="mb-3">Thông tin người đặt</h5>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $booking->user->avatar ?? 'https://via.placeholder.com/80' }}" alt="avatar" class="rounded-circle me-3" width="64" height="64">
                        <div>
                            <strong>{{ $booking->user->name }}</strong><br>
                            <small>{{ $booking->user->email }}</small>
                        </div>
                    </div>
                    <ul class="list-unstyled">
                        <li>Số điện thoại: {{ $booking->user->phone ?? 'N/A' }}</li>
                        <li>Địa chỉ: {{ $booking->user->address ?? 'N/A' }}</li>
                        <li>Ngày tạo đơn: {{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y H:i') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Thông tin người ở -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="mb-3">Thông tin người ở</h5>
                    <ul class="list-unstyled">
                        <li>Người ở 1: {{ $booking->guest_name ?? 'N/A' }}</li>
                        <li>SĐT: {{ $booking->guest_phone ?? 'N/A' }}</li>
                        <li>Email: {{ $booking->guest_email ?? 'N/A' }}</li>
                        <li>CMND/CCCD: {{ $booking->guest_identity ?? 'N/A' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Thông tin phòng -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="mb-3">Thông tin phòng</h5>
                    <ul class="list-unstyled">
                        <li>Số phòng: {{ $booking->room_number ?? 'N/A' }}</li>
                        <li>Loại phòng: {{ $booking->room_type }}</li>
                        <li>Giường: {{ $booking->bed_type ?? 'N/A' }}</li>
                        <li>Tiện nghi:
                            <ul>
                                <li>WiFi miễn phí</li>
                                <li>Điều hòa</li>
                                <li>TV</li>
                                <li>Bình nước nóng</li>
                                <li>Chỗ để xe</li>
                            </ul>
                        </li>
                        <li>Check-in: {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</li>
                        <li>Check-out: {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Dịch vụ phát sinh -->
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">Dịch vụ phát sinh</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">+ Thêm dịch vụ</a>
                    </div>
                    @if ($booking->extra_services && count($booking->extra_services))
                        <ul class="list-group">
                            @foreach ($booking->extra_services as $service)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $service->name }}</span>
                                    <span>{{ number_format($service->price, 0, ',', '.') }}đ (x{{ $service->quantity }})</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mt-2">Không có dịch vụ nào.</p>
                    @endif
                </div>
            </div>

            <!-- Thông tin đơn -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="mb-3">Thông tin đơn đặt phòng</h5>
                    <ul class="list-unstyled">
                        <li>Mã đơn: <strong>#{{ $booking->code }}</strong></li>
                        <li>Thời gian tạo: {{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y H:i') }}</li>
                        <li>Trạng thái:
                            @if ($booking->status === 'pending')
                                <span class="badge bg-warning">Đang chờ</span>
                            @elseif ($booking->status === 'confirmed')
                                <span class="badge bg-success">Đã xác nhận</span>
                            @elseif ($booking->status === 'cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                            @endif
                        </li>
                        <li>Ghi chú: {{ $booking->note ?? 'Không có' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Thông tin thanh toán -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="mb-3">Thông tin thanh toán</h5>
                    <ul class="list-unstyled">
                        <li>Phương thức: {{ strtoupper($booking->payment_method) }}</li>
                        <li>Mã giao dịch: {{ $booking->payment_code ?? 'N/A' }}</li>
                        <li>Ngày thanh toán: {{ $booking->paid_at ? \Carbon\Carbon::parse($booking->paid_at)->format('d/m/Y H:i') : 'Chưa thanh toán' }}</li>
                        <li>Trạng thái: {!! $booking->is_paid ? '<span class="badge bg-success">Đã thanh toán</span>' : '<span class="badge bg-danger">Chưa thanh toán</span>' !!}</li>
                    </ul>
                </div>
            </div>

            <!-- Tổng tiền -->
            <div class="col-md-12">
                <div class="card p-3">
                    <h5 class="mb-3">Tổng tiền</h5>
                    <ul class="list-unstyled">
                        <li>Tiền phòng: {{ number_format($booking->total_price, 0, ',', '.') }} VND</li>
                        <li>Dịch vụ phát sinh: {{ number_format($booking->extra_service_total ?? 0, 0, ',', '.') }} VND</li>
                        <li><strong>Tổng cộng: {{ number_format(($booking->total_price + ($booking->extra_service_total ?? 0)), 0, ',', '.') }} VND</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>
    </div>
</main>
@endsection
