@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <div class="lh-page-title d-flex justify-content-between align-items-center mb-4">
                <div class="lh-breadcrumb">
                    <h3>Danh sách chương trình khuyến mãi</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li>Khuyến mãi</li>
                    </ul>
                </div>
                <a href="{{ route('admin.sale_room_types.create') }}" class="btn btn-primary">
                    <i class="ri-add-line"></i> Thêm mới
                </a>
            </div>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Tên chương trình</th>
                                <th>Loại phòng</th>
                                <th>Giá trị</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sale->name }}</td>
                                    <td>{{ $sale->roomType->name ?? '-' }}</td>
                                    <td>
                                        {{ $sale->value }}
                                        {{ $sale->type === 'percent' ? '%' : 'VNĐ' }}
                                    </td>
                                    <td>
                                        {{ $sale->start_date ? \Carbon\Carbon::parse($sale->start_date)->format('d/m/Y') : '---' }}
                                        <br>
                                        đến
                                        {{ $sale->end_date ? \Carbon\Carbon::parse($sale->end_date)->format('d/m/Y') : '---' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $sale->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ $sale->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.sale_room_types.show', $sale->id) }}"
                                                class="btn btn-sm btn-info" title="Xem chi tiết">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('admin.sale_room_types.edit', $sale->id) }}"
                                                class="btn btn-sm btn-warning" title="Sửa">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <form action="{{ route('admin.sale_room_types.destroy', $sale->id) }}"
                                                method="POST" style="display: inline-block;"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Xóa">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Không có chương trình khuyến mãi nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
