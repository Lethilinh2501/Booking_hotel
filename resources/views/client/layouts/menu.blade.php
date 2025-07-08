
    <div class="lh-header">

        <div class="container">
            <nav class="navbar navbar-expand-lg">


                <a class="navbar-brand" href="{{route('client.home')}}">
                    <img src="{{ asset('themes/client/assets/img/logo/logo11.png') }}" alt="logo" class="lh-logo">
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('home') }}">Trang Chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('roomtypes') }}">
                                Danh sách loại phòng
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="{{ route('contacts.create') }}">
                                Liên lạc
                            </a>
                            <li class="nav-item dropdown">
                            <a class="nav-link " href="{{ route('client.promotions.index') }}">
                                Ưu đãi 
                            </a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="">
                                Chính sách
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="{{ route('client.posts.index') }}">
                                Tin tức
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="{{ route('client.faqs.index') }}">
                                FAQ
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('client.about.index') }}">
                                Giới thiệu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.system.index') }}">
                                Hệ thống
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    
