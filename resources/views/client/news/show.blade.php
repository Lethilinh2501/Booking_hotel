@extends('layout.client')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ $post->title }}</h1>
    <p class="text-muted">Đăng ngày: {{ $post->published_at->format('d/m/Y') }}</p>

    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-4" alt="{{ $post->title }}">
    @endif

    <div>
        {!! nl2br(e($post->content)) !!}
    </div>

    <a href="{{ route('client.news.list') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
</div>
@endsection
