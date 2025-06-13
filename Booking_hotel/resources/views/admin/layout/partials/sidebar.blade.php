<!-- Sidebar -->
<div class="sidebar border-end p-3" style="width: 250px;">
    <h4>Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.banners.listBanner') }}">Quản lý banner</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.contacts.index') }}">Quản lý liên hệ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}">Quản lý đặt phòng</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.amenities.index') }}">Quản lý tiện nghi</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý danh mục</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý thương hiệu</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý bài viết</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quản lý bình luận bài viết</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.policies.index') }}">Quản lý chính sách khách sạn</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.rules.index') }}">Quản lý nội quy</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Thống kê</a></li>
    </ul>
</div>
