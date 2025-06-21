@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="mb-4">Danh Sách Đặt Phòng</h2>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>STT</th>
                            <th>Mã Đặt Phòng</th>
                            <th>Người Đặt</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Tổng Tiền</th>
                            <th>Số Khách</th>
                            <th>Số Phòng</th>
                            <th>Trạng Thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $key => $booking)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ $booking->user ? $booking->user->name : 'Chưa có' }}</td>
                                <td>{{ $booking->check_in }}</td>
                                <td>{{ $booking->check_out }}</td>
                                <td>{{ number_format($booking->total_price, 0, ',', '.') }} VND</td>
                                <td>{{ $booking->total_guests }}</td>
                                <td>{{ $booking->room_quantity }}</td>
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
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa booking này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
