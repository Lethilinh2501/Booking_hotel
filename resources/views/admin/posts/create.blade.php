@extends('layout.admin')

@push('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #2980b9;
            color: white;
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <main class="lh-main-content">

    <div class="container mt-4">
        <h2 class="mb-4">Thêm Bài viết mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">Mô tả ngắn</label>
                <textarea name="excerpt" id="excerpt" class="form-control" rows="2">{{ old('excerpt') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh đại diện</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" id="status" class="form-control">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>published</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>archived</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input"
                    {{ old('is_featured') ? 'checked' : '' }}>
                <label for="is_featured" class="form-check-label">Bài viết nổi bật</label>
            </div>

            <div class="mb-3">
                <label for="published_at" class="form-label">Ngày đăng</label>
                <input type="datetime-local" name="published_at" id="published_at" class="form-control"
                    value="{{ old('published_at') }}">
            </div>

            <button type="submit" class="btn btn-success">Lưu bài viết</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
