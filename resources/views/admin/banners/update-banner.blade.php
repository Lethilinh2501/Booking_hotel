@extends('layout.admin')



@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập Nhật Banner</h2>
            <div class="card p-4">
                <form action="{{ route('admin.banners.updatePatchBanner', $banner->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="title" class="form-label">Tên banner</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $banner->title) }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Liên kết (link)</label>
                        <input type="url" class="form-control" id="link" name="link"
                            value="{{ old('link', $banner->link) }}">
                        @error('link')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="mt-2">
                            @if ($banner->image)
                                <img src="{{ Storage::url($banner->image) }}" alt="Hình ảnh banner" class="img-thumbnail"
                                    width="150">
                            @else
                                <p>Chưa có ảnh</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="is_use" class="form-label">Trạng thái</label>
                        <select class="form-select" id="is_use" name="is_use" required>
                            <option value="1" {{ $banner->is_use == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $banner->is_use == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Cập nhật
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
