@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Thêm Chính Sách Hoàn Tiền</h2>

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
                        <label class="form-label">Tên chính sách <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tỷ lệ hoàn tiền (%) <span class="text-danger">*</span></label>
                            <input type="number" name="refund_percentage" class="form-control"
                                value="{{ old('refund_percentage') }}" min="0" max="100" required>
                            @error('refund_percentage')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Số ngày trước Check-in <span class="text-danger">*</span></label>
                            <input type="number" name="days_before_checkin" class="form-control"
                                value="{{ old('days_before_checkin') }}" min="0" required>
                            @error('days_before_checkin')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-select" required>
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Không hoạt động</option>
                        </select>
                        @error('is_active')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Thêm
                        </button>
                        <a href="{{ route('admin.refund-policies.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
