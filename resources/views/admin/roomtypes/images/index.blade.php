@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Danh sách ảnh loại phòng: {{ $roomType->name }}</h2>
                <div>
                    <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary me-2">Quay lại loại phòng</a>
                    <a href="{{ route('admin.roomtypes.images.create', $roomType->id) }}" class="btn btn-primary">+ Thêm ảnh mới</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Ảnh</th>
                                <th class="text-center">Ảnh chính</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roomType->roomTypeImages as $image)
                                <tr>
                                    <td class="text-center">{{ $image->id }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="" width="150" class="rounded shadow-sm">
                                    </td>
                                    <td class="text-center">
                                        @if ($image->is_main)
                                            <span class="badge bg-success">Ảnh chính</span>
                                        @else
                                            <span class="badge bg-secondary">Ảnh phụ</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.roomtypes.images.edit', [$roomType->id, $image->id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                                            <form action="{{ route('admin.roomtypes.images.edit', [$roomType->id, $image->id]) }}" method="POST" onsubmit="return confirm('Xóa ảnh này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Chưa có ảnh nào cho loại phòng này.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
