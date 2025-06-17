@extends('layout.admin')

@section('content')
<main class="lh-main-content">
<div class="container">
    <h1>Tạo Loại Phòng Giảm Giá</h1>
    
    <form action="{{ route('admin.sale-room-types.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
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
        </div>
        
        <div class="mb-3">
            <label for="value" class="form-label">Giá trị</label>
            <input type="number" step="0.01" class="form-control" id="value" name="value" value="{{ old('value') }}" required>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Loại</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="1" {{ old('status', 1) ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ !old('status', 1) ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.sale-room-types.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection