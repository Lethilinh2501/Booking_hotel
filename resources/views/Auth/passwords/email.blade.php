@extends('layouts.auth')

@section('content')
<div class="form-body without-side">
    <div class="iofrm-layout">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="{{ asset('themes/Auth/images/graphic9.svg') }}" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <div class="website-logo-inside logo-normal">
                        <a href="{{ url('/') }}">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}" alt="">
                            </div>
                        </a>
                    </div>
                    <h3 class="font-md">Gửi liên kết đặt lại mật khẩu</h3>
                    <p>Nhập địa chỉ email của bạn để nhận liên kết đặt lại mật khẩu.</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @endif

                        <div class="form-button d-flex align-items-center">
                            <div class="submit-container mr-auto text-start">
                                <button id="submit" type="submit" class="ibtn">Gửi liên kết</button>
                            </div>
                        </div>
                    </form>
                    <div class="other-links social-with-title">
                        <div class="text">Hoặc gửi bằng</div>
                        <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="#"><i class="fab fa-google"></i> Google</a>
                        <a href="#"><i class="fab fa-linkedin-in"></i> Linkedin</a>
                    </div>
                    <div class="page-links">
                        <a href="{{ route('login') }}">Đăng nhập tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
