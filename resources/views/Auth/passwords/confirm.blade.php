<section class="bg-light p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">

                        <div class="text-center mb-4">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('themes/client/assets/img/logo/logo_about.png') }}" alt="Logo"
                                    width="280">
                            </a>
                        </div>

                        <h3 class="text-center mb-3">Xác nhận mật khẩu</h3>
                        <p class="text-center text-muted mb-4">Vui lòng xác nhận mật khẩu trước khi tiếp tục.</p>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-floating mb-4">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Mật khẩu" required autocomplete="current-password">
                                <label for="password">Mật khẩu</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="link-secondary text-decoration-none">
                                        Quên mật khẩu?
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary bsb-btn-xl">Xác nhận</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="link-secondary text-decoration-none">
                                Quay lại đăng nhập
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-7/assets/css/login-7.css">