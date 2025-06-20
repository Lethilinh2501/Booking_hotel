@extends('layout.admin')

@section('content')

<div class="container mt-4">
    <h2>Sửa khuyến mãi: {{ $promotion->title }}</h2>

    <form action="{{ route('admin.promotions.update', $promotion->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $promotion->title }}" required>
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ $promotion->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Giảm giá (%)</label>
            <input type="number" name="discount_percent" class="form-control" value="{{ $promotion->discount_percent }}" required>
        </div>

        <div class="mb-3">
            <label>Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form-control" value="{{ $promotion->start_date }}" required>
        </div>

        <div class="mb-3">
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="form-control" value="{{ $promotion->end_date }}" required>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
