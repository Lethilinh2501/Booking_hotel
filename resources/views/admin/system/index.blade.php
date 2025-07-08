@extends('layout.admin')

@section('content')
<main class="lh-main-content">

<div class="container">
    <h2>Danh sách hệ thống</h2>
    <a href="{{ route('admin.system.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($systems as $sys)
            <tr>
                <td>{{ $sys->name }}</td>
                <td>{{ $sys->email }}</td>
                <td>{{ $sys->phone }}</td>
                <td>{{ $sys->address }}</td>
                <td>{{ $sys->is_use ? 'Hiển thị' : 'Ẩn' }}</td>
                <td>
                    <a href="{{ route('admin.system.edit', $sys->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.system.destroy', $sys->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Xoá?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
