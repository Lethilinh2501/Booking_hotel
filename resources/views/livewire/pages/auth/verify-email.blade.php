<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;


new #[Layout('layouts.guest')] class extends Component {

    public function resend(): void
    {
        Auth::user()->sendEmailVerificationNotification();
        session()->flash('status', 'Đã gửi lại email xác minh.');
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
                    {{-- <div class="website-logo-inside less-margin">
                        <a href="/">
                            <div class="logo">
                                <img class="logo-size" src="{{ asset('themes/Auth/images/logo-black.svg') }}"
                                    alt="">
                            </div>
                        </a>
                    </div> --}}

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
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                            xuất</a>

                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
