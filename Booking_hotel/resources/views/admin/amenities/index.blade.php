@extends('admin.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📃 Danh sách tiện nghi khách sạn</h2>
        <div>
            <a href="{{ route('admin.amenities.create') }}" class="btn btn-primary">➕ Thêm tiện nghi mới</a>
            <a href="{{ route('admin.banners.listBanner') }}" class="btn btn-secondary">🏠 Về Trang chủ</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Tên tiện nghi</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($amenities as $amenity)
                <tr>
                    <td>{{ $amenity->id }}</td>
                    <td>{{ $amenity->name }}</td>
                    <td>{{ $amenity->description ?? 'Không có mô tả' }}</td>
                    <td>
                        @if($amenity->is_active)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.amenities.edit', $amenity->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>

                        <form action="{{ route('admin.amenities.destroy', $amenity->id) }}" method="POST" style="display:inline-block"
                              onsubmit="return confirm('Bạn có chắc muốn xoá tiện nghi này không?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Xoá</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Chưa có tiện nghi nào!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $amenities->links() }}
    </div>
</div>
@endsection
