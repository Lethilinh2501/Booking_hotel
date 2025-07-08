@extends('layout.admin')

@section('content')
<main class="lh-main-content">

<div class="container">
    <h2>Thêm mới hệ thống</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.system.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên hệ thống</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>Logo (URL hoặc tên file)</label>
            <input type="text" name="logo" class="form-control" value="{{ old('logo') }}">
        </div>

        <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Điện thoại</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label>Bản đồ nhúng (iframe)</label>
            <textarea name="map" class="form-control" rows="3">{{ old('map') }}</textarea>
        </div>

        <div class="form-group">
            <label>Trạng thái hiển thị</label>
            <select name="is_use" class="form-control">
                <option value="1" {{ old('is_use') == '1' ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('is_use') == '0' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('admin.system.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
