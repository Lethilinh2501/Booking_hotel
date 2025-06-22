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

        img.post-thumbnail {
            max-width: 120px;
            height: auto;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <main class="lh-main-content">

    <main class="container-fluid flex-grow-1">
        <div class="container mt-4">
            <h2 class="mb-4">Chi Tiết Bài Viết</h2>
            <div class="card p-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Tiêu đề</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $post->slug }}</td>
                    </tr>
                    <tr>
                        <th>Trích dẫn</th>
                        <td>{{ $post->excerpt ?? 'Không có' }}</td>
                    </tr>
                    <tr>
                        <th>Nội dung</th>
                        <td>{!! nl2br(e($post->content)) !!}</td>
                    </tr>
                    <tr>
                        <th>Ảnh đại diện</th>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Ảnh đại diện" style="max-width: 200px;">
                            @else
                                Không có ảnh
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td>{{ $post->category->name ?? 'Không xác định' }}</td>
                    </tr>
                    <tr>
                        <th>Tác giả</th>
                        <td>{{ $post->author->name ?? 'Không xác định' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày đăng</th>
                        <td>{{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : 'Chưa đăng' }}</td>
                    </tr>
                    <tr>
                        <th>Bài nổi bật</th>
                        <td>
                            @if ($post->is_featured)
                                <span class="badge bg-warning text-dark">Nổi bật</span>
                            @else
                                <span class="badge bg-secondary">Không</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            @php
                                $statusClass = match ($post->status) {
                                    'draft' => 'badge-draft',
                                    'published' => 'badge-published',
                                    'archived' => 'badge-archived',
                                    default => 'badge-secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $statusColors[$post->status] ?? 'dark' }}">{{ ucfirst($post->status) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td>{{ $post->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
            </div>
        </div>
    </main>
@endsection
