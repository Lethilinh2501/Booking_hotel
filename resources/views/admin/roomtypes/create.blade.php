@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Thêm loại phòng</h2>
            <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.roomtypes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên loại phòng</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá phòng</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control" required>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="max_capacity" class="form-label">Sức chứa tối đa</label>
                        <input type="number" name="max_capacity" id="max_capacity" value="{{ old('max_capacity') }}" class="form-control" required>
                        @error('max_capacity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Trạng thái</label>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        @error('is_active')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh đại diện (tuỳ chọn)</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Lưu</button>
                        <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</main>
@endsection
