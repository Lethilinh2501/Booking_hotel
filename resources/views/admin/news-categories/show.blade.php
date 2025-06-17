@extends('layout.admin')
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
    </style>
@endpush

@section('content')
    <main class="lh-main-content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chi tiết Tin tức</h5>
            <div>
                <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3>{{ $news->title }}</h3>
                    <div class="mb-3">
                        <span class="badge badge-{{ $news->status === 'published' ? 'success' : ($news->status === 'draft' ? 'warning' : 'secondary') }}">
                            {{ $news->status === 'published' ? 'Đã đăng' : ($news->status === 'draft' ? 'Bản nháp' : 'Lưu trữ') }}
                        </span>
                        @if($news->is_featured)
                            <span class="badge badge-primary ml-2">Nổi bật</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p><strong>Danh mục:</strong> {{ $news->category->name ?? '' }}</p>
                        <p><strong>Ngày đăng:</strong> {{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Chưa đăng' }}</p>
                        <p><strong>Ngày tạo:</strong> {{ $news->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Ngày cập nhật:</strong> {{ $news->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <h5>Tóm tắt</h5>
                        <p>{{ $news->excerpt }}</p>
                    </div>
                    <div>
                        <h5>Nội dung</h5>
                        <div class="content">
                            {!! $news->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if($news->image)
                        <div class="card">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection