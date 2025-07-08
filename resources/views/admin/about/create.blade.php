@extends('layout.admin')

@section('content')
<main class="lh-main-content">

<div class="container">
    <h1>Thêm nội dung Giới thiệu</h1>

    <form action="{{ route('admin.about.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nội dung:</label>
            <textarea name="about" class="form-control" rows="6" required>{{ old('about') }}</textarea>
        </div>
        <div class="form-group">
            <label>Hiển thị?</label>
            <select name="is_use" class="form-control">
                <option value="1" {{ old('is_use') == '1' ? 'selected' : '' }}>Có</option>
                <option value="0" {{ old('is_use') == '0' ? 'selected' : '' }}>Không</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Thêm mới</button>
        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary ml-2">Quay lại danh sách</a>
    </form>
</div>
@endsection
