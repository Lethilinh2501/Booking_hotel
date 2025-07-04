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
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Mã Đặt Phòng</th>
                        <th>Người Đặt</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Tổng Tiền</th>
                        <th>Số Khách</th>
                        <th>Số Phòng</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
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
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $booking->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hành động
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $booking->id }}">
                                        <li>
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="dropdown-item">
                                                <i class="bi bi-eye me-2"></i>Chi tiết
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="dropdown-item">
                                                <i class="bi bi-pencil-square me-2"></i>Sửa
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                                class="d-inline" onsubmit="showSpinner({{ $booking->id }})">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" id="delete-button{{ $booking->id }}">
                                                    <i class="bi bi-trash me-2"></i>Xóa
                                                    <span id="spinner{{ $booking->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Phân trang --}}
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
       
    </div>
</main>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
    // Hiển thị spinner khi nhấn vào nút xóa
    function showSpinner(bookingId) {
        var spinner = document.getElementById('spinner' + bookingId);
        var deleteButton = document.getElementById('delete-button' + bookingId);

        // Hiển thị spinner và ẩn nút xóa
        spinner.classList.remove('d-none');
        deleteButton.disabled = true;
    }
</script>

@endsection
