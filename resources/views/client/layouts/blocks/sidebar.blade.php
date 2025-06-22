<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1200">
    <div class="lh-businessman-detalis">
        <div class="lh-businessman-detalis-image">
            <img src="themes/client/assets/img/blog/busness-1.jpg" alt="businessman">
        </div>
        <div class="lh-businessman-detalis-contain">
            <span>Hr Manager</span>
            <h4 class="lh-businessman-detalis-name">Martyn Garcia</h4>
            <p>This is the dolor sit amet consectetur adipisicing elit. voluptatum.</p>
            <div class="lh-businessman-detalis-logos">
                <img src="themes/client/assets/img/logo/facebook.png" alt="facebook">
                <img src="themes/client/assets/img/logo/twitter.png" alt="twitter">
                <img src="themes/client/assets/img/logo/instagram.png" alt="instagram">
                <img src="themes/client/assets/img/logo/linkedin.png" alt="linkedin">
            </div>
        </div>
    </div>
</div>
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1400">
    <div class="lh-our-blog-serch-box">
        <form class="form-inline my-lg-0 d-flex">
            <input class="form-conrol" type="search" placeholder="Search here" aria-label="Search">
            <button class="lh-our-blog-button">
                <i class="ri-search-line"></i>
            </button>
        </form>
    </div>
</div>
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1600">
    <div class="lh-our-blog-categories">
        <div class="lh-our-blog-heading">
            <h4>Categories</h4>
        </div>
        <ul>
    @foreach ($postcategories as $category)
        <li>
            <a href="{{ route('client.posts.byCategory', $category->id) }}" class="d-flex justify-content-between align-items-center">
                <code>*</code>
                    <p> {{ $category->name }}</p>
                <span>[{{ $category->posts_count ?? 0 }}]</span>
            </a>
        </li>
    @endforeach
</ul>

    </div>
</div>
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="1500">
    <div class="lh-our-blog-post">
        <div class="lh-our-blog-heading">
            <h4>Popular Post</h4>
        </div>
        <div class="row lh-our-blog-post-pb">
            <div class="col-12 lh-our-blog-post-inner">
                <img src="assets/img/blog/blog-1.jpg" alt="blog_post-1">
                <div class="lh-our-blog-post-contain">
                    <span>Feb 11,2024</span>
                    <a href="blog-details.html">Grandeur Voted Top Will Three Hotel...</a>
                </div>
            </div>
        </div>
        <div class="row lh-our-blog-post-pb">
            <div class="col-12 lh-our-blog-post-inner">
                <img src="assets/img/blog/blog-2.jpg" alt="blog_post-2">
                <div class="lh-our-blog-post-contain">
                    <span>May 22,2024</span>
                    <a href="blog-details.html">Enjoy Your Vacation With Your Beloved Partner</a>
                </div>
            </div>
        </div>
        <div class="row lh-our-blog-post-pb">
            <div class="col-12 lh-our-blog-post-inner">
                <img src="assets/img/blog/blog-3.jpg" alt="blog_post-3">
                <div class="lh-our-blog-post-contain">
                    <span>Sep 09,2024</span>
                    <a href="blog-details.html">The Best Hotels For Business Vacations</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="2000">
    <div class="lh-our-blog-tages">
        <div class="lh-our-blog-heading">
            <h4>Popular Tages</h4>
        </div>
        <div class="lh-our-blog-tages-inner">
            <ul class="lh-our-blog-tages-inner-element">
                <li><a href="#">Entertainment</a></li>
                <li><a href="#">Booking</a></li>
                <li><a href="#">Gym</a></li>
                <li><a href="#">Hotel</a></li>
                <li><a href="#">Entertainment</a></li>
                <li><a href="#">Guests</a></li>
                <li><a href="#">Entertainment</a></li>
                <li><a href="#">Booking</a></li>
                <li><a href="#">Gym</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="lh-our-blog" data-aos="fade-up" data-aos-duration="2200">
    <div class="lh-our-blog-instagram">
        <div class="lh-our-blog-heading">
            <h4>instagram</h4>
        </div>
        <div class="lh-our-blog-instagram-image">
            <div class="lh-our-blog-instagram-image-inner">
                <a href="#"><img src="themes/client/assets/img/instagram/1.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/2.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/3.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/4.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/5.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/6.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/7.jpg" alt="instagram"></a>
                <a href="#"><img src="themes/client/assets/img/instagram/8.jpg" alt="instagram"></a>
            </div>
        </div>
    </div>
</div>
