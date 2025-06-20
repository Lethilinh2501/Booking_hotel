@extends('layout.admin')

@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Thêm Banner</h2>

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
                <form action="{{ route('admin.banners.addPostBanner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Nhập tiêu đề banner" value="{{ old('title') }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Liên kết (nếu có)</label>
                        <input type="url" class="form-control" id="link" name="link"
                            placeholder="https://example.com" value="{{ old('link') }}">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_use" name="is_use" value="1"
                            {{ old('is_use', $banner->is_use ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_use">
                            Hiển thị banner
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </main>
@endsection
