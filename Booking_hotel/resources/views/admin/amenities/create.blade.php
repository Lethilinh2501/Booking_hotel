@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✨ Thêm Tiện Nghi Mới</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="alert-heading">Có lỗi xảy ra!</h6>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.amenities.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Tên tiện nghi <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control border-primary-subtle" placeholder="Nhập tên tiện nghi" required>
                </div>

         <div class="mb-3">
    <label for="description" class="form-label">Mô tả</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
</div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.amenities.index') }}" class="btn btn-outline-secondary me-2">⬅️ Quay lại</a>
                    <button type="submit" class="btn btn-primary">💾 Lưu tiện nghi</button>
                </div>
                <div class="mb-3">
    <label for="is_active" class="form-label fw-semibold">Trạng thái</label>
    <select name="is_active" id="is_active" class="form-select" required>
        <option value="1" selected>Hoạt động</option>
        <option value="0">Ẩn</option>
    </select>
</div>
            </form>

        </div>
    </div>
</div>
@endsection
