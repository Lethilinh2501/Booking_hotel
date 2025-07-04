@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chi Tiết Chương Trình Khuyến Mãi</h2>

            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Tên chương trình</th>
                        <td>{{ $sale->name }}</td>
                    </tr>
                    <tr>
                        <th>Loại phòng</th>
                        <td>{{ $sale->roomType->name ?? '---' }}</td>
                    </tr>
                    <tr>
                        <th>Giá trị</th>
                        <td>{{ $sale->value }} {{ $sale->type === 'percent' ? '%' : 'VNĐ' }}</td>
                    </tr>
                    <tr>
                        <th>Kiểu giảm giá</th>
                        <td>{{ $sale->type === 'percent' ? 'Phần trăm' : 'Cố định' }}</td>
                    </tr>
                    <tr>
                        <th>Thời gian áp dụng</th>
                        <td>
                            {{ $sale->start_date ? \Carbon\Carbon::parse($sale->start_date)->format('d/m/Y H:i') : '---' }}
                            đến
                            {{ $sale->end_date ? \Carbon\Carbon::parse($sale->end_date)->format('d/m/Y H:i') : '---' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @if ($sale->status === 'active')
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-danger">Không hoạt động</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <a href="{{ route('admin.sale_room_types.index') }}" class="btn btn-primary mt-3">
                    <i class="ri-arrow-go-back-line"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </main>
@endsection
