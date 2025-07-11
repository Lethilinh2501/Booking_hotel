<!-- Tìm kiếm -->
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1400">
    <div class="lh-our-blog-serch-box">
        <form action="{{ route('client.posts.index') }}" method="GET" class="form-inline my-lg-0 d-flex">
            <input class="form-control" type="search" name="keyword" value="{{ request('keyword') }}"
                placeholder="Tìm bài viết..." aria-label="Search">
            <button class="lh-our-blog-button">
                <i class="ri-search-line"></i>
            </button>
        </form>
    </div>
</div>

<!-- Danh mục -->
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1600">
    <div class="lh-our-blog-categories">
        <div class="lh-our-blog-heading">
            <h4>Danh mục</h4>
        </div>
        <ul>
            @foreach ($postcategories as $category)
                <li>
                    <a href="{{ route('client.posts.byCategory', $category->id) }}"
                        class="d-flex justify-content-between align-items-center">
                        <code>*</code>
                        <p>{{ $category->name }}</p>
                        <span>[{{ $category->posts_count ?? 0 }}]</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Bài viết phổ biến -->
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1500">
    <div class="lh-our-blog-post">
        <div class="lh-our-blog-heading">
            <h4>Bài viết nổi bật</h4>
        </div>
        @foreach ($popularPosts as $item)
            <div class="row lh-our-blog-post-pb">
                <div class="col-12 lh-our-blog-post-inner">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    <div class="lh-our-blog-post-contain">
                        <span>{{ optional($item->published_at)->format('d/m/Y') }}</span>
                        <a href="{{ route('client.posts.show', $item->id) }}">
                            {{ Str::limit($item->title, 50) }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Tags (có thể tĩnh hoặc động nếu bạn có tags) -->
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="2000">
    <div class="lh-our-blog-tages">
        <div class="lh-our-blog-heading">
            <h4>Tags</h4>
        </div>
        <div class="lh-our-blog-tages-inner">
            <ul class="lh-our-blog-tages-inner-element">
                <li><a href="#">Entertainment</a></li>
                <li><a href="#">Booking</a></li>
                <li><a href="#">Gym</a></li>
                <li><a href="#">Hotel</a></li>
                <li><a href="#">Guests</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Instagram (HTML tĩnh) -->
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="2200">
    <div class="lh-our-blog-instagram">
        <div class="lh-our-blog-heading">
            <h4>Instagram</h4>
        </div>
        <div class="lh-our-blog-instagram-image">
            <div class="lh-our-blog-instagram-image-inner">
                @for ($i = 1; $i <= 8; $i++)
                    <a href="#"><img src="{{ asset("themes/client/assets/img/instagram/{$i}.jpg") }}"
                            alt="instagram"></a>
                @endfor
            </div>
        </div>
    </div>
</div>
