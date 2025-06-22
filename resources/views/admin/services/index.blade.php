@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <h3 class="mb-4">Danh sách dịch vụ</h3>

            <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Thêm Mới</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên dịch vụ</th>
                            <th>Giá (VNĐ)</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $index => $service)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ number_format($service->price, 0, ',', '.') }} đ</td>
                                <td>
                                    @if ($service->is_active)
                                        <span class="badge bg-success">Đang hoạt động</span>
                                    @else
                                        <span class="badge bg-danger">Tạm ngưng</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.edit', $service->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Chưa có dịch vụ nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
@endsection
