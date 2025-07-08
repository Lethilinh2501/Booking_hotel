@extends('layout.client')

@section('content')
<section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>Giới thiệu</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </span>
                            <span> / </span>
                            <span>
                                <a href="javascript:void(0)">Giới thiệu</a>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="section-about padding-tb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 theme-about rs-pb-24" data-aos="fade-up" data-aos-duration="2000">
                <img src="{{ asset('themes/client/assets/img/about/about-3.png') }}" alt="Giới thiệu">
            </div>
            <div class="col-lg-6 rs-pb-24" data-aos="fade-up" data-aos-duration="2000">
                <div class="lh-about-page">
                    <div class="banner t-left">
                        <h2>The world's best <span>Luxury Hotel</span></h2>
                    </div>

                    <div class="lh-about-paragraph">
                        @if($about)
                            {!! nl2br(e($about->about)) !!}
                        @else
                            <p>Chưa có nội dung giới thiệu.</p>
                        @endif
                    </div>

                    <div class="row ld-about-rows">
                        <div class="col-6">
                            <h4 class="lh-about-heading">
                                <i class="ri-arrow-right-up-line"></i>Our Mission
                            </h4>
                            <p>Đặt mục tiêu mang đến trải nghiệm khách sạn tốt nhất cho khách hàng.</p>
                        </div>
                        <div class="col-6">
                            <h4 class="lh-about-heading">
                                <i class="ri-arrow-right-up-line"></i>Our Vision
                            </h4>
                            <p>Trở thành chuỗi khách sạn hàng đầu tại Việt Nam và khu vực.</p>
                        </div>
                    </div>

                    <div class="lh-aboutpage-call">
                        <i class="ri-phone-line"></i> +84 987 654 321
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
