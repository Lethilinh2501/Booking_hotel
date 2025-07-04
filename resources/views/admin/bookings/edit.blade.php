@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập Nhật Đặt Phòng</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <table class="table table-bordered align-middle mb-4">
                        <tbody>
                            <tr>
                                <th>Người đặt phòng</th>
                                <td>
                                    <select name="user_id" class="form-select" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $booking->user_id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Tên khách hàng</th>
                                <td>
                                    <input type="text" name="customer_name" class="form-control"
                                        value="{{ old('customer_name', $booking->customer_name) }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Phòng</th>
                                <td>
                                    <select name="room_id" class="form-select" required>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}"
                                                {{ $room->id == $booking->room_id ? 'selected' : '' }}>
                                                {{ $room->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Ngày nhận phòng</th>
                                <td>
                                    <input type="date" name="check_in" class="form-control"
                                        value="{{ old('check_in', $booking->check_in) }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Ngày trả phòng</th>
                                <td>
                                    <input type="date" name="check_out" class="form-control"
                                        value="{{ old('check_out', $booking->check_out) }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <select name="status" class="form-select">
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                            Đã xác nhận</option>
                                        <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Đã thanh
                                            toán</option>
                                        <option value="check_in" {{ $booking->status == 'check_in' ? 'selected' : '' }}>Đã
                                            nhận phòng</option>
                                        <option value="check_out" {{ $booking->status == 'check_out' ? 'selected' : '' }}>
                                            Đã trả phòng</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>
                                            Đã hủy</option>
                                        <option value="refunded" {{ $booking->status == 'refunded' ? 'selected' : '' }}>
                                            Hoàn tiền</option>
                                    </select>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Cập Nhật
                        </button>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
