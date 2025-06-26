@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Danh sách loại phòng</h2>
                <a href="{{ route('admin.roomtypes.create') }}" class="btn btn-primary">+ Thêm loại phòng</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Ảnh đại diện</th>
                                <th>Tên phòng</th>
                                <th>Giá</th>
                                <th>Sức chứa</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roomTypes as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">
                                        @php
                                            $mainImage = $item->roomTypeImages->where('is_main', true)->first();
                                        @endphp

                                        @if($mainImage)
                                            <img src="{{ asset('storage/' . $mainImage->image) }}" width="70" height="50" style="object-fit: cover;" class="rounded shadow-sm">
                                        @else
                                            <span class="text-muted">Không có ảnh</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price) }} đ</td>
                                    <td>{{ $item->max_capacity }} người</td>
                                    <td>
                                        @if($item->is_active)
                                            <span class="badge bg-success">Hiện</span>
                                        @else
                                            <span class="badge bg-secondary">Ẩn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.roomtypes.show', $item->id) }}" class="btn btn-info btn-sm">Xem</a>
                                            <a href="{{ route('admin.roomtypes.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('admin.roomtypes.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa loại phòng này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Không có dữ liệu loại phòng.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
<td class="text-center">
    @php
        $mainImage = $item->roomTypeImages->where('is_main', true)->first();
    @endphp

    @if($mainImage)
        <img src="{{ asset('storage/' . $mainImage->image) }}" width="70" height="50" style="object-fit: cover;" class="rounded shadow-sm">
    @else
        <span class="text-muted">Không có ảnh</span>
    @endif
</td>

