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
                    <div class="website-logo-inside less-margin">
                        <a href="{{ url('/') }}">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}" alt="">
                            </div>
                        </a>
                    </div>
                    <h3 class="font-md">Xác minh địa chỉ email của bạn</h3>
                    <p>Trước khi tiếp tục, vui lòng kiểm tra email của bạn để nhận liên kết xác minh.</p>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                        </div>
                    @endif
                    @if (session('resent') === null)
                        <p>Nếu bạn không nhận được email,
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">nhấn vào đây để yêu cầu lại</button>.
                            </form>
                        </p>
                    @endif
                    <div class="form-button">
                        <a href="{{ route('logout') }}" class="ibtn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
