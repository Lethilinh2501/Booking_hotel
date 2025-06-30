@extends('layouts.auth')

@section('content')
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                    <div class="card border border-light-subtle rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-4">
                                <a href="/">
                                    <img src="{{ asset('themes/client/assets/img/logo/logo_about.png') }}" alt="Logo"
                                        width="280">
                                </a>
                            </div>

                            <h3 class="text-center mb-3">Xác minh địa chỉ email</h3>
                            <p class="text-center text-muted mb-4">
                                Trước khi tiếp tục, vui lòng kiểm tra email của bạn để nhận liên kết xác minh.
                            </p>

                            @if (session('resent'))
                                <div class="alert alert-success text-center" role="alert">
                                    Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                                </div>
                            @else
                                <p class="text-center">
                                    Nếu bạn không nhận được email,
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">nhấn vào đây để yêu
                                        cầu lại</button>.
                                </form>
                                </p>
                            @endif

                            <div class="d-grid mt-4">
                                <a href="{{ route('logout') }}" class="btn btn-outline-secondary"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-7/assets/css/login-7.css">
