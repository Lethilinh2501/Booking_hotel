@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Cập nhật ca làm việc</h2>

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card p-4">
                <form action="{{ route('admin.staff_shifts.update', $shift->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Tên ca</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $shift->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Giờ bắt đầu</label>
                            <input type="time" name="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time', $shift->start_time) }}">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Giờ kết thúc</label>
                            <input type="time" name="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time', $shift->end_time) }}">
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.staff_shifts.index') }}" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </main>
@endsection
