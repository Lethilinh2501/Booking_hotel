@extends('layout.admin')



@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chi Tiết Nhân Viên</h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Họ và tên</th>
                        <td>{{ $staff->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $staff->email }}</td>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <td>{{ $staff->phone }}</td>
                    </tr>
                    <tr>
                        <th>Vai trò</th>
                        <td>{{ $staff->role->name ?? 'Không xác định' }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @if ($staff->is_active)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Ngưng hoạt động</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $staff->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $staff->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
                <a href="{{ route('admin.staffs.listStaff') }}" class="btn btn-primary mt-3">Quay lại</a>
            </div>
        </div>
    </main>
@endsection
