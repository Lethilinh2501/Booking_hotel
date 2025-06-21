@extends('layout.admin')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Sửa đặt phòng #{{ $booking->id }}</h2>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ôi không 😢!</strong> Có lỗi rồi:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_name" class="form-label">Tên khách hàng</label>
                <input type="text" name="customer_name" class="form-control"
                    value="{{ old('customer_name', $booking->customer_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="room_id" class="form-label">Phòng</label>
                <select name="room_id" class="form-select" required>
                    @foreach (\App\Models\Room::all() as $room)
                        <option value="{{ $room->id }}" {{ $room->id == $booking->room_id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="check_in_date" class="form-label">Ngày nhận phòng</label>
                <input type="date" name="check_in_date" class="form-control"
                    value="{{ old('check_in_date', $booking->check_in_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="check_out_date" class="form-label">Ngày trả phòng</label>
                <input type="date" name="check_out_date" class="form-control"
                    value="{{ old('check_out_date', $booking->check_out_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
        </form>
    </div>
@endsection
