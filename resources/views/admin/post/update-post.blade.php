@extends('admin.layout.default')

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
    <main class="container-fluid flex-grow-1">
        <div class="container mt-4">
            <h2 class="mb-4">Cập Nhật Bài Viết</h2>

            {{-- Hiển thị thông báo nếu có --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.post.updatePatchPost', $post->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            value="{{ old('slug', $post->slug) }}" required>
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Mô tả ngắn</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="Ảnh hiện tại" width="120"
                                class="mt-2">
                        @endif
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Công khai
                            </option>
                            <option value="archived" {{ $post->status == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                            {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Bài viết nổi bật</label>
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Ngày đăng</label>
                        <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                            value="{{ old('published_at', \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i')) }}">
                        @error('published_at')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('admin.post.listPost') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </main>
@endsection
