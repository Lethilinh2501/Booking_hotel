@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Sửa tiện nghi: <strong>{{ $amenity->name }}</strong></h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.amenities.update', $amenity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên tiện nghi</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $amenity->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="is_active" class="form-select">
                <option value="1" {{ $amenity->is_active ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ !$amenity->is_active ? 'selected' : '' }}>Ẩn</opti_
