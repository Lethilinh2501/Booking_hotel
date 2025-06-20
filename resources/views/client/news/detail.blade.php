@extends('layout.client')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>

    <p class="text-muted">
        <strong>Đăng ngày:</strong> {{ $post->published_at->format('d/m/Y') }} |
        <strong>Tác giả:</strong> {{ $post->author->name ?? 'Không rõ' }} |
        <strong>Danh mục:</strong> {{ $post->category->name ?? 'Không có' }}
    </p>

    <p><strong>Trích đoạn:</strong> {{ $post->excerpt }}</p>

    <div>{!! nl2br(e($post->content)) !!}</div>

    <hr>
    <a href="{{ route('client.news.list') }}">← Quay lại danh sách</a>
@endsection
