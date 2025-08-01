@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">🛠️ Sửa Yêu Cầu Hoàn Tiền</h2>

        {{-- Hiển thị lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.refunds.update', $refund->id) }}">
            @csrf
            @method('PUT')

            {{-- Chọn thanh toán liên quan --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">💳 Thanh toán liên quan</label>
                <select name="payment_id" class="form-select" required>
                    @foreach($payments as $payment)
                        <option value="{{ $payment->id }}" {{ $refund->payment_id == $payment->id ? 'selected' : '' }}>
                            #{{ $payment->id }} — {{ number_format($payment->amount, 0, ',', '.') }} VND — {{ $payment->created_at->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Trạng thái yêu cầu --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">📌 Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="pending" {{ $refund->status == 'pending' ? 'selected' : '' }}>⏳ Đang chờ</option>
                    <option value="approved" {{ $refund->status == 'approved' ? 'selected' : '' }}>✅ Đã duyệt</option>
                    <option value="rejected" {{ $refund->status == 'rejected' ? 'selected' : '' }}>❌ Từ chối</option>
                </select>
            </div>

            {{-- Nút submit --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
                <a href="{{ route('admin.refunds.index') }}" class="btn btn-secondary">↩ Quay lại</a>
            </div>
        </form>
    </div>
</main>
@endsection
