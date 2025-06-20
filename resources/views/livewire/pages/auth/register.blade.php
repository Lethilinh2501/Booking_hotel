<?php

use App\Livewire\Forms\RegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public RegisterForm $form;

    public function register(): void
    {
        $this->validate();
        $this->form->create();
        $this->redirect(route('dashboard'), navigate: true);
    }
};
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
                    {{-- <div class="website-logo-inside less-margin">
                        <a href="/">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}"
                                    alt="">
                            </div>
                        </a>
                    </div> --}}
                    <h3 class="font-md">Tạo tài khoản mới</h3>
                    <p>Truy cập vào công cụ mạnh mẽ nhất trong thiết kế và phát triển web.</p>

                    <form wire:submit.prevent="register">
                        <input class="form-control" type="text" placeholder="Họ và tên" wire:model="form.name"
                            required>
                        @error('form.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <input class="form-control" type="email" placeholder="Địa chỉ Email" wire:model="form.email"
                            required>
                        @error('form.email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <input class="form-control" type="password" placeholder="Mật khẩu" wire:model="form.password"
                            required>
                        @error('form.password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <input class="form-control" type="password" placeholder="Nhập lại mật khẩu"
                            wire:model="form.password_confirmation" required>
                        @error('form.password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Đăng ký</button>
                        </div>
                    </form>

                    <div class="other-links social-with-title">
                        <div class="text">Hoặc đăng ký bằng</div>
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
