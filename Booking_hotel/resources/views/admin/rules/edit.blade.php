@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>✏️ Chỉnh sửa nội quy</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rules.update', $rule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $rule->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $rule->content) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="is_active" class="form-select">
                <option value="1" {{ $rule->is_active ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ !$rule->is_active ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">💾 Cập nhật nội quy</button>
    </form>
</div>
@endsection
