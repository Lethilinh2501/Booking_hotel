@extends('layout.admin')

@section('content')

<div class="container mt-4">
    <h2>Sửa loại phòng</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ô kìa!</strong> Có lỗi rồi:<br><br>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.roomtypes.update', $roomType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên loại phòng</label>
            <input type="text" name="name" class="form-control" value="{{ $roomType->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $roomType->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá phòng (VND)</label>
            <input type="number" name="price" class="form-control" value="{{ $roomType->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sức chứa (người)</label>
            <input type="number" name="capacity" class="form-control" value="{{ $roomType->capacity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.roomtypes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
