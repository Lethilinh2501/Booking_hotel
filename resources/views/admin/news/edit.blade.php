@extends('layout.admin')

@section('content')
    <main class="lh-main-content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Chỉnh sửa Tin tức: {{ $news->title }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $news->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="news_category_id">Danh mục</label>
                    <select name="news_category_id" id="news_category_id" class="form-control @error('news_category_id') is-invalid @enderror" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $news->news_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('news_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="10" required>{{ old('content', $news->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                        <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Công khai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Ảnh đại diện</label>
                    <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if($news->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="Current Image" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection