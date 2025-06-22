@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h3 class="mb-4">Chi Tiết Phòng: {{ $room->name }}</h3>

            <div class="card p-4">
                <div class="mb-3">
                    <strong>Tên phòng:</strong> {{ $room->name }}
                </div>
                <div class="mb-3">
                    <strong>Loại phòng:</strong> {{ $room->roomType->name ?? 'Không xác định' }}
                </div>
                <div class="mb-3">
                    <strong>Tầng:</strong> {{ $room->floor }}
                </div>
                <div class="mb-3">
                    <strong>Trạng thái:</strong>
                    @if ($room->status === 'available')
                        <span class="badge bg-success">Còn trống</span>
                    @elseif ($room->status === 'booked')
                        <span class="badge bg-warning">Đã đặt</span>
                    @else
                        <span class="badge bg-danger">Bảo trì</span>
                    @endif
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </main>
@endsection
