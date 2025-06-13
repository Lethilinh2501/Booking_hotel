@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Sửa tiện nghi: {{ $amenity->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form update --}}
    <form action="{{ route('admin.amenities.update', ['id' => $amenity->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên tiện nghi</label>
            <input type="text" name="name" value="{{ old('name', $amenity->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $amenity->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ $amenity->is_active ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ !$amenity->is_active ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
