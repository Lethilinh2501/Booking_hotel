@if (isset($services) && count($services))
    @foreach ($services as $service)
        <div class="col-lg-4 col-md-6 m-tb-12">
            <div class="lh-services" data-aos="fade-up">
                <div class="lh-services-contain">
                    <div class="lh-icon">
                        <img src="{{ asset('themes/client/assets/img/services/service-1.svg') }}" class="svg-img"
                            alt="services img">
                    </div>
                    <h4 class="lh-services-heading">{{ $service->name }}</h4>
                    <p>Giá dịch vụ: {{ number_format($service->price) }} VND</p>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>Không có dịch vụ nào được hiển thị.</p>
@endif
