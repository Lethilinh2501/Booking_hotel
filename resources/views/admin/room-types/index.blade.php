@extends('layout.admin')

@section('content')
<main class="lh-main-content py-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📋 Danh sách loại phòng</h2>
            <a href="{{ route('admin.room-types.create') }}" class="btn btn-success">
                ➕ Thêm loại phòng
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col"> Tên phòng</th>
                            <th scope="col"> Giá</th>
                            <th scope="col"> Mô tả</th>
                            <th scope="col"> Sức chứa</th>
                            <th scope="col" style="width: 180px;"> Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roomTypes as $roomType)
                            <tr>
                                <td>{{ $roomType->name }}</td>
                                <td>{{ number_format($roomType->price, 0, ',', '.') }}VNĐ</td>
                                <td>{{ Str::limit($roomType->description, 50) }}</td>
                                <td>{{ $roomType->capacity }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.room-types.edit', $roomType) }}" class="btn btn-sm btn-warning">
                                            Sửa
                                        </a>
                                        <a href="{{ route('admin.room-types.show', $roomType) }}" class="btn btn-sm btn-info text-white">
                                            Xem
                                        </a>
                                        <form action="{{ route('admin.room-types.destroy', $roomType->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Không có loại phòng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $roomTypes->links() }}
        </div>
    </div>
</main>
@endsection
