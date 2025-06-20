<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
?>

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
                    {{-- <div class="website-logo-inside logo-normal">
                        <a href="/">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}"
                                    alt="">
                            </div>
                        </a>
                    </div> --}}

                    <h3 class="font-md">Đăng nhập tài khoản</h3>
                    <p>Truy cập vào công cụ mạnh mẽ nhất trong lĩnh vực thiết kế và phát triển web.</p>

                    <form wire:submit.prevent="login">
                        <input class="form-control" type="email" placeholder="Địa chỉ Email" wire:model="form.email"
                            required>
                        <input class="form-control" type="password" placeholder="Mật khẩu" wire:model="form.password"
                            required>

                        <div class="form-button d-flex align-items-center">
                            <div class="submit-container mr-auto text-start">
                                <button id="submit" type="submit" class="ibtn">Đăng nhập</button>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
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
                        <a href="{{ route('register') }}">Tạo tài khoản mới</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
