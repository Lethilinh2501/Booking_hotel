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
        <h2 class="mb-4">Danh sách Danh mục Bài viết</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.postcategory.create') }}" class="btn btn-primary mb-3">Thêm Danh Mục</a>

        <div class="card p-4">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.postcategory.show', $category->id) }}"
                                    class="btn btn-info btn-sm">Xem</a>
                                <a href="{{ route('admin.postcategory.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.postcategory.destroy', $category->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Không có danh mục nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
