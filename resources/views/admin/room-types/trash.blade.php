@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h1>Thùng rác - Loại phòng</h1>
        <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary mb-3">← Về danh sách</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Sức chứa</th>
                    <th>Thời gian xóa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roomTypes as $roomType)
                    <tr>
                        <td>{{ $roomType->name }}</td>
                        <td>{{ number_format($roomType->price, 0, ',', '.') }} VNĐ</td>
                        <td>{{ $roomType->capacity }}</td>
                        <td>{{ $roomType->deleted_at->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('admin.room-types.restore', $roomType->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.room-types.force-delete', $roomType->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa vĩnh viễn loại phòng này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Không có loại phòng nào trong thùng rác.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div>{{ $roomTypes->links() }}</div>
    </div>
</main>
@endsection
