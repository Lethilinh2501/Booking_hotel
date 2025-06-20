@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <h2 class="mb-4">Danh Sách Bài Viết</h2>
            <a href="{{ route('admin.post.addPost') }}" class="btn btn-primary mb-4">Thêm mới</a>

            <div class="card p-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listPost as $key => $post)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td title="{{ $post->title }}">{{ Str::limit($post->title, 50, '...') }}</td>

                                <td>{{ $post->category->name ?? 'Không có' }}</td>
                                <td>{{ $post->author->name ?? 'Không rõ' }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'draft' => 'secondary',
                                            'published' => 'success',
                                            'archived' => 'warning',
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$post->status] ?? 'dark' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.post.detailPost', $post->id) }}"
                                        class="btn btn-info btn-sm">Chi tiết</a>
                                    <a href="{{ route('admin.post.updatePost', $post->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.post.deletePost') }}" method="POST"
                                        style="display:inline;" onsubmit="return confirm('Xác nhận xóa bài viết này?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $listPost->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </main>
@endsection
