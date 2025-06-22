@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Thêm tiện nghi mới</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong> Có vấn đề xảy ra với dữ liệu nhập vào:
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.amenities.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên tiện nghi</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên tiện nghi..." value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Trạng thái</label>
            <select name="is_active" id="is_active" class="form-select">
                <option value="1" selected>Hiển thị</option>
                <option value="0">Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu tiện nghi</button>
        <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
