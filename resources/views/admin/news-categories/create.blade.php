@extends('layout.admin')

@section('content')
    <main class="lh-main-content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Thêm mới Danh mục Tin tức</h5>
        </div>
        <div class="card-body">
            {{-- Form sẽ gửi dữ liệu đến route 'admin.news-categories.store' --}}
            <form action="{{ route('admin.news-categories.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Tên Danh mục</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="parent_id">Danh mục cha (Tùy chọn)</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">-- Chọn danh mục cha --</option>
                        {{-- Giả định controller đã gửi biến $parentCategories --}}
                        @if(isset($parentCategories))
                            @foreach($parentCategories as $category)
                                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Lưu lại</button>
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
                       .replace(/[^\w-]+/g, ''); // Xóa các ký tự đặc biệt
        document.getElementById('slug').value = slug;
    });
</script>
@endpush

@endsection