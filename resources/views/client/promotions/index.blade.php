@extends('layout.client')

@section('content')
<section class="section-room-detsils padding-tb-100">
    <div class="container">
        <div class="row">
            <div class="row g-4">
                @foreach ($promotions as $promotion)
                    <div class="col-lg-6">
                        <div class="d-flex border rounded overflow-hidden shadow-sm h-100 p-3">
                            <!-- Left -->
                            <div class="me-3 d-flex flex-column align-items-center justify-content-center" style="width: 120px;">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="coupon" class="img-fluid mb-2" style="width:70px;">
                                <div class="small text-muted">Hạn: {{ date('d-m-Y', strtotime($promotion->end_date)) }}</div>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $promotion->name }}</h5>
                                    <p class="mb-1 text-muted">Áp dụng từ {{ date('d/m/Y', strtotime($promotion->start_date)) }} đến {{ date('d/m/Y', strtotime($promotion->end_date)) }}</p>
                                    <p class="mb-1">Giảm tối đa: {{ number_format($promotion->max_discount_value) }}đ</p>
                                    <p class="h5 fw-bold text-danger">
                                        @if ($promotion->type === 'percent')
                                            - {{ $promotion->value }}%
                                        @else
                                            - {{ number_format($promotion->value) }}đ
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <div class="mb-2">
                                        @if (strtotime($promotion->end_date) < time())
                                            <span class="badge bg-secondary">Ưu đãi Hết hạn</span>
                                        @else
                                            <span class="badge bg-success">Ưu đãi Hoạt động</span>
                                        @endif
                                    </div>

                                    <button type="button" class="btn btn-warning fw-bold w-100 mb-2 copy-code-btn" data-code="{{ $promotion->code }}">
                                        {{ $promotion->code }}
                                    </button>

                                    <p class="small text-muted mb-0">
                                        * Áp dụng cho đơn từ <span class="fw-bold">{{ number_format($promotion->min_booking_amount) }}đ</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($promotions->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center fs-5">Hiện chưa có mã giảm giá khả dụng 😢</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.copy-code-btn');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const code = button.getAttribute('data-code');
                navigator.clipboard.writeText(code).then(() => {
                    alert(`🎉 Đã copy mã: ${code}`);
                }).catch(err => {
                    console.error('Copy thất bại:', err);
                    alert('Có lỗi khi copy mã 😢');
                });
            });
        });
    });
</script>
@endpush
