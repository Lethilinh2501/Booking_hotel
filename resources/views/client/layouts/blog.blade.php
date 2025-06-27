<!-- Blog -->
<section class="section-blog bg-gray padding-tb-100">
    <div class="container">
        <div class="banner" data-aos="fade-up" data-aos-duration="2000">
            <h2>Cập nhật thông tin cùng <span>chúng tôi</span></h2>
            <p>Hãy xem tin tức và blog mới nhất của chúng tôi và cập nhật thông tin!</p>
        </div>
        <div class="slick-slider blog-slider" data-aos="fade-up" data-aos-duration="2000">
            @foreach ($posts as $post)
                <div class="blog-card">
                    <figure>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="blog-image-top">
                    </figure>
                    <div class="lh-blog">
                        <div class="lh-blog-date">
                            <span>
                                <code>{{ $post->category->name ?? 'Tin tức' }}</code>
                                - {{ $post->created_at->format('d M Y') }}
                                - {{ $post->comments_count ?? 0 }} Bình luận
                            </span>
                        </div>
                        <a class="top-heding" href="{{ route('client.posts.show', $post->slug) }}">
                            {{ Str::limit($post->title, 80) }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
