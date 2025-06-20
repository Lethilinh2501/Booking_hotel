<div class="lh-sidebar" data-mode="light">
    <div class="lh-sb-logo">
        <a href="index.html" class="sb-full"><img src="assets/img/logo/full-logo.png" alt="logo"></a>
        <a href="index.html" class="sb-collapse"><img src="assets/img/logo/collapse-logo.png" alt="logo"></a>
    </div>
    <div class="lh-sb-wrapper">
        <div class="lh-sb-content">
            <ul class="lh-sb-list">
                <li class="lh-sb-item sb-drop-item">
                    <a href="{{ route('admin.dashboard') }}" class="lh-drop-toggle">
                        <i class="ri-dashboard-3-line"></i>
                        <span class="condense">Thống kê</span>
                    </a>
                    {{-- <ul class="lh-sb-drop condense" style="display: none;">
								<li class="list"><a href="index.html" class="lh-page-link drop"><i class="ri-git-commit-line"></i>Report</a></li>
							</ul> --}}
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Apps</li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-shield-user-line"></i><span class="condense">Quản lý banner<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li><a href="{{ route('admin.banners.addBanner') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Thêm</a></li>
                        <li><a href="{{ route('admin.banners.listBanner') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i> Danh sách</a></li>
                        {{-- <li><a href="team-update.html" class="lh-page-link drop"><i class="ri-git-commit-line"></i>Team Update</a></li>
								<li><a href="team-list.html" class="lh-page-link drop"><i class="ri-git-commit-line"></i>Team List</a></li> --}}
                    </ul>
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Apps</li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-shield-user-line"></i><span class="condense">Quản lý Nhân viên<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li><a href="{{ route('admin.staffs.listStaff') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Thêm</a></li>
                        <li><a href="{{ route('admin.staffs.addStaff') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i> Danh sách</a></li>
                        <li><a href="" class="lh-page-link drop"><i class="ri-git-commit-line"></i> Thùng rác</a>
                        </li>
                        {{-- <li><a href="team-update.html" class="lh-page-link drop"><i class="ri-git-commit-line"></i>Team Update</a></li>
								<li><a href="team-list.html" class="lh-page-link drop"><i class="ri-git-commit-line"></i>Team List</a></li> --}}
                    </ul>
                </li>



                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Apps</li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-shield-user-line"></i><span class="condense">Quản lý liên hệ<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li><a href="{{ route('admin.contacts.index') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Danh sách</a></li>
                    </ul>
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Apps</li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-shield-user-line"></i><span class="condense">Quản lý danh mục<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li><a href="{{ route('admin.postcategory.index') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Danh sách</a></li>
                    </ul>
                </li>


                <li class="lh-sb-item">
                    <a href="guest-details.html" class="lh-page-link">
                        <i class="ri-user-search-line"></i><span class="condense"><span class="hover-title">Tài khoản
                                Details</span> </span>
                    </a>
                </li>

                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-home-8-line"></i>
                        <span class="condense">Quản lý loại phòng<i class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li>
                            <a href="{{ route('admin.room-types.index') }}" class="lh-page-link drop">
                                <i class="ri-git-commit-line"></i>Danh sách loại phòng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.room-types.create') }}" class="lh-page-link drop">
                                <i class="ri-git-commit-line"></i>Thêm loại phòng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.room-types.trash') }}" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i> Thùng rác</a>
                        </li>

                    </ul>
                </li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-home-8-line"></i>
                        <span class="condense">About<i class="drop-arrow ri-arrow-down-s-line"></i></span>
                    </a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li>
                            <a href="{{ route('admin.abouts.index') }}" class="lh-page-link drop">
                                <i class="ri-git-commit-line"></i>Về chúng tôi
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.about.index') }}" class="lh-page-link drop">
                                <i class="ri-git-commit-line"></i>Thêm loại phòng
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="lh-sb-item">
                    <a href="bookings.html" class="lh-page-link">
                        <i class="ri-contacts-book-line"></i><span class="condense"><span class="hover-title">Đặt
                                phòng</span>
                        </span>
                    </a>
                </li>
                <li class="lh-sb-item">
                    <a href="{{ route('admin.payment.index') }}" class="lh-page-link">
                        <i class="ri-bill-line"></i><span class="condense"><span class="hover-title">Thanh
                                toán</span> </span>
                    </a>
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Restaurant</li>
                <li class="lh-sb-item">
                    <a href="menu.html" class="lh-page-link">
                        <i class="ri-restaurant-2-line"></i><span class="condense"><span
                                class="hover-title">Menu</span> </span>
                    </a>
                </li>
                <li class="lh-sb-item">
                    <a href="menu-add.html" class="lh-page-link">
                        <i class="ri-restaurant-2-line"></i><span class="condense"><span class="hover-title">Add
                                Menu</span> </span>
                    </a>
                </li>
                <li class="lh-sb-item">
                    <a href="orders.html" class="lh-page-link">
                        <i class="ri-bookmark-3-line"></i><span class="condense"><span
                                class="hover-title">Orders</span> </span>
                    </a>
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Extra</li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-pages-line"></i><span class="condense">Authentication<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li><a href="signin.html" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Login</a></li>
                        <li><a href="signup.html" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Signup</a></li>
                        <li><a href="forgot.html" class="lh-page-link drop"><i class="ri-git-commit-line"></i>Forgot
                                password</a>
                        </li>
                        <li><a href="reset-password.html" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Reset
                                password</a></li>
                    </ul>
                </li>
                <li class="lh-sb-item sb-drop-item">
                    <a href="javascript:void(0)" class="lh-drop-toggle">
                        <i class="ri-service-line"></i><span class="condense">Service pages<i
                                class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                    <ul class="lh-sb-drop condense" style="display: none;">
                        <li><a href="404-error-page.html" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>404 error</a>
                        </li>
                        <li><a href="maintenance.html" class="lh-page-link drop"><i
                                    class="ri-git-commit-line"></i>Maintenance</a>
                        </li>
                    </ul>
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Elements</li>
                <li class="lh-sb-item">
                    <a href="remix-icons.html" class="lh-page-link">
                        <i class="ri-remixicon-line"></i><span class="condense"><span class="hover-title">remix
                                icons</span></span></a>
                </li>
                <li class="lh-sb-item">
                    <a href="material-icons.html" class="lh-page-link">
                        <i class="mdi mdi-material-ui"></i><span class="condense"><span class="hover-title">Material
                                icons</span></span></a>
                </li>
                <li class="lh-sb-item">
                    <a href="alert-popup.html" class="lh-page-link">
                        <i class="ri-file-warning-line"></i><span class="condense"><span class="hover-title">Alert
                                Popup</span></span></a>
                </li>
                <li class="lh-sb-item-separator"></li>
                <li class="lh-sb-title condense">Settings</li>
                <li class="lh-sb-item">
                    <a href="role.html" class="lh-page-link">
                        <i class="ri-magic-line"></i><span class="condense"><span
                                class="hover-title">Role</span></span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
