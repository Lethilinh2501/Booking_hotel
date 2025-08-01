@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">

        <h2 class="mb-4">Chi tiết yêu cầu hoàn tiền #{{ 'RF' . str_pad($refund->id, 5, '0', STR_PAD_LEFT) }}</h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card p-4 shadow-sm">
            <table class="table table-bordered align-middle text-center mb-4">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 250px">Thông tin</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Khách hàng</strong></td>
                        <td>
                            @if ($refund->payment && $refund->payment->booking && $refund->payment->booking->user)
                                {{ $refund->payment->booking->user->name }}<br>
                                <small class="text-muted">{{ $refund->payment->booking->user->email }}</small>
                            @else
                                <span class="text-muted fst-italic">Không có dữ liệu khách</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Payment ID</strong></td>
                        <td>#{{ optional($refund->payment)->id ?? 'Không có' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Số tiền hoàn</strong></td>
                        <td>{{ number_format($refund->amount, 0, ',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <td><strong>Trạng thái</strong></td>
                        <td>
                            @php
                                $status = strtolower($refund->status);
                                $badgeClass = match($status) {
                                    'pending'   => 'bg-warning',
                                    'approved'  => 'bg-success',
                                    'rejected'  => 'bg-danger',
                                    default     => 'bg-secondary',
                                };
                                $statusIcon = match($status) {
                                    'pending'   => '⏳',
                                    'approved'  => '✅',
                                    'rejected'  => '❌',
                                    default     => '❔',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $statusIcon }} {{ ucfirst($status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Ngày tạo yêu cầu</strong></td>
                        <td>{{ $refund->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>

            <h5 class="mb-3">Lịch sử giao dịch hoàn tiền</h5>
            <ul class="list-group">
                @forelse($refund->transactions as $transaction)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $transaction->description }}
                        <span class="text-muted small">
                            {{ $transaction->created_at->format('d/m/Y H:i') }}
                        </span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Không có giao dịch hoàn tiền nào.</li>
                @endforelse
            </ul>

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                </a>
                <a href="{{ route('admin.refunds.edit', $refund->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa
                </a>
            </div>
        </div>

    </div>
</main>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .badge {
        font-size: 0.9rem;
        padding: 0.4em 0.7em;
    }
</style>

@endsection
