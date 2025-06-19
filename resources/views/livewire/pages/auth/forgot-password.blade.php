<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendResetLink(): void
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        Password::sendResetLink(['email' => $this->email]);

        session()->flash('status', 'Chúng tôi đã gửi link đặt lại mật khẩu vào email của bạn!');
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
                    <div class="website-logo-inside less-margin">
                        <a href="/">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}" alt="">
                            </div>
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mt-3 mb-3 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 class="font-md">Đặt lại mật khẩu</h3>
                    <p>Nhập địa chỉ email bạn đã đăng ký để nhận liên kết đặt lại mật khẩu.</p>

                    <form wire:submit.prevent="sendResetLink">
                        <input class="form-control" type="email" placeholder="Địa chỉ Email"
                               wire:model="email" required>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                        <div class="form-button full-width">
                            <button id="submit" type="submit" class="ibtn btn-forget">Gửi liên kết đặt lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
