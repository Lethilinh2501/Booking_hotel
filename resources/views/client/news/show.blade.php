@extends('layout.client')

@section('content')
<div class="container py-5">
    <h2 class="h2 text-dark mb-3">Chi tiết tin tức</h2>

    <div class="mb-4">
        <h2 class="h5 text-dark mb-2">{{ $post->title }}</h2>
        <p class="text-muted mb-1">Đăng ngày: {{ $post->published_at->format('d/m/Y') }}</p>
        <p class="text-muted">Tác giả: {{ $post->author->name ?? 'Không rõ' }} | 
            Danh mục: {{ $post->category->name ?? 'Không có' }}
        </p>
    </div>



    <div class="mb-4">
        <h2 class="h5 text-dark mb-3">Nội dung</h2>
        <div class="bg-light p-3 rounded">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

    <a href="{{ route('client.news.list') }}" class="btn btn-outline-secondary">
        ← Quay lại danh sách
    </a>
</div>
@endsection
