@extends('layout.admin')



@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
        <h2 class="mb-4">Thêm Danh mục Bài viết</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.postcategory.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                    placeholder="Nhập tên danh mục" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.postcategory.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
