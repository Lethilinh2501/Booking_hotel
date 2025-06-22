@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Thêm Phòng Mới</h2>

        {{-- Hiển thị lỗi nếu có --}}
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        {{-- Form thêm phòng --}}
        <div class="card p-4">
            <form action="{{ route('admin.rooms.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Tên phòng</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="room_type_id" class="form-label">Loại phòng</label>
                    <select name="room_type_id" id="room_type_id" class="form-select">
                        <option value="">-- Chọn loại phòng --</option>
                        @foreach ($roomTypes as $type)
                            <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('room_type_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="floor" class="form-label">Tầng</label>
                    <input type="number" class="form-control" id="floor" name="floor" value="{{ old('floor') }}">
                    @error('floor')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status" id="status" class="form-select">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Còn trống</option>
                        <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>Đã đặt</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Bảo trì</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Thêm phòng</button>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</main>
@endsection
