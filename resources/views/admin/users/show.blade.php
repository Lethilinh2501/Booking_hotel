@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chi Tiết khách hàng </h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Họ và tên</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td>{{ $user->country }}</td>
                    </tr>
                    <tr>
                        <th>Thành phố</th>
                        <td>{{ $user->birth_date }}</td>
                    </tr>
                    <tr>
                        <th>Giới tính</th>
                        <td>
                         @if (!empty($user->gender))
                                <span class="badge" style="background-color: {{
                                        $user->gender == 'male' ? '#3399FF' : '#FF66CC'
                                    }}">
                                        {{ $user->gender }}
                                    </span>
                                @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Vai trò</th>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @if ($user->is_active)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Ngưng hoạt động</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-3">Quay lại</a>
            </div>
        </div>
    </main>
@endsection
