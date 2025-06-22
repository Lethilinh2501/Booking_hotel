@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chi Tiết Đặt Phòng</h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Mã đặt phòng</th>
                        <td>{{ $booking->booking_code }}</td>
                    </tr>
                    <tr>
                        <th>Người đặt</th>
                        <td>{{ $booking->user ? $booking->user->name : 'Chưa có' }}</td>
                    </tr>
                    <tr>
                        <th>Check In</th>
                        <td>{{ $booking->check_in }}</td>
                    </tr>
                    <tr>
                        <th>Check Out</th>
                        <td>{{ $booking->check_out }}</td>
                    </tr>
                    <tr>
                        <th>Actual Check In</th>
                        <td>{{ $booking->actual_check_in ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Actual Check Out</th>
                        <td>{{ $booking->actual_check_out ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Tổng tiền</th>
                        <td>{{ number_format($booking->total_price, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <th>Giảm giá</th>
                        <td>{{ number_format($booking->discount_amount, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <th>Giá gốc</th>
                        <td>{{ number_format($booking->base_price, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <th>Tiền dịch vụ</th>
                        <td>{{ number_format($booking->service_total, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <th>Thuế</th>
                        <td>{{ number_format($booking->tax_fee, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <th>Tổng khách</th>
                        <td>{{ $booking->total_guests }}</td>
                    </tr>
                    <tr>
                        <th>Trẻ em</th>
                        <td>{{ $booking->children_count }}</td>
                    </tr>
                    <tr>
                        <th>Số phòng</th>
                        <td>{{ $booking->room_quantity }}</td>
                    </tr>
                    <tr>
                        <th>Yêu cầu đặc biệt</th>
                        <td>{{ $booking->special_request ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @php
                                $badgeClass = match ($booking->status) {
                                    'pending' => 'bg-warning',
                                    'confirmed' => 'bg-info',
                                    'canceled' => 'bg-danger',
                                    'completed' => 'bg-success',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($booking->status) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày đặt</th>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $booking->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary mt-3">← Quay lại</a>
            </div>
        </div>
    </main>
@endsection
