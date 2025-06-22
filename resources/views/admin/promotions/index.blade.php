@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">

            {{-- Thông báo thành công --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <h2 class="mb-4">Danh Sách Khuyến Mãi</h2>
            <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary mb-3">+ Thêm khuyến mãi</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Mã</th>
                            <th>Giá trị</th>
                            <th>Loại</th>
                            <th>Số lượng</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promotions as $key => $promo)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $promo->name }}</td>
                                <td>{{ $promo->code }}</td>
                                <td>
                                    {{ $promo->type == 'percent' ? $promo->value . '%' : number_format($promo->value, 0, ',', '.') . 'đ' }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $promo->type == 'percent' ? 'info' : 'secondary' }}">
                                        {{ $promo->type == 'percent' ? 'Phần trăm' : 'Giá cố định' }}
                                    </span>
                                </td>
                                <td>{{ $promo->quantity }}</td>
                                <td>{{ \Carbon\Carbon::parse($promo->start_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($promo->end_date)->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $statusColors = ['active' => 'success', 'inactive' => 'danger'];
                                        $statusText = ['active' => 'Đang hoạt động', 'inactive' => 'Hết hạn'];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$promo->status] ?? 'dark' }}">
                                        {{ $statusText[$promo->status] ?? 'Không rõ' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.promotions.edit', $promo->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.promotions.destroy', $promo->id) }}" method="POST"
                                        style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $promotions->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
@endsection
