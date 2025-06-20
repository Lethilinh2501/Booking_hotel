@extends('layout.client')

@section('content')
    <!-- Banner -->
    <section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>Phòng</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="index.html">Trang chủ</a>
                            </span>
                            <span> / </span>
                            <span>
                                <a href="javascript:void(0)">Phòng</a>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms -->
    <section class="section-rooms bg-gray padding-tb-100">
        <div class="container">
            <div class="banner" data-aos="fade-up" data-aos-duration="2000">
                <h2>Chọn phòng của bạn <span>Room</span></h2>
            </div>
            <div class="row mtb-m-12">


                @foreach ($roomTypes as $roomType)
                    <div class="col-xl-6 col-md-6" data-aos="fade-up" data-aos-duration="1500">
                        <div class="rooms-card">
                            <img src="data:image/jpeg;base64,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"
                                alt="{{ $roomType->name }}">
                            <div class="details">
                                <h3>{{ $roomType->name }}</h3>
                                <span>{{ number_format($roomType->price, 0, ',', '.') }} / Đêm</span>
                                <ul>
                                    <li><i class="ri-group-line"></i>{{ $roomType->max_capacity }} Người</li>
                                    {{-- <li><i class="ri-hotel-bed-line"></i>1 Double Bed</li> <!-- Có thể thêm trường bed_type trong RoomType nếu cần -->
                                <li><i class="ri-restaurant-2-line"></i>Breakfast</li> <!-- Có thể thêm trường has_breakfast nếu cần --> --}}
                                    @if ($roomType->amenities->contains('name', 'Swimming Pool'))
                                        <li><i class="mdi mdi-pool"></i>Swimming Pool</li>
                                    @endif
                                    @if ($roomType->amenities->contains('name', 'Free Wifi'))
                                        <li><i class="ri-wifi-line"></i>Free Wifi</li>
                                    @endif
                                </ul>
                                <a href="" class="lh-buttons-2">Xem thêm <i
                                        class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach


                {{--
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="1500">
                <div class="rooms-card">
                    <img src="{{ asset('assets/client/assets/img/room/7.jpg')}}" alt="room">
            <div class="details">
                <h3>Family Rooms</h3>
                <span>$600 / Night</span>
                <ul>
                    <li><i class="ri-group-line"></i>2 Persons</li>
                    <li><i class="ri-hotel-bed-line"></i>1 Double Bed</li>
                    <li><i class="ri-restaurant-2-line"></i>Breakfast</li>
                    <li><i class="mdi mdi-pool"></i>Swimming Pool</li>
                    <li><i class="ri-wifi-line"></i>Free Wifi</li>
                </ul>
                <a href="#" class="lh-buttons-2">View More <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="1500">
        <div class="rooms-card">
            <img src="{{ asset('assets/client/assets/img/room/8.jpg')}}" alt="room">
            <div class="details">
                <h3>Deluxe Rooms</h3>
                <span>$800 / Night</span>
                <ul>
                    <li><i class="ri-group-line"></i>2 Persons</li>
                    <li><i class="ri-hotel-bed-line"></i>1 Double Bed</li>
                    <li><i class="ri-restaurant-2-line"></i>Breakfast</li>
                    <li><i class="mdi mdi-pool"></i>Swimming Pool</li>
                    <li><i class="ri-wifi-line"></i>Free Wifi</li>
                </ul>
                <a href="#" class="lh-buttons-2">View More <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="1500">
        <div class="rooms-card">
            <img src="{{ asset('assets/client/assets/img/room/9.jpg')}}" alt="room">
            <div class="details">
                <h3>Premium Rooms</h3>
                <span>$1000 / Night</span>
                <ul>
                    <li><i class="ri-group-line"></i>2 Persons</li>
                    <li><i class="ri-hotel-bed-line"></i>1 Double Bed</li>
                    <li><i class="ri-restaurant-2-line"></i>Breakfast</li>
                    <li><i class="mdi mdi-pool"></i>Swimming Pool</li>
                    <li><i class="ri-wifi-line"></i>Free Wifi</li>
                </ul>
                <a href="#" class="lh-buttons-2">View More <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="1500">
        <div class="rooms-card">
            <img src="{{ asset('assets/client/assets/img/room/10.jpg')}}" alt="room">
            <div class="details">
                <h3>VIP Rooms</h3>
                <span>$1200 / Night</span>
                <ul>
                    <li><i class="ri-group-line"></i>2 Persons</li>
                    <li><i class="ri-hotel-bed-line"></i>1 Double Bed</li>
                    <li><i class="ri-restaurant-2-line"></i>Breakfast</li>
                    <li><i class="mdi mdi-pool"></i>Swimming Pool</li>
                    <li><i class="ri-wifi-line"></i>Free Wifi</li>
                </ul>
                <a href="#" class="lh-buttons-2">View More <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="1500">
        <div class="rooms-card">
            <img src="{{ asset('assets/client/assets/img/room/11.jpg')}}" alt="room">
            <div class="details">
                <h3>VVIP Rooms</h3>
                <span>$1600 / Night</span>
                <ul>
                    <li><i class="ri-group-line"></i>2 Persons</li>
                    <li><i class="ri-hotel-bed-line"></i>1 Double Bed</li>
                    <li><i class="ri-restaurant-2-line"></i>Breakfast</li>
                    <li><i class="mdi mdi-pool"></i>Swimming Pool</li>
                    <li><i class="ri-wifi-line"></i>Free Wifi</li>
                </ul>
                <a href="#" class="lh-buttons-2">View More <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </div> --}}
            </div>
        </div>
    </section>

    <!-- Footer -->

    <!-- Tap to top -->
    <a href="#" class="back-to-top result-placeholder">
        <i class="ri-arrow-up-double-line"></i>
    </a>

    <!-- Side-tool -->
    <div class="tool-overlay"></div>
    <div class="lh-tool">
        <div class="lh-tool-btn">
            <button type="button" class="btn-lh-tool result-placeholder close-tool">
                <i class="ri-settings-line"></i>
            </button>
            <div class="color-variant">
                <div class="tool-header">
                    <h5>Tools</h5>
                </div>
                <div class="heading">
                    <h2>Select Color</h2>
                </div>
                <ul class="lh-color">
                    <li class="colors c1 active-colors">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c2">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c3">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c4">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c5">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c6">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c7">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c8">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c9">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="colors c10">
                        <span class="lh-all-color"></span>
                    </li>
                </ul>
                <div class="heading">
                    <h2>Dark mode</h2>
                </div>
                <ul class="dark-mode">
                    <li class="dark">
                        <span class="lh-all-color"></span>
                    </li>
                    <li class="white active-dark-mode">
                        <span class="lh-all-color"></span>
                    </li>
                </ul>
                <div class="heading">
                    <h2>Skin mode</h2>
                </div>
                <ul class="skin-mode">
                    <li class="skin-1">
                        <span class="lh-all-color"><img src="{{ asset('assets/client/assets/img/skin/1.png') }}"
                                alt="skin-1"></span>
                    </li>
                    <li class="skin-2">
                        <span class="lh-all-color"><img src="{{ asset('assets/client/assets/img/skin/2.png') }}"
                                alt="skin-2"></span>
                    </li>
                    <li class="skin-3 active">
                        <span class="lh-all-color"><img src="{{ asset('assets/client/assets/img/skin/3.png') }}"
                                alt="skin-3"></span>
                    </li>
                </ul>
                <div class="heading">
                    <h2>Border Radius Mode</h2>
                </div>
                <ul class="border-mode">
                    <li class="lh-radius radius-mode active-radius">
                        <span class="lh-all-color"><img src="{{ asset('assets/client/assets/img/skin/box-1.png') }}"
                                alt="skin-1"></span>
                    </li>
                    <li class="lh-radius radius-mode-none">
                        <span class="lh-all-color"><img src="{{ asset('assets/client/assets/img/skin/box-2.png') }}"
                                alt="skin-1"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/client/assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/client/assets/js/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/client/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/client/assets/js/vendor/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/client/assets/js/vendor/aos.js') }}"></script>
    <script src="{{ asset('assets/client/assets/js/vendor/semantic.min.js') }}"></script>
    <script src="{{ asset('assets/client/assets/js/vendor/slick.min.js') }}"></script>

    <!-- Main-js -->
    <script src="{{ asset('assets/client/assets/js/main.js') }}"></script>

    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                            "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                                .valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
@endsection
