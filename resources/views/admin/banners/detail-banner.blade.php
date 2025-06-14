@extends('layout.admin')


@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chi Tiết Banner</h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Tiêu đề</th>
                        <td>{{ $banner->title }}</td>
                    </tr>
                    <tr>
                        <th>Link</th>
                        <td>{{ $banner->stock }}</td>
                    </tr>
                    <tr>
                        <th>Hình ảnh</th>
                        <td>
                            <img src="{{ Storage::url($banner->image) }}" class="img-thumbnail" width="300">
                        </td>
                    </tr>

                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @if ($banner->is_use)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-danger">Ẩn</span>
                            @endif
                        </td>
                    </tr>
                </table>
                <a href="{{ route('admin.banners.listBanner') }}" class="btn btn-primary mt-3">Quay lại</a>
            </div>
        </div>
    </main>
@endsection
