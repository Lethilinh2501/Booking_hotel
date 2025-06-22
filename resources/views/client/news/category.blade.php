@extends('layout.client')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">Danh mục: {{ $category->name }}</h2>

    @if ($posts->count() > 0)
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark fw-semibold">{{ $post->title }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($post->excerpt, 100) }}</p>
                            <a href="{{ route('client.news.detail', $post->id) }}" class="btn btn-outline-primary mt-2 align-self-start">Xem chi tiết</a>
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
            Không có bài viết nào trong danh mục này.
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .card-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 0.95rem;
        color: #555;
    }

    .btn-outline-primary {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }

    h2 {
        font-size: 1.5rem;
    }
</style>
@endpush
