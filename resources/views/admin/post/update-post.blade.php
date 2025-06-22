@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập Nhật Bài Viết</h2>

            {{-- Thông báo thành công --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form cập nhật --}}
            <div class="card p-4">
                <form action="{{ route('admin.post.updatePatchPost', $post->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Tiêu đề --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $post->slug) }}"
                            required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mô tả ngắn --}}
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Mô tả ngắn</label>
                        <textarea name="excerpt" id="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nội dung --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea name="content" id="content" data-editor="true" rows="10"
                            class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ảnh đại diện --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh đại diện</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @if ($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="Ảnh hiện tại" class="img-thumbnail mt-2"
                                style="max-width: 200px;">
                        @endif
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Danh mục --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                            required>
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Bản nháp
                            </option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                                Công khai</option>
                            <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>Lưu
                                trữ</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bài viết nổi bật --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                            {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Bài viết nổi bật</label>
                    </div>

                    {{-- Ngày đăng --}}
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Ngày đăng</label>
                        <input type="datetime-local" name="published_at" id="published_at"
                            class="form-control @error('published_at') is-invalid @enderror"
                            value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nút --}}
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Cập nhật</button>
                    <a href="{{ route('admin.post.listPost') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </main>
@endsection
