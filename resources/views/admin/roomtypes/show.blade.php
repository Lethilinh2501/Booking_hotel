@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Chi tiết loại phòng: {{ $roomType->name }}</h2>
            <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary">← Quay lại</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Thông tin loại phòng</h5>
                <p><strong>Tên:</strong> {{ $roomType->name }}</p>
                <p><strong>Giá:</strong> {{ number_format($roomType->price) }} đ</p>
                <p><strong>Sức chứa tối đa:</strong> {{ $roomType->max_capacity }} người</p>
                <p>
                    <strong>Trạng thái:</strong>
                    @if($roomType->is_active)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-secondary">Ẩn</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ảnh loại phòng</h5>
            </div>
            <div class="card-body">
                @if ($roomType->roomTypeImages->count())
                    <div class="row">
                        @foreach ($roomType->roomTypeImages as $image)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body text-center p-2">
                                        @if ($image->is_main)
                                            <span class="badge bg-success">Ảnh chính</span>
                                        @else
                                            <span class="badge bg-secondary">Ảnh phụ</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Chưa có ảnh cho loại phòng này.</p>
                @endif
            </div>
        </div>

    </div>
</main>
@endsection
