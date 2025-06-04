@extends('admin.layout.default')

@push('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #2980b9;
            color: white;
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <main class="container-fluid flex-grow-1 text-center">
        <div class="container mt-4">
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
                                        class="btn btn-info btn-sm">Chi
                                        tiết</a>
                                    <a href="{{ route('admin.staffs.updateStaff', $staff->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.staffs.deleteStaff', $staff->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa nhân viên này?')">
                                        @csrf
                                        @method('DELETE')
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
