@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>📜 Danh sách nội quy</h2>

    <a href="{{ route('admin.rules.create') }}" class="btn btn-success mb-3">➕ Thêm nội quy mới</a>
     <a href="{{ route('admin.banners.listBanner') }}" class="btn btn-secondary">🏠 Về Trang chủ</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rules as $index => $rule)
                <tr>
                    <td>{{ $rules->firstItem() + $index }}</td>
                    <td>{{ $rule->title }}</td>
                    <td>{{ $rule->content }}</td>
                    <td>
                        @if($rule->is_active)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.rules.edit', $rule->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                        <form action="{{ route('admin.rules.destroy', $rule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xoá nội quy này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $rules->links() }}
</div>
@endsection
