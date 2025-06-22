@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h3 class="mb-4">Danh Sách Phòng</h3>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Thêm mới
                </a>
                <a href="{{ route('admin.rooms.trash') }}" class="btn btn-danger">
                    <i class="bi bi-trash3"></i> Thùng rác
                </a>
            </div>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên phòng</th>
                            <th>Loại phòng</th>
                            <th>Tầng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $key => $room)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->roomType->name ?? '---' }}</td>
                                <td>{{ $room->floor ?? 'Không rõ' }}</td>
                                <td>
                                    @if ($room->status == 'available')
                                        <span class="badge bg-success">Trống</span>
                                    @elseif ($room->status == 'booked')
                                        <span class="badge bg-warning text-dark">Đã đặt</span>
                                    @else
                                        <span class="badge bg-danger">Bảo trì</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-info btn-sm">Chi
                                        tiết</a>
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xoá phòng này?')"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $rooms->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
