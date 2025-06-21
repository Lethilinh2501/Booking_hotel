@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h2 class="mb-4">Thêm Khuyến Mãi</h2>

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
            <form action="{{ route('admin.promotions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Tên khuyến mãi</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Nhập tên khuyến mãi" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="discount" class="form-label">Giảm giá (%)</label>
                    <input type="number" class="form-control" id="discount" name="discount"
                        placeholder="Ví dụ: 20" value="{{ old('discount') }}" min="0" max="100">
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                        {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Hiển thị khuyến mãi
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
            </form>
        </div>
    </div>
</main>
@endsection
