@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h3 class="mb-4">Danh sách phòng đã xoá</h3>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary mb-4">← Quay về danh sách</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên phòng</th>
                            <th>Loại phòng</th>
                            <th>Tầng</th>
                            <th>Trạng thái</th>
                            <th>Ngày xoá</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $key => $room)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->roomType->name ?? 'Không xác định' }}</td>
                                <td>{{ $room->floor }}</td>
                                <td>{{ ucfirst($room->status) }}</td>
                                <td>{{ $room->deleted_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.rooms.restore', $room->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success"
                                            onclick="return confirm('Khôi phục phòng này?')">Khôi phục</button>
                                    </form>

                                    <form action="{{ route('admin.rooms.forceDelete', $room->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xoá vĩnh viễn?')">Xoá
                                            vĩnh viễn</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Không có phòng nào đã xoá</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $rooms->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
