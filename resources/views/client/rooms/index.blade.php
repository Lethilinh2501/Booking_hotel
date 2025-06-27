@extends('layout.client')

@section('content')
<style>
    .room-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
        padding: 15px;
    }

    .room-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        background-color: #f0f0f0;
    }

    .discount-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #ff4d4f;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: bold;
        z-index: 10;
    }
</style>

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
                        <button class="nav-link {{ $index == 0 ? 'active' : '' }}" id="nav-{{ $roomType->id }}-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-{{ $roomType->id }}" type="button" role="tab" aria-controls="nav-{{ $roomType->id }}"
                                aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                            <div style="position: relative;">
                                <img src="assets/client/assets/img/room/{{ $roomType->id }}.jpg" alt="{{ $roomType->name }}" width="50px" height="100px">
                            </div>
                            {{ $roomType->name }}
                        </button>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach ($roomTypes as $index => $roomType)
                    <div class="tab-pane fade {{ $index == 0 ? 'active show' : '' }}" id="nav-{{ $roomType->id }}" role="tabpanel" aria-labelledby="nav-{{ $roomType->id }}-tab">
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
                                                    Chi phí cho {{ $nights }} đêm, {{ $totalGuests + $childrenCount }} khách
                                                </p>
                                                <p style="font-size: 14px; color: #555;">
                                                    Tổng: {{ number_format($roomType->total_original_price, 0, ',', '.') }} VND
                                                </p>
                                            </div>
                                        </div>
                                        <p>{{ $roomType->description ?? 'Không có mô tả.' }}</p>
                                        <ul>
                                            <li><strong>Loại giường:</strong> {{ $roomType->bed_type }}</li>
                                            <li><strong>Sức chứa tối đa:</strong> {{ $roomType->max_capacity }} khách</li>
                                            <li><strong>Diện tích:</strong> {{ $roomType->size }} m²</li>
                                            <li><strong>Trẻ em miễn phí:</strong> {{ $roomType->children_free_limit }}</li>
                                            <li><strong>Trạng thái:</strong> {{ $roomType->is_active ? 'Đang hoạt động' : 'Không hoạt động' }}</li>
                                            <li><strong>Số phòng còn trống:</strong> {{ $roomType->available_rooms }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 p-0">
                                    <div class="room-img">
                                        <img src="assets/client/assets/img/room/room-{{ $roomType->id }}.jpg" alt="room-img" class="room-image">

                                        <a href="{{ route('client.rooms.roomdetail', ['id' => $roomType->id]) }}" class="link"><i class="ri-arrow-right-line"></i></a>
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
<section class="section-news py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Tin tức mới nhất</h2>
            <div class="border-bottom border-primary border-3 mx-auto" style="width: 100px;"></div>
        </div>

        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    @if($post->image)
                    <div class="news-img-container" style="height: 200px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             class="card-img-top h-100 w-100 object-fit-cover" 
                             alt="{{ $post->title }}"
                             style="transition: transform 0.3s;">
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                <i class="far fa-calendar-alt me-1"></i> 
                                {{ $post->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('client.news.list', $post->id) }}" 
                               class="text-decoration-none text-dark hover-text-primary">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ route('client.news.list', $post->id) }}" 
                           class="btn btn-outline-primary rounded-pill px-4">
                            Xem thêm <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($posts->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('client.news.list') }}" 
               class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                Xem tất cả tin tức <i class="fas fa-newspaper ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .hover-text-primary:hover {
        color: #0d6efd !important;
    }
    .news-img-container:hover img {
        transform: scale(1.05);
    }
    .card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .border-primary {
        border-color: #0d6efd !important;
    }
</style>
@endpush
</section>

@endsection
