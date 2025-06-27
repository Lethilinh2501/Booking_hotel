@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Sửa loại phòng: {{ $roomType->name }}</h2>
            <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.roomtypes.update', $roomType->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên loại phòng</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $roomType->name) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá phòng</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $roomType->price) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="max_capacity" class="form-label">Sức chứa tối đa</label>
                        <input type="number" name="max_capacity" id="max_capacity" value="{{ old('max_capacity', $roomType->max_capacity) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Trạng thái</label>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="1" {{ $roomType->is_active ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ !$roomType->is_active ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                        <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Ảnh loại phòng --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ảnh loại phòng</h5>
                <a href="{{ route('admin.roomtypes.images.index', $roomType->id) }}" class="btn btn-sm btn-primary">Quản lý ảnh</a>
            </div>

            <div class="card-body">
                @if ($roomType->roomTypeImages->count())
                    <div class="row">
                        @foreach ($roomType->roomTypeImages as $image)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body text-center p-2">
                                        @if ($image->is_main)
                                            <span class="badge bg-success mb-2">Ảnh chính</span>
                                        @else
                                            <span class="badge bg-secondary mb-2">Ảnh phụ</span>
                                        @endif

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.roomtypes.images.edit', [$roomType->id, $image->id]) }}" class="btn btn-sm btn-warning">Sửa</a>

                                            <form action="{{ route('admin.roomtypes.images.destroy', [$roomType->id, $image->id]) }}" method="POST" onsubmit="return confirm('Xóa ảnh này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Chưa có ảnh cho loại phòng này.</p>
                @endif
            </div>
        </div>

    </div>
</main>
@endsection
