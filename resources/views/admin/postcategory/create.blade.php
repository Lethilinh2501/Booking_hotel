@extends('admin.layout.default')

@push('style')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #2980b9;
            color: white;
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

        img.post-thumbnail {
            max-width: 120px;
            height: auto;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Thêm Danh mục Bài viết</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.postcategory.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                    placeholder="Nhập tên danh mục" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.postcategory.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
