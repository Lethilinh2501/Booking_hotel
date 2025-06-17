@extends('layout.admin')

@section('content')
    <main class="lh-main-content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách Tin tức</h5>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Ngày đăng</th>
                        <th>Nổi bật</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ Str::limit($item->title, 50) }}</td>
                        <td>{{ $item->category->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status === 'published' ? 'success' : 'warning' }}">
                                {{ $item->status === 'published' ? 'Đã đăng' : 'Bản nháp' }}
                            </span>
                        </td>
                        <td>{{ $item->published_at ? $item->published_at->format('d/m/Y') : 'Chưa đăng' }}</td>
                        <td>
                            <span class="badge badge-{{ $item->is_featured ? 'info' : 'secondary' }}">
                                {{ $item->is_featured ? 'Có' : 'Không' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Không có tin tức nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>
@endsection