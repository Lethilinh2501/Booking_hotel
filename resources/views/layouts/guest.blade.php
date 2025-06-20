<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('themes/Auth/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/Auth/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/Auth/css/iofrm-style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/Auth/css/iofrm-theme32.css') }}">

    @livewireStyles
</head>
<body>
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
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('themes/Auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('themes/Auth/js/popper.min.js') }}"></script>
    <script src="{{ asset('themes/Auth/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/Auth/js/main.js') }}"></script>

    @livewireScripts
</body>
</html>

