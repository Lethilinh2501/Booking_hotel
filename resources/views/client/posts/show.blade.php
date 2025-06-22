    @extends('layout.client')

    @section('content')
        <!-- Banner -->
        <section class="section-banner">
            <div class="row banner-image">
                <div class="banner-overlay"></div>
                <div class="banner-section">
                    <div class="lh-banner-contain">
                        <h2>Blog Detalis</h2>
                        <div class="lh-breadcrumb">
                            <h5>
                                <span class="lh-inner-breadcrumb">
                                    <a href="index.html">Home</a>
                                </span>
                                <span> / </span>
                                <span>
                                    <a href="javascript:void(0)">Blog Detalis</a>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog-details -->
        <section class="section-blog-details padding-tb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="lh-blog-details" data-aos="fade-up" data-aos-duration="1500">
                            <div class="lh-blog-details-image">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            </div>
                            <div class="lh-blog-details-contain">
                                <div class="blog-top-details">
                                    <span>By Admin</span> -
                                    <span>{{ $post->comments_count ?? 0 }} Comment</span> -
                                    <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                                </div>
                                <h4 class="lh-blog-details-heding">{{ $post->title }}</h4>
                                <p>{!! $post->content !!}</p>
                            </div>
                        </div>

                        <div class="lh-blog-relaxation" data-aos="fade-up" data-aos-duration="1500">
                            <div class="lh-blog-relaxation-tages">
                                <h4>Topics :</h4>
                                <span><a href="#">Entertainment</a></span>
                                <span><a href="#">Bloking</a></span>
                                <span><a href="#">Fitness</a></span>
                                <span><a href="#">Marketing</a></span>
                                <span><a href="#">Finance</a></span>
                            </div>
                        </div>

                        {{-- list comment  --}}
                        <div class="ld-blog-replic">
                            <h4 class="lh-blog-details-heding" data-aos="fade-up" data-aos-duration="1500">3 Replies to
                                "Simple Steps For Replacing Old Tiling"</h4>
                            <div class="ld-blog-replic-inner" data-aos="fade-up" data-aos-duration="1500">
                                <div class="ld-blog-replic-image">
                                    <img src="themes/client/assets/img/blog/busness-1.jpg" alt="busness-1">
                                </div>
                                <div class="ld-blog-replic-contain">
                                    <div class="d-flex">
                                        <h4 class="heading">Roberr Martin <span>- 22 Feb 2024</span></h4>
                                        <div class="ld-blog-star">
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                    </div>
                                    <p>This is the dolor sit amet consectetur adipisicing elit. Accusamus distinctio neque
                                        voluptates atque consequatur recusandae consectetur modi illum molestiae quam.</p>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                            <div class="ld-blog-replic-inner" data-aos="fade-up" data-aos-duration="1500">
                                <div class="ld-blog-replic-image">
                                    <img src="themes/client/assets/img/blog/busness-2.jpg" alt="busness-2">
                                </div>
                                <div class="ld-blog-replic-contain">
                                    <div class="d-flex">
                                        <h4 class="heading">Roberr Martin <span>- 11 Jan 2024</span></h4>
                                        <div class="ld-blog-star">
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                    </div>
                                    <p>This is the dolor sit amet consectetur adipisicing elit. Accusamus distinctio neque
                                        voluptates atque consequatur recusandae consectetur modi illum molestiae quam.</p>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                            <div class="ld-blog-replic-inner" data-aos="fade-up" data-aos-duration="1500">
                                <div class="ld-blog-replic-image">
                                    <img src="themes/client/assets/img/blog/busness-3.jpg" alt="busness-3">
                                </div>
                                <div class="ld-blog-replic-contain">
                                    <div class="d-flex">
                                        <h4 class="heading">Roberr Martin <span>- 31 Oct 2024</span></h4>
                                        <div class="ld-blog-star">
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                    </div>
                                    <p>This is the dolor sit amet consectetur adipisicing elit. Accusamus distinctio neque
                                        voluptates atque consequatur recusandae consectetur modi illum molestiae quam.</p>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>

                        {{-- form bình luận  --}}
                        <div class="ld-blog-leave" data-aos="fade-up" data-aos-duration="1500">
                            <h4 class="lh-blog-details-heding">Leave a Reply</h4>
                            <div class="lh-blog-address">
                                <span>Your email address Will not be Published</span>
                            </div>
                            <form action="#">
                                <div class="lh-blog-inner-form-warp">
                                    <textarea class="lh-form-control" placeholder="Comment"></textarea>
                                </div>
                                <div class="lh-blog-inner-form-warp">
                                    <input type="text" name="fullname" placeholder="Full Name"
                                        class="lh-form-control mr-30" required="">
                                    <input type="email" name="email" placeholder="Email" class="lh-form-control"
                                        required="">
                                </div>
                                <div class="lh-contact-touch-inner-form-button">
                                    <button class="lh-buttons result-placeholder" type="submit">
                                        Post Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Sidebar bên phải -->
                    <div class="col-lg-4 blog-rs">
                        @include('client.layouts.blocks.sidebar')
                    </div>
                </div>
            </div>
        </section>
    @endsection
