@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Thêm ảnh cho loại phòng: {{ $roomType->name }}</h2>
            <a href="{{ route('admin.roomtypes.images.index', $roomType->id) }}" class="btn btn-secondary">
                ← Quay lại danh sách ảnh
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Lỗi!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.roomtypes.images.store', $roomType->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn ảnh <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_main" class="form-check-input" id="is_main">
                        <label class="form-check-label" for="is_main">Đặt làm ảnh chính</label>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-save"></i> Lưu ảnh
                        </button>
                        <a href="{{ route('admin.roomtypes.images.index', $roomType->id) }}" class="btn btn-secondary">
                            Hủy
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
@endsection
