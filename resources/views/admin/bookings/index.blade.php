@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">

        <h2 class="mb-4">Danh Sách Đặt Phòng</h2>

        {{-- BỘ LỌC --}}
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" placeholder="Ngày bắt đầu">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" placeholder="Ngày kết thúc">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="pending">Chưa thanh toán</option>
                    <option value="paid">Đã thanh toán</option>
                    <option value="check_in">Đã check in</option>
                    <option value="check_out">Đã checkout</option>
                    <option value="canceled">Đã huỷ</option>
                    <option value="refunded">Đã hoàn tiền</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary" type="submit">Áp dụng</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Xoá bộ lọc</a>
            </div>
        </form>

        {{-- BẢNG --}}
        <div class="card p-3">
            <table class="table table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mã</th>
                        <th>Khách Hàng</th>
                        <th>Phòng</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Tổng Giá</th>
                        <th>Đòi Trả</th>
                        <th>Hoàn Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->booking_code }}</td>
                            <td>
                                Người Đặt: {{ $booking->user->name ?? 'Ẩn danh' }}<br>
                                Người Ở: {{ $booking->guest_name ?? 'Ẩn danh' }}
                            </td>
                            <td>{{ $booking->room->room_number ?? '---' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d-m-Y') }}</td>
                            <td>{{ number_format($booking->total_price, 0, ',', '.') }}VND</td>
                            <td>{{ number_format($booking->refundable_amount ?? 0, 0, ',', '.') }}VND</td>
                            <td>
                                @if ($booking->is_refunded)
                                    <span class="badge bg-success">Đã Hoàn Tiền</span>
                                @else
                                    <span class="badge bg-secondary">Không Có</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Chưa thanh toán</option>
                                        <option value="deposit" {{ $booking->status == 'deposit' ? 'selected' : '' }}>Đã cọc</option>
                                        <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                        <option value="check_in" {{ $booking->status == 'check_in' ? 'selected' : '' }}>Đã check in</option>
                                        <option value="check_out" {{ $booking->status == 'check_out' ? 'selected' : '' }}>Đã checkout</option>
                                        <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>Đã huỷ</option>
                                        <option value="refunded" {{ $booking->status == 'refunded' ? 'selected' : '' }}>Đã hoàn tiền</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.bookings.show', $booking->id) }}"><i class="bi bi-eye me-2"></i>Chi tiết</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.bookings.edit', $booking->id) }}"><i class="bi bi-pencil me-2"></i>Sửa</a></li>
                                        <li>
                                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Xác nhận xoá?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Xoá</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>
</main>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
