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
                        <h3 class="font-md">Đăng nhập tài khoản</h3>
                        <p>Truy cập công cụ mạnh mẽ nhất trong ngành thiết kế và web.</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>

                            <div class="form-button d-flex align-items-center">
                                <div class="submit-container mr-auto text-start">
                                    <button id="submit" type="submit" class="ibtn">Đăng nhập</button>
                                </div>
                                <div class="text-end">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="other-links social-with-title">
                            <div class="text">Hoặc đăng nhập bằng</div>
                            <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#"><i class="fab fa-google"></i> Google</a>
                            <a href="#"><i class="fab fa-linkedin-in"></i> Linkedin</a>
                        </div>
                        <div class="page-links">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Đăng ký tài khoản mới</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
