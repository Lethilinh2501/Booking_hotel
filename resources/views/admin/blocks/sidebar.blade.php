<div class="lh-sidebar" data-mode="light">
    <div class="lh-sb-logo">
        <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/img/logo/full-logo.png') }}" alt="logo"></a>
    </div>

    <div class="lh-sb-wrapper">
        <div class="lh-sb-content">
            <ul class="lh-sb-list">
                <li class="lh-sb-item">
                    <a href="{{ route('admin.dashboard') }}"><i class="ri-dashboard-3-line"></i> Thống kê</a>
                </li>

                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Quản lý khách sạn</li>

                <li class="lh-sb-item sb-drop-item">
                    <a href="#" class="lh-drop-toggle"><i class="ri-image-line"></i> Banner <i class="drop-arrow ri-arrow-down-s-line"></i></a>
                    <ul class="lh-sb-drop">
                        <li><a href="{{ route('admin.banners.addBanner') }}">Thêm</a></li>
                        <li><a href="{{ route('admin.banners.listBanner') }}">Danh sách</a></li>
                    </ul>
                </li>
                <li class="lh-sb-item sb-drop-item">
 

                <li class="lh-sb-item sb-drop-item">
                    <a href="#" class="lh-drop-toggle"><i class="ri-user-line"></i> Nhân viên <i class="drop-arrow ri-arrow-down-s-line"></i></a>
                    <ul class="lh-sb-drop">
                        <li><a href="{{ route('admin.staffs.addStaff') }}">Thêm</a></li>
                        <li><a href="{{ route('admin.staffs.listStaff') }}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.bookings.index') }}"><i class="ri-hotel-bed-line"></i> Đặt phòng</a>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.amenities.index') }}"><i class="ri-service-line"></i> Tiện nghi</a>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.rules.index') }}"><i class="ri-book-2-line"></i> Quy định</a>
                </li>
                <li class="lh-sb-item">
    <a href="{{ route('admin.promotions.index') }}"><i class="ri-discount-percent-line"></i> Khuyến mãi</a>
</li>


                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Bài viết & Danh mục</li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.post.listPost') }}"><i class="ri-article-line"></i> Bài viết</a>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.postcategory.index') }}"><i class="ri-folder-line"></i> Danh mục bài viết</a>
                </li>

                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Quản lý khác</li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.promotions.index') }}"><i class="ri-discount-percent-line"></i> Khuyến mãi</a>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.payment.index') }}"><i class="ri-wallet-3-line"></i> Thanh toán</a>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('admin.contacts.index') }}"><i class="ri-phone-line"></i> Liên hệ</a>
                </li>

                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Hệ thống</li>

                <li class="lh-sb-item">
                    <a href="{{ route('profile') }}"><i class="ri-user-settings-line"></i> Tài khoản</a>
                </li>

                <li class="lh-sb-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-line"></i> Đăng xuất</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>
