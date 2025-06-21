@extends('layout.client')

@section('content')
    <!-- Banner -->
    <section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>Blog Classic</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                            </span>
                            <span> / </span>
                            <span>
                                <a href="javascript:void(0)">Blog Classic</a>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <div class="section-blog padding-tb-100">
        <div class="container">
            <div class="row">
                <!-- Danh sách bài viết -->
                <div class="col-lg-8">
                    @foreach ($posts as $post)
                        <div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1200">
                            <div class="lh-our-blog-image">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-100">
                                <div class="lh-our-blog-date">
                                    <h4>{{ $post->created_at->format('d') }}</h4>
                                    <span>{{ $post->created_at->format('M') }}</span>
                                </div>
                            </div>
                            <div class="lh-our-blog-contain">
                                <div class="lh-our-blog-contain-heading">
                                    <h4>
                                        <a href="">{{ $post->title }}</a>
                                    </h4>
                                    <span>By Admin - {{ $post->comments_count ?? 0 }} Comment</span>
                                </div>
                                <div class="lh-our-blog-contain-text">
                                    <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                </div>
                                <div class="lh-our-blog-contain-buttons">
                                    <a class="lh-buttons" href="">
                                        View More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Phân trang -->
                    <div class="mt-4 pagination-wrapper small-pagination">
                        {{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                <!-- Sidebar bên phải -->
                <div class="col-lg-4 blog-rs">
                    @include('client.layouts.blocks.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
<style>
    .pagination {
        font-size: 14px;
        padding: 0;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        padding: 4px 10px;
        font-size: 13px;
        border-radius: 4px;
    }
</style>
@endpush

