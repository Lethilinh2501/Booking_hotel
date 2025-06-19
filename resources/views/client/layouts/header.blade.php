<header>
    <div class="lh-top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 lh-top-social">
                    <div class="lh-mail">
                        <a>
                            <i class="ri-mail-line"></i>
                        </a>

                    </div>
                    <div class="lh-location">
                        <i class="ri-map-pin-line"></i>

                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 lh-top-social">
                    <div class="lh-phone">
                        <i class="ri-phone-line"></i>

                    </div>
                    <div class="lh-header-icons">
                        <a href="javascript:void(0)"><i class="ri-facebook-box-line facebook"></i></a>
                        <a href="javascript:void(0)"><i class="ri-twitter-x-line twitter"></i></a>
                        <a href="javascript:void(0)"><i class="ri-linkedin-box-line linkedin"></i></a>
                        <a href="javascript:void(0)"><i class="ri-instagram-line instagram"></i></a>
                        @if (Route::has('login'))
                            @auth
                                <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                                    <i class="ri-user-2-fill"></i> Tài khoản
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    {{-- <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mdi mdi-account"></i> Hồ sơ</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bookings.index') }}"><i class="ri-contacts-book-line"></i> Đơn đặt phòng</a></li>
                                    <li><a class="dropdown-item" href="{{ route('refunds.lists') }}"><i class="ri-reply-all-line"></i> Lịch sử hoàn tiền</a></li>
                                    <li><a class="dropdown-item" href="{{ route('payments.lists') }}"><i class="ri-bank-card-2-line"></i> Lịch sử giao dịch</a></li> --}}
                                    {{-- @hasanyrole('superadmin|admin|staff')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="ri-dashboard-3-line"></i> Truy cập quản trị</a></li>
                                    @endhasanyrole --}}
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="ri-logout-box-line me-2 ms-2"></i>Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a href="{{ route('login') }}"><i class="ri-user-2-fill"></i> Đăng nhập</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"><i class="ri-user-2-fill"></i> Đăng ký</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="lh-header">

    <div class="container">
        <nav class="navbar navbar-expand-lg">

            <a class="navbar-brand" href="">
                <img  alt="Logo" class="lh-logo">
            </a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-2-line"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="">Trang Chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="" >
                            Danh sách loại phòng
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="" >
                            Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="" >
                            Câu hỏi thường gặp
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="" >
                            Chính sách
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="" >
                            Liên hệ với cúng tôi
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

</header>
