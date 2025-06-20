@extends('layout.admin')
@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            <h1>Thêm loại phòng</h1>

            <form action="{{ route('admin.room-types.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Tên loại phòng</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="price">Giá</label>  
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description">Mô tả</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="capacity">Số người tối đa</label>
                    <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </main>
@endsection
