@extends('layout.admin')

@section('content')
<main class="lh-main-content">

<div class="container">
    <h1 class="mb-3">Danh sách nội dung Giới thiệu</h1>

    <a href="{{ route('admin.about.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($abouts as $about)
                <tr>
                    <td>{{ $about->id }}</td>
                    <td>{{ Str::limit(strip_tags($about->about), 100) }}</td>
                    <td>
                        @if($about->is_use)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>{{ $about->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.about.edit') }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" style="display:inline-block;" 
                            onsubmit="return confirm('Bạn có chắc chắn muốn xoá không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Chưa có nội dung nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
