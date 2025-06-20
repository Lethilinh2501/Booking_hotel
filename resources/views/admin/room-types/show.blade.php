@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h1 class="mb-4">Chi tiết loại phòng</h1>

            <div class="card p-4 shadow-sm">
                <div class="mb-3">
                    <h3 class="mb-0">{{ $roomType->name }}</h3>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Giá:</label>
                    <div>{{ number_format($roomType->price, 0, ',', '.') }} VNĐ</div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Sức chứa:</label>
                    <div>{{ $roomType->capacity }} người</div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Mô tả:</label>
                    <div>{{ $roomType->description ?: 'Không có mô tả' }}</div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.room-types.edit', $roomType->id) }}" class="btn btn-warning me-2">Sửa</a>
                    <a href="{{ route('admin.room-types.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </main>
@endsection
