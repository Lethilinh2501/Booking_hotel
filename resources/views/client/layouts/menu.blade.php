{{-- @include('client.layouts.menu') --}}

    <div class="lh-header">

        <div class="container">
            <nav class="navbar navbar-expand-lg">


                <a class="navbar-brand" href="#">
                    <img src="{{ asset('themes/client/assets/img/logo/lumora01.png') }}" alt="logo" class="lh-logo">
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
                            <a class="nav-link " href="">
                                Giới thiệu
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="{{ route('contacts.create') }}">
                                Liên lạc
                            </a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="">
                                Chính sách
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="">
                                Liên hệ với cúng tôi
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    
