@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Thêm Chính Sách Đền Bù</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card p-4">
            <form action="{{ route('admin.refund-policies.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung mô tả</label>
                    <textarea name="content" class="form-control" rows="4">{{ old('content') }}</textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Phí phạt (%) <span class="text-danger">*</span></label>
                        <input type="number" name="penalty_percent" class="form-control"
                            value="{{ old('penalty_percent') }}" min="0" max="100" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Số ngày trước Check-in <span class="text-danger">*</span></label>
                        <input type="number" name="days_before_checkin" class="form-control"
                            value="{{ old('days_before_checkin') }}" min="0" required>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="is_active" class="form-select">
                        <option value="1" selected>Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Lưu
                    </button>
                    <a href="{{ route('admin.refund-policies.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
