@extends('layout.admin')

@section('content')

<main class="lh-main-content">
    <div class="container-fluid">

        <h2 class="mb-4">Sửa Refund #{{ $refund->id }}</h2>

        {{-- Hiển thị lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Có lỗi rồi:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card p-4 shadow-sm">
            <form action="{{ route('admin.refunds.update', $refund->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Payment</label>
                    <select name="payment_id" class="form-select" required>
                        @foreach($payments as $payment)
                            <option value="{{ $payment->id }}" {{ $refund->payment_id == $payment->id ? 'selected' : '' }}>
                                #{{ $payment->id }} — {{ number_format($payment->amount, 0, ',', '.') }}đ
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Số tiền Refund</label>
                    <input type="number" name="amount" class="form-control" min="1" value="{{ $refund->amount }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $refund->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $refund->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $refund->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Cập nhật
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
