@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Thêm Bài Viết Mới</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.post.addPostPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tiêu đề --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            class="form-control @error('slug') is-invalid @enderror" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mô tả ngắn --}}
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Mô tả ngắn</label>
                        <textarea name="excerpt" id="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nội dung --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea name="content" id="content" data-editor="true" rows="5"
                            class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>

                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ảnh đại diện --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh đại diện</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Danh mục --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" id="category_id"
                            class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Trạng thái --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công khai
                            </option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bài viết nổi bật --}}
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input"
                            {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured" class="form-check-label">Bài viết nổi bật</label>
                    </div>

                    {{-- Ngày đăng --}}
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Ngày đăng</label>
                        <input type="datetime-local" name="published_at" id="published_at"
                            class="form-control @error('published_at') is-invalid @enderror"
                            value="{{ old('published_at') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nút --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Lưu bài viết</button>
                        <a href="{{ route('admin.post.listPost') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
