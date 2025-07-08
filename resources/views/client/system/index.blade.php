@extends('layout.client')

@section('content')

<section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>Hệ thống</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </span>
                            <span> / </span>
                            <span>
                                <a href="javascript:void(0)">Hệ thống</a>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="section-about py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ $system->name ?? 'Thông tin hệ thống' }}</h2>

            <!-- @if ($system?->logo)
                <img src="{{ asset('themes/client/assets/img/logo/logo-2.png') }}"
                     alt="Logo"
                     class="img-fluid mt-3 rounded shadow"
                     style="max-height: 100px;">
            @endif -->
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <strong>📍 Địa chỉ:</strong> {{ $system->address ?? 'Chưa cập nhật' }}
                            </li>
                            <li class="list-group-item">
                                <strong>📧 Email:</strong> {{ $system->email ?? 'Chưa cập nhật' }}
                            </li>
                            <li class="list-group-item">
                                <strong>📞 Điện thoại:</strong> {{ $system->phone ?? 'Chưa cập nhật' }}
                            </li>
                        </ul>

                        @if ($system?->map)
                            <div class="ratio ratio-16x9">
                                {!! $system->map !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
