@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">

        <h2 class="mb-4">Chi tiết Refund #{{ $refund->id }}</h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card p-4 shadow-sm">
            <table class="table table-bordered align-middle text-center mb-4">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 200px">Thông tin</th>
                        <th>Giá trị</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Payment ID</strong></td>
                        <td>#{{ optional($refund->payment)->id ?? 'Không có' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Số tiền Refund</strong></td>
                        <td>{{ number_format($refund->amount, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <td><strong>Trạng thái</strong></td>
                        <td>
                            @php
                                $badgeClass = match(strtolower($refund->status)) {
                                    'pending'   => 'bg-warning',
                                    'approved'  => 'bg-success',
                                    'rejected'  => 'bg-danger',
                                    default     => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($refund->status) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Ngày tạo</strong></td>
                        <td>{{ $refund->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>

            <h5 class="mb-3">Refund Transactions</h5>
            <ul class="list-group">
                @forelse($refund->transactions as $transaction)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $transaction->description }}
                        <span class="text-muted small">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Chưa có transaction nào.</li>
                @endforelse
            </ul>

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại
                </a>
                <a href="{{ route('admin.refunds.edit', $refund->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Sửa
                </a>
            </div>
        </div>

    </div>
</main>

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
