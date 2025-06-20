@extends('layout.client')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">Tin tức mới nhất</h1>
        <p class="lead text-muted">Cập nhật những thông tin mới nhất và hữu ích</p>
    </div>

    @if ($posts->count() > 0)
        <div class="row g-4">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden transition-all hover-shadow">
                        <div>
                             @if ($post->image)
                            <div class="position-relative">
                                @if ($post->category)
                                    <span class="badge bg-primary position-absolute top-10 start-10">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        </div>
                       
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <h3 class="card-title fw-bold text-dark">{{ $post->title }}</h3>
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i> 
                                    {{ $post->published_at->format('d/m/Y') }}
                                </small>
                            </div>
                            <p class="card-text text-secondary flex-grow-1">{{ Str::limit($post->excerpt, 120) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('client.news.detail', $post->id) }}" class="btn btn-primary stretched-link">
                                    Xem chi tiết <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle-fill me-2"></i>
            Hiện tại chưa có bài viết nào. Vui lòng quay lại sau!
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-img-top {
        transition: transform 0.5s ease;
    }
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
    }
    .btn-primary {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
    }
    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: "";
    }
</style>
@endpush

@push('scripts')
<!-- Thêm Bootstrap Icons nếu chưa có -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endpush