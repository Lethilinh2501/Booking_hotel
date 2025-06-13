@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>➕ Thêm chính sách mới</h2>

    <form action="{{ route('admin.policies.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
            <label class="form-check-label">Hiển thị chính sách</label>
        </div>

        <button type="submit" class="btn btn-primary">💾 Lưu</button>
        <a href="{{ route('admin.policies.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
    </form>
</div>
@endsection
