@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Thêm Dịch Vụ Mới</h2>

            <div class="card p-4">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên dịch vụ</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá (VNĐ)</label>
                        <input type="number" class="form-control" id="price" name="price" step="any"
                            min="1" value="{{ old('price') }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Thêm dịch vụ</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </main>
@endsection
