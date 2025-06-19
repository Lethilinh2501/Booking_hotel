@extends('layout.client')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>

    @if ($post->image)
        <img src="{{ asset('storage/uploads/' . $post->image) }}" alt="{{ $post->title }}" width="400">
    @endif

    <p><strong>Trích đoạn:</strong> {{ $post->excerpt }}</p>

    <div>{!! nl2br(e($post->content)) !!}</div>

    <hr>
    <a href="{{ route('client.news.list') }}">← Quay lại danh sách</a>
@endsection
