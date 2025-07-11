@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h2 class="mb-4">Danh Sách Ca Làm Việc</h2>
            <a href="{{ route('admin.staff_shifts.create') }}" class="btn btn-primary mb-4">Thêm mới</a>

            <div class="card p-4 text-center">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên ca</th>
                            <th>Giờ bắt đầu</th>
                            <th>Giờ kết thúc</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff_shifts as $key => $shift)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $shift->name }}</td>
                                <td>{{ date('H:i', strtotime($shift->start_time)) }}</td>
                                <td>{{ date('H:i', strtotime($shift->end_time)) }}</td>
                                <td>
                                    <a href="{{ route('admin.staff_shifts.edit', $shift->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.staff_shifts.destroy', $shift->id) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa ca này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
