@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="mb-4">Danh sách yêu cầu hoàn tiền</h2>

        <div class="card p-4">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Mã</th>
                        <th>Khách Hàng</th>
                        <th>Số tiền</th>
                        <th>Trạng Thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refunds as $key => $refund)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ 'RF' . str_pad($refund->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                @if ($refund->payment && $refund->payment->booking && $refund->payment->booking->user)
                                    Người đặt: {{ $refund->payment->booking->user->name }}
                                @else
                                    <em>Không xác định</em>
                                @endif
                            </td>
                            <td>{{ number_format($refund->amount, 0, ',', '.') }} VNĐ</td>
                            <td>
                                @php
                                    $statusText = ucfirst($refund->status);
                                    $statusClass = match($refund->status) {
                                        'pending' => 'badge bg-warning',
                                        'processing' => 'badge bg-info',
                                        'completed' => 'badge bg-success',
                                        'failed' => 'badge bg-danger',
                                        default => 'badge bg-secondary'
                                    };
                                @endphp
                                <span class="{{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>{{ $refund->created_at->format('d-m-Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('admin.refunds.show', $refund->id) }}">
                                            <i class="bi bi-eye me-2"></i>Chi tiết</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.refunds.edit', $refund->id) }}">
                                            <i class="bi bi-pencil me-2"></i>Sửa</a></li>
                                        <li>
                                            <form action="{{ route('admin.refunds.destroy', $refund->id) }}" method="POST"
                                                  onsubmit="return confirm('Bạn có chắc muốn xoá?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash me-2"></i>Xoá
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

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $refunds->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</main>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .table td, .table th {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.4em 0.6em;
    }
</style>

@endsection
