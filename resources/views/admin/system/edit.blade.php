@extends('layout.admin')

@section('content')
<main class="lh-main-content">

<div class="container">
    <h2>Chỉnh sửa hệ thống</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.system.update', $system->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên hệ thống</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $system->name) }}">
        </div>

        <div class="form-group">
            <label>Logo (URL hoặc tên file)</label>
            <input type="text" name="logo" class="form-control" value="{{ old('logo', $system->logo) }}">
        </div>

        <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" required value="{{ old('address', $system->address) }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $system->email) }}">
        </div>

        <div class="form-group">
            <label>Điện thoại</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone', $system->phone) }}">
        </div>

        <div class="form-group">
            <label>Bản đồ nhúng (iframe)</label>
            <textarea name="map" class="form-control" rows="3">{{ old('map', $system->map) }}</textarea>
        </div>

        <div class="form-group">
            <label>Trạng thái hiển thị</label>
            <select name="is_use" class="form-control">
                <option value="1" {{ $system->is_use ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ !$system->is_use ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.system.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
