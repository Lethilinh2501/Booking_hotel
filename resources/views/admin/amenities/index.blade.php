@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="mb-4">Danh Sách Tiện Nghi</h2>
            <a href="{{ route('admin.amenities.create') }}" class="btn btn-primary mb-4">+ Thêm Tiện Nghi</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tên Tiện Nghi</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($amenities as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Hiện</span>
                                    @else
                                        <span class="badge bg-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.amenities.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.amenities.destroy', $item->id) }}"
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa tiện nghi này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Nếu amenities có phân trang --}}
                {{-- {{ $amenities->links('pagination::bootstrap-5') }} --}}
            </div>
        </div>
    </main>
@endsection
    