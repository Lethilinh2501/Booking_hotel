@extends('layout.admin')

@section('content')
    <main class="lh-main-content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách Danh mục Tin tức</h5>
            {{-- Sửa route trỏ đến trang tạo danh mục --}}
            <a href="{{ route('admin.news-categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Danh mục</th>
                        <th>Mô Tả</th>
                        <!-- <th>Slug</th> -->
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->description }}</td>
        <td>
            <form action="{{ route('admin.news-categories.updateStatus', $category->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm {{ $category->status === 'active' ? 'btn-success' : 'btn-secondary' }}">
                    {{ $category->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                </button>
            </form>
        </td>
        <td>
            <a href="{{ route('admin.news-categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit">Sửa</i>
            </a>
            <form action="{{ route('admin.news-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash">Xóa</i>
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Không có dữ liệu.</td>
    </tr>
    @endforelse
</tbody>
            </table>

            {{-- Hiển thị phân trang nếu có --}}
            <div class="d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection