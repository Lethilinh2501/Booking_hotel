@extends('layout.admin')

@section('content')
<main class="lh-main-content">

<div class="container">
    <h1>Chỉnh sửa trang Giới thiệu</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('admin/about/update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nội dung giới thiệu:</label>
            <textarea name="about" class="form-control" rows="8">{{ old('about', $about->about ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Sử dụng trang này?</label>
            <select name="is_use" class="form-control">
                <option value="1" {{ isset($about) && $about->is_use ? 'selected' : '' }}>Có</option>
                <option value="0" {{ isset($about) && !$about->is_use ? 'selected' : '' }}>Không</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.about.index') }}" class="btn btn-secondary ml-2">Quay lại danh sách</a>
        </div>    
    </form>
</div>
@endsection
