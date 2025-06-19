@extends('layout.client')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary fw-bold">Tin tức mới nhất</h1>

    @if ($posts->count() > 0)
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($post->image)
                            <div class="image-container position-relative">
                                <h5 class="image-title position-absolute bg-primary text-white px-3 py-1 m-0">Ảnh</h5>
                                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-dark fw-bold">{{ $post->title }}</h3>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($post->excerpt, 100) }}</p>
                            <a href="{{ route('client.news.detail', $post->id) }}" class="btn btn-outline-primary mt-2 align-self-start fw-bold">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">
            Hiện tại chưa có bài viết nào.
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    h1 {
        font-size: 2rem;
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 0.5rem;
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
    
    .image-container {
        position: relative;
    }
    
    .image-title {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
        background-color: #0d6efd;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.9rem;
    }
    
    .card-title {
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
    }
    
    .card-text {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.5;
    }
    
    .btn-outline-primary {
        font-size: 0.9rem;
        padding: 0.375rem 0.75rem;
    }
</style>
@endpush