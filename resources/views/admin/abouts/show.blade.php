@extends('layout.admin')
@section('content')
<div class="container mt-4">
    <h2>Chi Tiết Giới Thiệu</h2>

    <div class="card p-3">
        <div class="mb-3">
            <strong>Nội dung:</strong>
            <p>{!! nl2br(e($about->about)) !!}</p>
        </div>

        <div class="mb-3">
            <strong>Hiển thị:</strong>
            <span class="badge bg-{{ $about->is_use ? 'success' : 'secondary' }}">
                {{ $about->is_use ? 'Đang dùng' : 'Không dùng' }}
            </span>
        </div>

        <div class="mb-3">
            <strong>Ngày tạo:</strong> {{ $about->created_at->format('d/m/Y H:i') }}
        </div>
    </div>

    <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
