@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>✏️ Chỉnh sửa chính sách</h2>

    <form action="{{ route('admin.policies.update', $policy->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" value="{{ $policy->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $policy->content }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $policy->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Hiển thị chính sách</label>
        </div>

        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        <a href="{{ route('admin.policies.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
    </form>
</div>
@endsection
