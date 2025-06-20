<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

<<<<<<< HEAD
new #[Layout('layouts.guest')] class extends Component {
=======
new #[Layout('layouts.guest')] class extends Component
{
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $token;

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->email;
    }

    public function resetPassword(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

<<<<<<< HEAD
        $status = Password::reset($this->only('email', 'password', 'password_confirmation') + ['token' => $this->token], function ($user, $password) {
            $user
                ->forceFill([
                    'password' => Hash::make($password),
                ])
                ->save();
        });
=======
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation') + ['token' => $this->token],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42

        if ($status == Password::PASSWORD_RESET) {
            session()->flash('status', 'Đặt lại mật khẩu thành công. Bạn có thể đăng nhập!');
            $this->redirect(route('login'), navigate: true);
        } else {
            $this->addError('email', __($status));
        }
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
<<<<<<< HEAD
                    {{-- <div class="website-logo-inside less-margin">
                        <a href="/">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}"
                                    alt="">
                            </div>
                        </a>
                    </div> --}}
=======
                    <div class="website-logo-inside less-margin">
                        <a href="/">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}" alt="">
                            </div>
                        </a>
                    </div>
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42

                    <h3 class="font-md">Đặt lại mật khẩu</h3>
                    <p>Vui lòng nhập mật khẩu mới của bạn bên dưới.</p>

                    <form wire:submit.prevent="resetPassword">
<<<<<<< HEAD
                        <input class="form-control" type="email" placeholder="Email" wire:model="email" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <input class="form-control" type="password" placeholder="Mật khẩu mới" wire:model="password"
                            required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <input class="form-control" type="password" placeholder="Xác nhận mật khẩu"
                            wire:model="password_confirmation" required>
=======
                        <input class="form-control" type="email" placeholder="Email"
                               wire:model="email" required>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                        <input class="form-control" type="password" placeholder="Mật khẩu mới"
                               wire:model="password" required>
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                        <input class="form-control" type="password" placeholder="Xác nhận mật khẩu"
                               wire:model="password_confirmation" required>
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42

                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Đặt lại</button>
                        </div>
                    </form>

                    <div class="page-links">
                        <a href="{{ route('login') }}">Quay lại đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
