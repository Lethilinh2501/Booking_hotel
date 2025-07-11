<div class="lh-sidebar" data-mode="light">
    <div class="lh-sb-logo">
        <a href="{{ route('admin.dashboard') }}" class="sb-full">
            <img src="{{ asset('themes/admin/assets/img/logo/full.png') }}" alt="logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="sb-collapse">
            <img src="{{ asset('themes/admin/assets/img/logo/logo_admin.png') }}" alt="logo">
        </a>
    </div>

    <div class="lh-sb-wrapper">
        <div class="lh-sb-content">
            <ul class="lh-sb-list">

                {{-- Trang chủ --}}
                <li class="lh-sb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="ri-dashboard-3-line"></i> <span>Thống kê</span>
                    </a>
                </li>

                {{-- Quản lý khách sạn --}}
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Quản lý khách sạn</li>

                <li class="lh-sb-item"><a href="{{ route('admin.bookings.index') }}"><i class="ri-hotel-bed-line"></i>
                        <span>Đặt phòng</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.roomtypes.index') }}"><i class="ri-hotel-bed-line"></i>
                        <span>loại phòng</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.rooms.index') }}"><i class="ri-home-8-line"></i>
                        <span>Phòng</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.services.index') }}"><i class="ri-service-line"></i>
                        <span>Dịch vụ phòng</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.servicesPlus.index') }}"><i class="ri-service-line"></i>
                        <span>Dịch vụ phòng Plus</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.amenities.index') }}"><i class="ri-service-line"></i>
                        <span>Tiện nghi</span></a></li>
                <li class="lh-sb-item">
    <a href="{{ route('admin.refund-policies.index') }}">
        <i class="ri-refund-line"></i>
        <span>Chính sách đền bù</span>
    </a>
</li>
                </li>
                {{-- Quản lý nội dung --}}
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Quản lý nội dung</li>

                {{-- Quản lý bài viết --}}
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-article-line"></i> <span>Bài viết <i
                                class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li><a href="{{ route('admin.postcategory.index') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Danh mục</a></li>
                        <li><a href="{{ route('admin.post.listPost') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Bài viết</a></li>
                    </ul>
                </li>

                {{-- Quản lý banner --}}
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-image-line"></i> <span>Banner <i
                                class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li><a href="{{ route('admin.banners.addBanner') }}" class="lh-page-link drop">Thêm</a></li>
                        <li><a href="{{ route('admin.banners.listBanner') }}" class="lh-page-link drop">Danh sách</a>
                        </li>
                    </ul>
                </li>

                {{-- Quản lý About --}}
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-information-line"></i> 
                        <span>Giới thiệu <i class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li><a href="{{ route('admin.about.create') }}" class="lh-page-link drop">Thêm</a></li>
                        <li><a href="{{ route('admin.about.index') }}" class="lh-page-link drop">Danh sách</a></li>
                    </ul>
                </li>

                {{-- Quản lý hệ thống --}}
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-settings-3-line"></i> <span>Hệ thống <i
                                class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li>
                            <a href="{{ route('admin.system.create') }}" class="lh-page-link drop">Thêm</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.system.index') }}" class="lh-page-link drop">Danh sách</a>
                        </li>
                    </ul>
                </li>

                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-image-line"></i> <span>FAQ <i class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li><a href="{{ route('admin.faqs.index') }}" class="lh-page-link drop">Danh sách</a>
                        </li>
                    </ul>
                </li>

                {{-- Nhân viên --}}
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-shield-user-line"></i> <span>Nhân viên <i
                                class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li><a href="{{ route('admin.staffs.listStaff') }}" class="lh-page-link drop">Nhân sự</a>
                        <li><a href="{{ route('admin.staff_shifts.index') }}" class="lh-page-link drop">Ca làm việc</a>
                        </li>
                        <li><a href="#" class="lh-page-link drop">Thùng rác</a></li>
                    </ul>
                </li>

                {{-- Quản lý khác --}}
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Khác</li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-user-2-fill"></i> <span>khách hàng <i
                                class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop" style="display: none;">
                        <li><a href="{{ route('admin.users.index') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Danh sách</a></li>
                        {{-- <li><a href="{{ route('admin.post.listPost') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Bài viết</a></li> --}}
                    </ul>
                </li>
                <li class="lh-sb-item"><a href="{{ route('admin.admin_accounts.index') }}"><i class="ri-phone-line"></i>
                        <span>Quản trị viên</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.reviews.index') }}"><i class="ri-phone-line"></i>
                        <span>Đánh giá</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.contacts.index') }}"><i class="ri-phone-line"></i>
                        <span>Liên hệ</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.promotions.index') }}"><i
                            class="ri-discount-percent-line"></i> <span>Khuyến mãi</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.sale_room_types.index') }}"><i
                            class="ri-discount-percent-line"></i> <span>Khuyến mãi loại phòng</span></a></li>
                <li class="lh-sb-item"><a href="{{ route('admin.payment.index') }}"><i class="ri-wallet-3-line"></i>
                        <span>Thanh toán</span></a></li>

                {{-- Tài khoản --}}
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title">Tài khoản</li>
                <li class="lh-sb-item"><a href="{{ route('profile') }}"><i class="ri-user-settings-line"></i>
                        <span>Cá
                            nhân</span></a></li>
                <li class="lh-sb-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-line"></i> <span>Đăng xuất</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
