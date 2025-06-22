@extends('layout.admin')

@section('content')
<main class="lh-main-content">
<div class="container">
    <h1>Tạo Loại Phòng Giảm Giá</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sale-room-types.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="room_type_id" class="form-label">Loại Phòng</label>
            <select class="form-control" id="room_type_id" name="room_type_id" required>
                <option value="">Chọn Loại Phòng</option>
                @foreach($roomTypes as $roomType)
                    <option value="{{ $roomType->id }}" {{ old('room_type_id') == $roomType->id ? 'selected' : '' }}>
                        {{ $roomType->name }}
                    </option>
                @endforeach
            </select>
            @error('room_type_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Loại khuyến mãi</label>
            <select class="form-control" id="type" name="type" required>
                <option value="">-- Chọn loại khuyến mãi --</option>
                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Số tiền cố định</option>
            </select>
            @error('type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Giá trị</label>
            <input type="number" step="0.01" class="form-control" id="value" name="value" value="{{ old('value') }}" required>
            @error('value')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.sale-room-types.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</main>
@endsection