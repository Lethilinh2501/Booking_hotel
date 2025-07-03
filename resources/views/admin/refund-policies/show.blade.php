@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">

        <!-- Hiển thị thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4">Chi Tiết Chính Sách Đền Bù</h2>

        <div class="mb-3">
            <a href="{{ route('admin.refund-policies.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Thêm Chính Sách
            </a>
            <a href="{{ route('admin.refund-policies.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Quay lại
            </a>
        </div>

        <div class="card p-4 shadow-sm">
            <h4 class="mb-3">{{ $policy->title }}</h4>

            <!-- Hiển thị thông tin chính sách -->
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">
                    <strong>Nội dung:</strong> {{ $policy->content }}
                </li>
                <li class="list-group-item">
                    <strong>Phí phạt:</strong> {{ $policy->penalty_percent }}%
                </li>
                <li class="list-group-item">
                    <strong>Số ngày trước Check-in:</strong> {{ $policy->days_before_checkin }} ngày
                </li>
                <li class="list-group-item">
                    <strong>Trạng thái:</strong>
                    <span class="badge rounded-pill {{ $policy->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $policy->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </li>
            </ul>

            <!-- Các nút hành động -->
            <div class="d-flex gap-2">
                <a href="{{ route('admin.refund-policies.edit', $policy->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square me-1"></i> Sửa
                </a>
                <form action="{{ route('admin.refund-policies.destroy', $policy->id) }}" method="POST" class="d-inline" 
                    onsubmit="return confirm('Bạn chắc chắn muốn xóa chính sách này?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
