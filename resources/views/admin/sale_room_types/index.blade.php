@extends('layout.admin')

@section('content')
<main class="lh-main-content">
<div class="container">
    <h1>Phòng Giảm Giá</h1>
    <a href="{{ route('admin.sale-room-types.create') }}" class="btn btn-primary mb-3">Tạo Mới</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Loại Phòng</th>
                <th>Giá Trị</th>
                <th>Loại</th>
                <th>Khoảng Thời Gian</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saleRoomTypes as $saleRoomType)
            <tr>
                <td>{{ $saleRoomType->id }}</td>
                <td>{{ $saleRoomType->name }}</td>
                <td>{{ $saleRoomType->roomType->name ?? 'N/A' }}</td>
                <td>{{ $saleRoomType->value }}</td>
                <td>{{ $saleRoomType->type }}</td>
                <td>{{ $saleRoomType->start_date->format('m/d/Y') }} - {{ $saleRoomType->end_date->format('m/d/Y') }}</td>
                <td>
                    <span class="badge {{ $saleRoomType->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $saleRoomType->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.sale-room-types.edit', $saleRoomType->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.sale-room-types.destroy', $saleRoomType->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <form action="{{ route('admin.sale-room-types.toggle-status', $saleRoomType->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $saleRoomType->status ? 'btn-secondary' : 'btn-success' }}">
                            {{ $saleRoomType->status ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $saleRoomTypes->links() }}
</div>
@endsection