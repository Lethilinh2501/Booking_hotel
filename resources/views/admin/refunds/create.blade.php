@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Tạo Refund mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Có lỗi rồi:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card p-4 shadow-sm">
            <form action="{{ route('admin.refunds.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="payment_id" class="form-label fw-semibold">Chọn Payment</label>
                    <select name="payment_id" id="payment_id" class="form-select" required>
                        <option value="">-- Chọn Payment --</option>
                        @foreach ($payments as $payment)
                            <option value="{{ $payment->id }}">
                                #{{ $payment->id }} — {{ number_format($payment->amount, 0, ',', '.') }}đ
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label fw-semibold">Số tiền Refund</label>
                    <input type="number" name="amount" id="amount" class="form-control" min="1" required placeholder="Nhập số tiền hoàn (đ)">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">Trạng thái</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="pending">Pending</option>
                        <option value="refunded">Refunded</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Lưu
                    </button>
                    <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection
