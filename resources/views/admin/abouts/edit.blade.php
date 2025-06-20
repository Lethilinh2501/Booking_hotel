@extends('layout.admin')
@section('content')
<div class="container mt-4">
    <h2>Cập Nhật Giới Thiệu</h2>
    <form action="{{ route('admin.abouts.update', $about->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="about" class="form-control" rows="6">{{ old('about', $about->about) }}</textarea>
            @error('about') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_use" value="1" {{ $about->is_use ? 'checked' : '' }}>
            <label class="form-check-label">Sử dụng</label>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
