@extends('layout.admin')

@section('content')
    <main class="lh-main-content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Chỉnh sửa Danh mục: {{ $category->name }}</h5>
        </div>
        <div class="card-body">
            {{-- Form sẽ gửi dữ liệu đến route 'admin.news-categories.update' --}}
            <form action="{{ route('admin.news-categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Bắt buộc cho việc cập nhật --}}

                <div class="form-group mb-3">
                    <label for="name">Tên Danh mục</label>
                    {{-- Điền sẵn giá trị cũ của danh mục --}}
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="slug">Slug (URL thân thiện)</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $category->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="parent_id">Danh mục cha (Tùy chọn)</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">-- Chọn danh mục cha --</option>
                        @foreach($parentCategories as $parent)
                            {{-- Kiểm tra và chọn đúng danh mục cha cũ --}}
                            <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" id="status" name="status" required>
                        {{-- Chọn đúng trạng thái cũ --}}
                        <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.news-categories.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

@push('scripts')
{{-- Script nhỏ để tự động tạo slug từ tên danh mục khi người dùng nhập --}}
<script>
    document.getElementById('name').addEventListener('keyup', function() {
        let name = this.value;
        let slug = name.toLowerCase()
                       .replace(/ /g, '-')
                       .replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush

@endsection