<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    public function confirm(): void
    {
        $this->validate([
            'password' => 'required|current_password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        $this->redirectIntended(route('dashboard'), navigate: true);
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

                    <h3 class="font-md">Xác nhận mật khẩu</h3>
                    <p>Vui lòng xác nhận lại mật khẩu trước khi tiếp tục.</p>

                    <form wire:submit.prevent="confirm">
                        <input class="form-control" type="password" placeholder="Mật khẩu"
                               wire:model="password" required>
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Xác nhận</button>
                        </div>
                    </form>

                    <div class="page-links">
                        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
