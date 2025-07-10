@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4">Danh sách Refund</h2>

        <a href="{{ route('admin.refunds.create') }}" class="btn btn-primary mb-3">+ Tạo Refund mới</a>

        <div class="card p-4">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Mã Payment</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refunds as $key => $refund)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $refund->payment->id ?? 'Không có' }}</td>
                            <td>{{ number_format($refund->amount, 0, ',', '.') }}đ</td>
                            <td>
                                @php
                                    $badgeClass = match (strtolower($refund->status)) {
                                        'pending' => 'bg-warning',
                                        'completed' => 'bg-success',
                                        'failed' => 'bg-danger',
                                        'processing' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($refund->status) }}</span>
                            </td>
                            <td>{{ $refund->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $refund->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hành động
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $refund->id }}">
                                        <li>
                                            <a href="{{ route('admin.refunds.show', $refund->id) }}" class="dropdown-item">
                                                <i class="bi bi-eye me-2"></i>Chi tiết
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.refunds.edit', $refund->id) }}" class="dropdown-item">
                                                <i class="bi bi-pencil-square me-2"></i>Sửa
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.refunds.destroy', $refund->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Xóa thật hông?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash me-2"></i>Xóa
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Phân trang --}}
            {{ $refunds->links('pagination::bootstrap-5') }}
        </div>
    </div>
</main>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .badge.bg-dark {
        background-color: #3c3c3c !important;
        color: #fff;
    }
    .badge.bg-info {
        background-color: #0dcaf0 !important;
        color: #fff;
    }
</style>

@endsection
