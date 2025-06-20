@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Danh sách Tiện nghi (Amenities)</h2>
    <a href="{{ route('admin.amenities.create') }}" class="btn btn-primary mb-3">+ Thêm tiện nghi</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên tiện nghi</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($amenities as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    @if($item->is_active)
                        <span class="badge bg-success">Hiện</span>
                    @else
                        <span class="badge bg-secondary">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.amenities.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.amenities.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa tiện nghi này?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
