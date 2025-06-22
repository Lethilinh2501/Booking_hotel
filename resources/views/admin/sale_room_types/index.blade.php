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
                <th>Giá Trị Khuyến Mãi</th>
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
                <td>
                    {{ $saleRoomType->value }}
                    {{ $saleRoomType->type == 'percent' ? '%' : 'VND' }}
                </td>
                <td>{{ $saleRoomType->start_date->format('d/m/Y') }} - {{ $saleRoomType->end_date->format('d/m/Y') }}</td>
                <td>
                    <span class="badge {{ $saleRoomType->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $saleRoomType->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.sale-room-types.edit', $saleRoomType->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.sale-room-types.destroy', $saleRoomType->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $saleRoomTypes->links() }}
</div>
</main>
@endsection