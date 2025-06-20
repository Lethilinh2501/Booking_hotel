<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

<<<<<<< HEAD
new #[Layout('layouts.guest')] class extends Component {
=======
new #[Layout('layouts.guest')] class extends Component
{
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42
    public function resend(): void
    {
        Auth::user()->sendEmailVerificationNotification();
        session()->flash('status', 'Đã gửi lại email xác minh.');
    }
<<<<<<< HEAD
=======
};
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42
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

                    <h3 class="font-md">Xác minh email</h3>
                    <p>Chúng tôi đã gửi một liên kết xác minh tới email của bạn.</p>

                    @if (session('status'))
                        <div class="alert alert-success mt-3 mb-3 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="resend">
                        <div class="form-button">
                            <button type="submit" class="ibtn">Gửi lại liên kết xác minh</button>
                        </div>
                    </form>

                    <div class="page-links">
                        <a href="{{ route('logout') }}"
<<<<<<< HEAD
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                            xuất</a>
=======
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
>>>>>>> a5ad75925c9bf2d715734ddfa0dd7544a6deca42
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
