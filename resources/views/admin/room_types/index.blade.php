@extends('layout.admin')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách loại phòng</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên loại phòng</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Sức chứa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roomTypes as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->description }}</td>
                    <td>{{ number_format($type->price) }} VND</td>
                    <td>{{ $type->capacity }} người</td>
                    <td>
                        <a href="{{ route('admin.roomtypes.edit', $type->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.roomtypes.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa loại phòng này hả sếp?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Chưa có loại phòng nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
