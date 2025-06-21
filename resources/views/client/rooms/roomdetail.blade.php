@extends('layout.client')

@section('content')
    <!-- Banner -->
    <section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>{{ $roomType->name }}</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="{{ route('client.home') }}">Home</a>
                            </span>
                            <span> / </span>
                            <span>{{ $roomType->name }}</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Room-details -->
    <section class="section-room-detsils padding-tb-100">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="2000">
                    <div class="lh-room-details">
                        <!-- Ảnh đại diện -->
                        <div class="lh-main-room">
                            <div class="slider slider-for">
                                <div class="lh-room-details-image">
                                    <img src="/assets/client/assets/img/room/room-{{ $roomType->id }}.jpg"
                                        alt="{{ $roomType->name }}">
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin phòng -->
                        <div class="lh-room-details-contain">
                            <h4 class="lh-room-details-contain-heading">{{ $roomType->name }}</h4>
                            <p>{{ $roomType->description }}</p>

                            <ul class="mt-3">
                                <li><strong>Giá:</strong> {{ number_format($roomType->price, 0, ',', '.') }} VND / đêm</li>
                                <li><strong>Sức chứa tối đa:</strong> {{ $roomType->max_capacity }} khách</li>
                                <li><strong>Diện tích:</strong> {{ $roomType->size }} m²</li>
                                <li><strong>Loại giường:</strong> {{ $roomType->bed_type }}</li>
                                <li><strong>Trẻ em miễn phí:</strong> {{ $roomType->children_free_limit }} bé</li>
                                <li><strong>Trạng thái:</strong>
                                    {{ $roomType->is_active ? 'Đang hoạt động' : 'Ngưng phục vụ' }}</li>
                            </ul>

                            <!-- Amenities -->
                            <div class="lh-room-details-amenities mt-4">
                                <div class="row">
                                    <h4 class="lh-room-inner-heading">Tiện nghi phòng</h4>
                                    @foreach ($amenities->chunk(ceil($amenities->count() / 3)) as $chunk)
                                        <div class="col-lg-4 lh-cols-room">
                                            <ul>
                                                @foreach ($chunk as $amenity)
                                                    <li><code>*</code> {{ $amenity->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Rules -->
                            <div class="lh-room-details-rules mt-4">
                                <div class="lh-room-rules">
                                    <h4 class="lh-room-inner-heading">Rules & Regulation</h4>
                                    <div class="lh-cols-room">
                                        <ul>
                                            @foreach ($rules as $rule)
                                                <li><code>*</code> {{ $rule->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="3000">
                    <div class="lh-side-room">
                        <h4 class="lh-room-inner-heading">Reservation</h4>
                        <div class="lh-side-reservation">
                            <form>
                                <div class="lh-side-reservation-from">
                                    <label>Check In</label>
                                    <div class="calendar" id="date_1">
                                        <input type="text" class="reservation-form-control" placeholder="Sep 09,2024">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <label>Check Out</label>
                                    <div class="calendar" id="date_2">
                                        <input type="text" class="reservation-form-control" placeholder="Sep 09,2024">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <label>Room</label>
                                    <div class="custom-select reservation-form-control">
                                        <select>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Adult</label>
                                            <div class="custom-select reservation-form-control">
                                                <select>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Children</label>
                                            <div class="custom-select reservation-form-control">
                                                <select>
                                                    <option>0</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from ex-service">
                                    <h4>Extra Services</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="air">
                                        <label class="form-check-label" for="air">
                                            Air Conditioner
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="internet" checked>
                                        <label class="form-check-label" for="internet">
                                            Free Internet
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tv" checked>
                                        <label class="form-check-label" for="tv">
                                            LCD Television
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="micro" checked>
                                        <label class="form-check-label" for="micro">
                                            Microwave
                                        </label>
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <h4>Giá Phòng</h4>
                                    <span>{{ number_format($roomType->price, 0, ',', '.') }} VND / đêm</span>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <div class="lh-side-reservation-from-buttons d-flex">
                                        <a class="lh-buttons result-placeholder" href="#">
                                            Đặt phòng ngay
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- .row -->
        </div>
    </section>
@endsection
