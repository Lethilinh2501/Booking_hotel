@extends('layout.admin')


@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h3 class="mb-4">Danh Sách Banner</h2>
            <a href="{{ route('admin.banners.addBanner') }}" class="btn btn-primary mb-4">Thêm mới</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Link</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listBanner as $key => $banner)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    @if ($banner->image)
                                        <img src="{{ Storage::url($banner->image) }}" class="banner-thumbnail" width="100">
                                    @else
                                        <em>Không có ảnh</em>
                                    @endif
                                </td>
                                <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
                                <td>
                                    @if ($banner->is_use)
                                        <span class="badge bg-success">Hiển thị</span>
                                    @else
                                        <span class="badge bg-danger">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.banners.detailBanner', $banner->id) }}"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('admin.banners.updateBanner', $banner->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.banners.deleteBanner') }}" method="POST"
                                        style="display:inline;" onsubmit="return confirm('Xác nhận xóa banner này?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $banner->id }}">
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $listBanner->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
