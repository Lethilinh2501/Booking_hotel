@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Sửa tiện nghi</h2>

    <form action="{{ route('admin.amenities.update', $amenity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên tiện nghi</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $amenity->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Trạng thái</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1" {{ $amenity->is_active ? 'selected' : '' }}>Hiện</option>
                <option value="0" {{ !$amenity->is_active ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
