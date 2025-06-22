@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Danh sách quy định</h2>
    <a href="{{ route('admin.rules.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rules as $rule)
            <tr>
                <td>{{ $rule->id }}</td>
                <td>{{ $rule->title }}</td>
                <td>{{ $rule->is_active ? 'Hoạt động' : 'Ẩn' }}</td>
                <td>
                    <a href="{{ route('admin.rules.edit', $rule->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.rules.destroy', $rule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa thật hả sếp?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
