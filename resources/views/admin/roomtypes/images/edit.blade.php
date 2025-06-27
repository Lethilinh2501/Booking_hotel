@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid p-4">
            <h2>Sửa ảnh loại phòng: {{ $roomType->name }}</h2>

            <form action="{{ route('admin.roomtypes.images.update', [$roomType->id, $image->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Ảnh hiện tại</label><br>
                    <img src="{{ asset('storage/' . $image->image) }}" width="200">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh mới</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_main" value="1" class="form-check-input" id="is_main" {{ $image->is_main ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_main">Đặt làm ảnh chính</label>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.roomtypes.images.index', $roomType->id) }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </main>
@endsection
