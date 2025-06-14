@extends('layout.admin')



@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
        <h2 class="mb-4">Cập nhật Danh mục Bài viết</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.postcategory.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $category->name) }}"
                       class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.postcategory.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
