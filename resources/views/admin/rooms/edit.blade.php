@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h3 class="mb-4">Cập nhật phòng</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Số phòng</label>
                    <input type="text" name="name" value="{{ old('name', $room->name) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại phòng</label>
                    <select name="room_type_id" class="form-control">
                        @foreach ($roomTypes as $type)
                            <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tầng</label>
                    <input type="number" name="floor" value="{{ old('floor', $room->floor) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Còn trống</option>
                        <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Đã đặt</option>
                        <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Bảo trì</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </main>
@endsection
