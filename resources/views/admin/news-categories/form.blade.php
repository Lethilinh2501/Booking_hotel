<!-- @php
    $isEdit = isset($news);
@endphp

@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ $isEdit ? 'Chỉnh sửa' : 'Thêm mới' }} Tin tức</h5>
        </div>
        <div class="card-body">
            <form action="{{ $isEdit ? route('admin.news.update', $news->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div class="form-group">
                    <label>Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{ $isEdit ? $news->title : old('title') }}" required>
                </div>

                <div class="form-group">
                    <label>Danh mục <span class="text-danger">*</span></label>
                    <select class="form-control" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($isEdit && $news->category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tóm tắt</label>
                    <textarea class="form-control" name="excerpt" rows="3">{{ $isEdit ? $news->excerpt : old('excerpt') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Nội dung <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="content" rows="10" required>{{ $isEdit ? $news->content : old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    @if($isEdit && $news->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $news->image) }}" width="200">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="remove_image" value="1">
                                <label class="form-check-label text-danger">Xóa ảnh hiện tại</label>
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control-file" name="image">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="draft" {{ ($isEdit && $news->status == 'draft') || old('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                                <option value="published" {{ ($isEdit && $news->status == 'published') || old('status') == 'published' ? 'selected' : '' }}>Đã đăng</option>
                                <option value="archived" {{ ($isEdit && $news->status == 'archived') || old('status') == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ngày đăng</label>
                            <input type="datetime-local" class="form-control" name="published_at" 
                                   value="{{ $isEdit ? ($news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') : old('published_at') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="is_featured" value="1" 
                           {{ ($isEdit && $news->is_featured) || old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label">Tin nổi bật</label>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection -->