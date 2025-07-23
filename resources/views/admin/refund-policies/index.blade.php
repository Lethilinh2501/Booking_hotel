@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="mb-4">Danh Sách Chính Sách Đền Bù</h2>

            <div class="mb-3">
                <a href="{{ route('admin.refund-policies.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Thêm Chính Sách
                </a>
            </div>

            <div class="card p-4">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên chính sách</th>
                            <th>Mô tả</th>
                            <th>Hoàn tiền (%)</th>
                            <th>Phí huỷ (%)</th>
                            <th>Ngày trước check-in</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($policies as $key => $policy)
                            <tr>
                                <td>{{ $policy->id }}</td>
                                <td>{{ $policy->name }}</td>
                                <td>{{ Str::limit($policy->description, 100) }}</td>
                                <td>{{ $policy->refund_percentage }}%</td>
                                <td>{{ $policy->cancellation_fee_percentage }}%</td>
                                <td>{{ $policy->days_before_checkin }} ngày</td>
                                <td>
                                    <span class="badge {{ $policy->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $policy->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.refund-policies.show', $policy->id) }}"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('admin.refund-policies.edit', $policy->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.refund-policies.destroy', $policy->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa chính sách này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Chưa có chính sách nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $policies->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
@endsection
