@extends('layout.admin')

@section('content')
    <main class="lh-main-content">
        <div class="container-fluid">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-6 fw-bold mb-1">{{ $post->title }}</h1>
                    <p class="text-muted mb-0">
                        Bởi {{ optional($post->author)->name ?? 'Không rõ' }} •
                        {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : 'Chưa đăng' }}
                    </p>
                </div>
                <a href="{{ route('admin.post.listPost') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left-circle"></i> Quay lại
                </a>
            </div>

            {{-- Cover Image --}}
            @if ($post->image)
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Ảnh đại diện" class="img-fluid rounded-4 shadow"
                        style="max-height: 450px; object-fit: cover;">
                </div>
            @endif

            {{-- Badges --}}
            <div class="mb-4 d-flex flex-wrap gap-2">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    <i class="bi bi-folder"></i> {{ optional($post->category)->name ?? 'Không xác định' }}
                </span>
                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                    <i class="bi bi-check-circle"></i> {{ strtoupper($post->status) }}
                </span>
                @if ($post->is_featured)
                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                        <i class="bi bi-star-fill"></i> NỔI BẬT
                    </span>
                @endif
            </div>

            {{-- Excerpt --}}
            @if ($post->excerpt)
                <blockquote
                    class="blockquote px-3 py-2 bg-light rounded-3 fst-italic border-start border-4 border-primary mb-4">
                    {{ $post->excerpt }}
                </blockquote>
            @endif

            {{-- Content --}}
            <article class="mb-5" style="line-height: 1.8; font-size: 1.1rem;">
                {!! $post->content !!}
            </article>

            {{-- Metadata --}}
            <div class="text-muted small d-flex flex-wrap gap-4">
                <div>
                    <i class="bi bi-clock-history"></i> Tạo lúc: {{ $post->created_at->format('d/m/Y H:i') }}
                </div>
                <div>
                    <i class="bi bi-pencil-square"></i> Cập nhật: {{ $post->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </main>
@endsection
