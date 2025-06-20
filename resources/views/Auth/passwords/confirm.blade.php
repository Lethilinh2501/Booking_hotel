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
                    <h3 class="font-md">Xác nhận mật khẩu</h3>
                    <p>Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.</p>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @endif

                        <div class="form-button d-flex align-items-center">
                            <div class="submit-container mr-auto text-start">
                                <button id="submit" type="submit" class="ibtn">Xác nhận mật khẩu</button>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="text-end">
                                    <a href="{{ route('password.request') }}" class="btn btn-link">Quên mật khẩu?</a>
                                </div>
                            @endif
                        </div>
                    </form>
                    <div class="other-links social-with-title">
                        <div class="text">Hoặc xác nhận bằng</div>
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
