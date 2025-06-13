@extends('admin.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📃 Danh sách chính sách khách sạn</h2>
        <div>
            <a href="{{ route('admin.policies.create') }}" class="btn btn-primary">➕ Thêm chính sách mới</a>
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
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($policies as $policy)
                <tr>
                    <td>{{ $policy->id }}</td>
                    <td>{{ $policy->title }}</td>
                    <td>{{ Str::limit($policy->content, 100) }}</td>
                    <td>
                        @if($policy->is_active)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.policies.edit', $policy->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>

                        <form action="{{ route('admin.policies.destroy', $policy->id) }}" method="POST" style="display:inline-block"
                              onsubmit="return confirm('Bạn có chắc muốn xoá chính sách này không?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">😢 Chưa có chính sách nào!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $policies->links() }}
    </div>

</div>
@endsection
