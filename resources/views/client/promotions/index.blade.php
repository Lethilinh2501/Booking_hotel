@extends('layout.client')

@section('content')
    <section class="section-room-detsils padding-tb-100">
        <div class="container">
            <div class="row g-4">
                @foreach ($promotions as $promotion)
                    <div class="col-lg-6">
                        <div class="border rounded shadow-sm p-3 d-flex">
                            <!-- Column 1: Image + Hạn -->
                            <div class="d-flex flex-column align-items-center justify-content-center"
                                style="width: 100px; text-align: center;">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="coupon"
                                    class="img-fluid mb-2" style="width: 60px;">
                                <small class="text-muted">Hạn: {{ date('d-m-Y', strtotime($promotion->end_date)) }}</small>
                            </div>

                            <!-- Column 2: Nội dung -->
                            <div class="flex-grow-1 px-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $promotion->name }}</h5>
                                    <p class="mb-1 text-muted">
                                        Áp dụng: {{ date('d/m/Y', strtotime($promotion->start_date)) }} –
                                        {{ date('d/m/Y', strtotime($promotion->end_date)) }}
                                    </p>
                                    <p class="mb-1">
                                        Giảm tối đa: {{ number_format($promotion->max_discount_value) }}đ
                                    </p>
                                    <p class="h5 fw-bold text-danger">
                                        @if ($promotion->type === 'percent')
                                            - {{ $promotion->value }}%
                                        @else
                                            - {{ number_format($promotion->value) }}đ
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Column 3: Mã + Điều kiện -->
                            <div class="d-flex flex-column justify-content-between align-items-end" style="width: 180px;">
                                <div class="mb-2 text-end">
                                    <span
                                        class="fw-bold text-{{ strtotime($promotion->end_date) < time() ? 'danger' : 'success' }}">
                                        Ưu đãi {{ strtotime($promotion->end_date) < time() ? 'Hết hạn' : 'Hoạt động' }}
                                    </span>
                                </div>

                                <button type="button" class="btn btn-outline-success copy-code-btn fw-bold w-100 mb-2"
                                    data-code="{{ $promotion->code }}">
                                    {{ $promotion->code }}
                                </button>

                                <p class="small text-muted mb-0 text-end">
                                    * Đơn tối thiểu: <strong>{{ number_format($promotion->min_booking_amount) }}đ</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($promotions->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center fs-5">
                            Hiện chưa có mã giảm giá khả dụng 😢
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyCode(code) {
            navigator.clipboard.writeText(code).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Đã sao chép!',
                    text: `Mã ${code} đã được sao chép thành công`,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    background: '#fff',
                    iconColor: '#28a745',
                });
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Không thể sao chép mã',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#fff',
                    iconColor: '#dc3545',
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.copy-code-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const code = btn.getAttribute('data-code');
                    copyCode(code);
                });
            });
        });
    </script>
@endpush
<style>
    .row.g-4 {
        --bs-gutter-x: 2rem;
        --bs-gutter-y: 2rem;
        margin-top: 0;
        margin-bottom: 0;
    }

    .row.g-4>.col-lg-6 {
        display: flex;
    }

    .promo-card {
        width: 100%;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        padding: 1.25rem;
    }

    .promo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08);
    }
</style>
