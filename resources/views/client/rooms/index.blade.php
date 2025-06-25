@extends('layout.client')

@section('content')
    @include('client.layouts.blocks.slider')
    @include('client.layouts.search')
    <section class="section-room padding-tb-100" data-aos="fade-up" data-aos-duration="2000" id="rooms">
        <div class="container">
            <div class="banner">
                <h2>Chọn Phòng <span> Sang Trọng</span> Của Bạn</h2>
            </div>
            @if ($roomTypes->isEmpty())
                <p>Không có phòng nào phù hợp với yêu cầu của bạn.</p>
            @else
                <nav>
                    <div class="nav nav-tabs rooms lh-room" id="nav-tab" role="tablist">
                        @foreach ($roomTypes as $index => $roomType)
                            <button class="nav-link {{ $index == 0 ? 'active' : '' }}" id="nav-{{ $roomType->id }}-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-{{ $roomType->id }}" type="button" role="tab"
                                aria-controls="nav-{{ $roomType->id }}"
                                aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                <div style="position: relative;">
                                    <img src="assets/client/assets/img/room/{{ $roomType->id }}.jpg"
                                        alt="{{ $roomType->name }}" width="50px" height="100px">
                                </div>
                                {{ $roomType->name }}
                            </button>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($roomTypes as $index => $roomType)
                        <div class="tab-pane fade {{ $index == 0 ? 'active show' : '' }}" id="nav-{{ $roomType->id }}"
                            role="tabpanel" aria-labelledby="nav-{{ $roomType->id }}-tab">
                            <div class="container">
                                <div class="row p-0 lh-d-block">
                                    <div class="col-xl-6 col-lg-12">
                                        <div class="lh-room-contain">
                                            <div class="lh-contain-heading">
                                                <h4>{{ $roomType->name }}</h4>
                                                <div class="lh-room-price">
                                                    <h4 style="color: #333; font-weight: bold;">
                                                        {{ number_format($roomType->price, 0, ',', '.') }} VND / đêm
                                                    </h4>
                                                    <p style="font-size: 14px; color: #555;">
                                                        Chi phí cho {{ $nights }} đêm,
                                                        {{ $totalGuests + $childrenCount }} khách
                                                    </p>
                                                    <p style="font-size: 14px; color: #555;">
                                                        Tổng:
                                                        {{ number_format($roomType->total_original_price, 0, ',', '.') }}
                                                        VND
                                                    </p>
                                                </div>
                                            </div>
                                            <p>{{ $roomType->description ?? 'Không có mô tả.' }}</p>
                                            <ul>
                                                <li><strong>Loại giường:</strong> {{ $roomType->bed_type }}</li>
                                                <li><strong>Sức chứa tối đa:</strong> {{ $roomType->max_capacity }} khách
                                                </li>
                                                <li><strong>Diện tích:</strong> {{ $roomType->size }} m²</li>
                                                <li><strong>Trẻ em miễn phí:</strong> {{ $roomType->children_free_limit }}
                                                </li>
                                                <li><strong>Trạng thái:</strong>
                                                    {{ $roomType->is_active ? 'Đang hoạt động' : 'Không hoạt động' }}</li>
                                                <li><strong>Số phòng còn trống:</strong> {{ $roomType->available_rooms }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 p-0">
                                        <div class="room-img">
                                            <img src="assets/client/assets/img/room/room-{{ $roomType->id }}.jpg"
                                                alt="room-img" class="room-image">

                                            <a href="{{ route('client.rooms.roomdetail', [$roomType->id]) }}?check_in={{ request('check_in', date('Y-m-d')) }}&check_out={{ request('check_out', date('Y-m-d', strtotime('+1 day'))) }}&total_guests={{ request('total_guests', 2) }}&children_count={{ request('children_count', 0) }}&room_count={{ request('room_count', 1) }}"
                                                class="link"><i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
