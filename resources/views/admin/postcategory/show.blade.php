@extends('layout.admin')



@section('content')

    <main class="lh-main-content">
        <div class="container-fluid">
            <h2 class="mb-4">Chi Tiết Danh Mục Bài Viết</h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Tên danh mục</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Mô tả</th>
                        <td>{{ $category->description ?? 'Không có' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
                <a href="{{ route('admin.postcategory.index') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
            </div>
        </div>
    </main>
@endsection
