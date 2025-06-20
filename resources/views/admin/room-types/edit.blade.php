@extends('layout.admin')

@section('content')
<main class="lh-main-content">
    <div class="container-fluid">
        <h1>Sửa loại phòng</h1>

        <form action="{{ route('admin.room-types.update', $roomType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name">Tên loại phòng</label>
                <input type="text" name="name" class="form-control" value="{{ $roomType->name }}" required>
            </div>

            <div class="mb-3">
                <label for="price">Giá</label>
                <input type="number" name="price" class="form-control" value="{{ $roomType->price }}" required>
            </div>

            <div class="mb-3">
                <label for="capacity">Sức chứa</label>
                <input type="number" name="capacity" class="form-control" value="{{ $roomType->capacity }}" required>
            </div>

            <div class="mb-3">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control">{{ $roomType->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</main>
@endsection
