@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h2 class="mb-4">Danh Sách Nhân Viên</h2>
            <a href="{{ route('admin.staffs.addStaff') }}" class="btn btn-primary mb-4">Thêm mới</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listStaff as $key => $staff)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $staff->name }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->phone }}</td>
                                <td>{{ $staff->role ? $staff->role->name : 'Không có' }}</td>
                                <td>
                                    @if ($staff->is_active)
                                        <span class="badge bg-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-danger">Ngưng hoạt động</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.staffs.detailStaff', $staff->id) }}"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('admin.staffs.updateStaff', $staff->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.staffs.deleteStaff') }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa nhân viên này?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $staff->id }}">
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $listStaff->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
