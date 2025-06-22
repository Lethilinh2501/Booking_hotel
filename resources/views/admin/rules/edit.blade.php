@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Sửa quy định</h2>
    <form action="{{ route('admin.rules.update', $rule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $rule->title }}">
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control">{{ $rule->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $rule->is_active ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ !$rule->is_active ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
