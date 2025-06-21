@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập Nhật Dịch Vụ</h2>

            <div class="card p-4">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên dịch vụ</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $service->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá dịch vụ</label>
                        <input type="number" step="any" min="1" class="form-control" id="price"
                            name="price" value="{{ old('price', $service->price) }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </main>
@endsection
