@extends('layout.client')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>{{ $roomType->name }}</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="{{ route('client.home') }}">Trang chủ</a>
                            </span>
                            <span> / </span>
                            <span>{{ $roomType->name }}</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-room-details padding-tb-100">
        <div class="container">
            <div class="row">

                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="2000">
                    <div class="lh-room-details">
                        <div class="lh-main-room">
                            <div class="slider slider-for">
                                <div class="lh-room-details-image">
                                    <img src="{{ asset('themes/client/assets/img/room/room-' . $roomType->id . '.jpg') }}"
                                        alt="{{ $roomType->name }}" class="img-fluid"
                                        onerror="this.src='{{ asset('images/default.jpg') }}';">
                                </div>
                            </div>
                        </div>

                        <div class="lh-room-details-contain">
                            <h4 class="lh-room-details-contain-heading">{{ $roomType->name }}</h4>
                            <p>{{ $roomType->description }}</p>

                            <ul class="mt-3 list-unstyled">
                                <li class="mb-2"><strong>Giá:</strong> {{ number_format($roomType->price, 0, ',', '.') }} VND / đêm</li>
                                <li class="mb-2"><strong>Sức chứa tối đa:</strong> {{ $roomType->max_capacity }} khách</li>
                                <li class="mb-2"><strong>Diện tích:</strong> {{ $roomType->size }} m²</li>
                                <li class="mb-2"><strong>Loại giường:</strong> {{ $roomType->bed_type }}</li>
                                <li class="mb-2"><strong>Trẻ em miễn phí:</strong> {{ $roomType->children_free_limit }} bé</li>
                                <li class="mb-2"><strong>Trạng thái:</strong> {{ $roomType->is_active ? 'Đang hoạt động' : 'Ngưng phục vụ' }}</li>
                            </ul>

                            <div class="lh-room-details-amenities mt-4">
                                <h4 class="lh-room-inner-heading">Tiện nghi phòng</h4>
                                <div class="row">
                                    @foreach ($amenities->chunk(ceil($amenities->count() / 3)) as $chunk)
                                        <div class="col-lg-4 lh-cols-room">
                                            <ul class="list-unstyled">
                                                @foreach ($chunk as $amenity)
                                                    <li class="mb-2"><i class="ri-check-line"></i> {{ $amenity->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="lh-room-details-rules mt-4">
                                <h4 class="lh-room-inner-heading">Quy tắc & Quy định</h4>
                                <div class="lh-cols-room">
                                    <ul class="list-unstyled">
                                        @foreach ($rules as $rule)
                                            <li class="mb-2"><i class="ri-information-line"></i> {{ $rule->content ?? $rule->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="3000">
                    <div class="lh-side-room">
                        <h4 class="lh-room-inner-heading">Đặt phòng</h4>
                        <div class="lh-side-reservation">
                            <form action="{{ route('client.rooms.roomdetail', $roomType->id) }}" method="get" id="searchForm">
                                @csrf
                                <div class="lh-side-reservation-from">
                                    <label for="date_range" class="form-label">Ngày nhận phòng - trả phòng</label>
                                    <div class="calendar position-relative">
                                        <input type="text" class="reservation-form-control" id="date_range"
                                            value="{{ $checkIn ? $checkIn->format('d/m/Y') : date('d/m/Y') }} - {{ $checkOut ? $checkOut->format('d/m/Y') : date('d/m/Y', strtotime('+1 day')) }}"
                                            readonly>
                                        <i class="ri-calendar-line"></i>
                                        <input type="hidden" name="check_in" id="check_in"
                                            value="{{ $checkIn ? $checkIn->format('Y-m-d') : date('Y-m-d') }}">
                                        <input type="hidden" name="check_out" id="check_out"
                                            value="{{ $checkOut ? $checkOut->format('Y-m-d') : date('Y-m-d', strtotime('+1 day')) }}">
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <h4>Số lượng</h4>
                                    <div class="counter-box">
                                        <div class="counter-item">
                                            <label>Người lớn</label>
                                            <div class="counter-controls">
                                                <button type="button" class="counter-btn minus" data-target="total_guests" data-max="{{ $maxCapacity }}">-</button>
                                                <input type="text" name="total_guests" class="counter-input" id="total_guests" value="{{ $totalGuests }}" readonly>
                                                <button type="button" class="counter-btn plus" data-target="total_guests" data-max="{{ $maxCapacity }}">+</button>
                                            </div>
                                        </div>
                                        <div class="counter-item">
                                            <label>Trẻ em</label>
                                            <div class="counter-controls">
                                                <button type="button" class="counter-btn minus" data-target="children_count" data-max="{{ $maxChildrenLimit }}">-</button>
                                                <input type="text" name="children_count" class="counter-input" id="children_count" value="{{ $childrenCount }}" readonly>
                                                <button type="button" class="counter-btn plus" data-target="children_count" data-max="{{ $maxChildrenLimit }}">+</button>
                                            </div>
                                        </div>
                                        <div class="counter-item">
                                            <label>Phòng</label>
                                            <div class="counter-controls">
                                                <button type="button" class="counter-btn minus" data-target="room_quantity" data-max="{{ $totalAvailableRooms }}">-</button>
                                                <input type="text" name="room_quantity" class="counter-input" id="room_quantity" value="{{ $roomCount }}" readonly>
                                                <button type="button" class="counter-btn plus" data-target="room_quantity" data-max="{{ $totalAvailableRooms }}">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($childrenCount > $roomType->children_free_limit)
                                        <small class="note text-danger">Trẻ em dưới 12 tuổi miễn phí ({{ $roomType->children_free_limit }}). Trên 12 xem như người lớn.</small>
                                    @endif
                                    <small class="note"><a href="#">Đọc thêm về chính sách đặt phòng cùng với trẻ em</a></small>
                                </div>
                                <div class="lh-side-reservation-from ex-service">
                                    <h4 class="lh-room-inner-heading">Dịch vụ bổ sung</h4>
                                    @if ($roomType->services->isNotEmpty())
                                        @foreach ($roomType->services as $service)
                                            @if ($service->is_active)
                                                <div class="service-item d-flex align-items-center mb-2">
                                                    <div class="service-name flex-grow-1">
                                                        {{ $service->name }} (<span class="service-price-display">{{ $service->price == 0 ? 'Miễn phí' : number_format($service->price, 0, ',', '.') . ' VND' }}</span>)
                                                    </div>
                                                    <div class="service-quantity d-flex align-items-center">
                                                        <button type="button" class="counter-btn decrease-quantity" data-service-id="{{ $service->id }}" {{ $service->price == 0 ? 'disabled' : '' }}>-</button>
                                                        <input type="number" name="services[{{ $service->id }}]" class="counter-input quantity-input" value="{{ old("services.{$service->id}") ?? ($service->price == 0 ? 1 : 0) }}" min="0" data-price="{{ $service->price }}" readonly>
                                                        <button type="button" class="counter-btn increase-quantity" data-service-id="{{ $service->id }}" {{ $service->price == 0 ? 'disabled' : '' }}>+</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>Không có dịch vụ bổ sung nào.</p>
                                    @endif
                                </div>
                                <div class="lh-side-reservation-from">
                                    <h4 class="lh-room-inner-heading">Chi tiết giá</h4>
                                    @php
                                        $basePrice = $roomType->total_original_price ?? $roomType->price * $nights * $roomCount;
                                        $discountedPrice = $roomType->total_discounted_price ?? $basePrice;
                                        $discountAmount = $basePrice - $discountedPrice;
                                        $serviceTotal = 0; // Sẽ được cập nhật bởi JavaScript
                                        $subTotal = $discountedPrice + $serviceTotal;
                                        $taxRate = 0.08;
                                        $taxFee = $subTotal * $taxRate;
                                        $totalPrice = $subTotal + $taxFee;
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                        <p>Giá gốc ({{ $roomCount }} phòng x <span id="nights-display">{{ $nights }}</span> đêm)</p>
                                        <p><span id="base-price-display">{{ number_format($basePrice, 0, ',', '.') }}</span> VND</p>
                                    </div>
                                    @if ($discountAmount > 0 && isset($roomType->promotion_info))
                                        <div class="d-flex justify-content-between gap-2">
                                            <p>Chương trình: {{ $roomType->promotion_info['name'] }} (Giảm {{ $roomType->promotion_info['value'] }}{{ $roomType->promotion_info['type'] === 'percent' ? '%' : ' VND' }})</p>
                                            <p>-<span id="discount-amount-display">{{ number_format($discountAmount, 0, ',', '.') }}</span> VND</p>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between" id="service-total-row" style="display: none;">
                                        <p>Dịch vụ bổ sung</p>
                                        <p><span id="service-total-amount">0</span> VND</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Thuế và phí (<span id="tax-rate-display">{{ $taxRate * 100 }}</span>%)</p>
                                        <p><span id="tax-fee-display">{{ number_format($taxFee, 0, ',', '.') }}</span> VND</p>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <h4>Tổng cộng</h4>
                                        <h5 class="text-danger" id="total-price-display">{{ number_format($totalPrice, 0, ',', '.') }} VND</h5>
                                    </div>
                                    <p class="text-muted">Đã bao gồm thuế và phí</p>
                                </div>

                                <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                                <input type="hidden" name="base_price" id="base-price-input" value="{{ $basePrice }}">
                                <input type="hidden" name="discounted_price" id="discounted-price-input" value="{{ $discountedPrice }}">
                                <input type="hidden" name="discount_amount" id="discount-amount-input" value="{{ $discountAmount }}">
                                <input type="hidden" name="service_total" id="service-total-input" value="0">
                                <input type="hidden" name="tax_fee" id="tax-fee-input" value="{{ $taxFee }}">
                                <input type="hidden" name="total_price" id="total-price-input" value="{{ $totalPrice }}">
                                <div class="lh-side-reservation-from">
                                    <button type="submit" class="lh-buttons btn-block">Đặt phòng ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fallback for jQuery if CDN fails
        window.jQuery || document.write('<script src="{{ asset('js/jquery-3.6.0.min.js') }}"><\/script>');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to format date to Vietnamese
            function formatDateToVietnamese(startDate, endDate) {
                if (!startDate || !endDate) return "";
                const days = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
                const months = ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'];
                const startDay = days[startDate.getDay()];
                const startDateNum = startDate.getDate();
                const startMonth = months[startDate.getMonth()];
                const endDay = days[endDate.getDay()];
                const endDateNum = endDate.getDate();
                const endMonth = months[endDate.getMonth()];
                return `${startDay}, ${startDateNum} ${startMonth} - ${endDay}, ${endDateNum} ${endMonth}`;
            }

            // Initialize Flatpickr
            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "d/m/Y",
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const startDate = new Date(selectedDates[0].getTime());
                        const endDate = new Date(selectedDates[1].getTime());
                        $("#check_in").val(startDate.toISOString().split('T')[0]);
                        $("#check_out").val(endDate.toISOString().split('T')[0]);
                        $("#date_range").val(formatDateToVietnamese(startDate, endDate));
                        updatePrice();
                    }
                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                        longhand: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy']
                    },
                    months: {
                        shorthand: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
                        longhand: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
                    }
                },
                showMonths: 2
            });

            // Initialize Slick Slider (if you have multiple images)
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true
            });

            // Configuration Constants from Blade
            const CHILDREN_FREE_LIMIT = {{ $roomType->children_free_limit }};
            const ORIGINAL_PRICE_PER_NIGHT = {{ $roomType->price }};
            const DISCOUNTED_PRICE_PER_NIGHT = {{ $roomType->discounted_price_per_night ?? $roomType->price }};
            const MAX_CAPACITY = {{ $maxCapacity }};
            const MAX_ROOMS = {{ $totalAvailableRooms }};
            const TAX_RATE = 0.08;

            // Function to format numbers for display
            function numberFormat(number) {
                return new Intl.NumberFormat('vi-VN').format(number);
            }

            // Function to calculate and update prices
            function updatePrice() {
                const checkIn = new Date($('#check_in').val());
                const checkOut = new Date($('#check_out').val());
                const timeDiff = Math.abs(checkOut.getTime() - checkIn.getTime());
                const nights = Math.max(1, Math.ceil(timeDiff / (1000 * 3600 * 24))); // Ensure at least 1 night

                const roomCount = parseInt($('#room_quantity').val()) || 1;
                const totalGuests = parseInt($('#total_guests').val()) || 1;
                const childrenCount = parseInt($('#children_count').val()) || 0;

                const basePrice = ORIGINAL_PRICE_PER_NIGHT * roomCount * nights;
                const discountedPrice = DISCOUNTED_PRICE_PER_NIGHT * roomCount * nights;
                const discountAmount = basePrice - discountedPrice;

                let serviceTotal = 0;
                $('.quantity-input').each(function() {
                    const quantity = parseInt($(this).val()) || 0;
                    const price = parseFloat($(this).data('price')) || 0;
                    if (!isNaN(price) && quantity > 0) {
                        serviceTotal += price * quantity;
                    }
                });

                const subTotal = discountedPrice + serviceTotal;
                const taxFee = subTotal * TAX_RATE;
                const totalPrice = subTotal + taxFee;

                // Update displayed values
                $('#nights-display').text(nights);
                $('#base-price-display').text(numberFormat(basePrice));
                $('#discount-amount-display').text(numberFormat(discountAmount));
                $('#service-total-amount').text(numberFormat(serviceTotal));
                $('#service-total-row').toggle(serviceTotal > 0);
                $('#tax-fee-display').text(numberFormat(taxFee));
                $('#total-price-display').text(numberFormat(totalPrice) + ' VND');

                // Update hidden input values
                $('#base-price-input').val(basePrice);
                $('#discounted-price-input').val(discountedPrice);
                $('#discount-amount-input').val(discountAmount);
                $('#service-total-input').val(serviceTotal);
                $('#tax-fee-input').val(taxFee);
                $('#total-price-input').val(totalPrice);
            }

            // Handle counter buttons for guests, children, and rooms
            $('.counter-btn').on('click', function() {
                const $btn = $(this);
                const target = $btn.data('target'); // 'total_guests', 'children_count', 'room_quantity'
                const serviceId = $btn.data('service-id'); // For service quantity inputs
                let $input;

                if (target) {
                    $input = $(`#${target}`);
                } else if (serviceId) {
                    $input = $(`input[name="services[${serviceId}]"]`);
                } else {
                    return; // Should not happen with current setup
                }

                let value = parseInt($input.val()) || 0;
                const maxValue = parseInt($btn.data('max')) || Infinity;
                const minValue = 0; // All counters should not go below 0

                if ($btn.hasClass('plus') || $btn.hasClass('increase-quantity')) {
                    if (target === 'total_guests') {
                        const currentChildren = parseInt($('#children_count').val()) || 0;
                        if ((value + currentChildren + 1) <= MAX_CAPACITY * parseInt($('#room_quantity').val())) {
                            value = Math.min(value + 1, maxValue);
                        } else {
                            alert(`Tổng số người (${value + currentChildren + 1}) vượt quá sức chứa tối đa của phòng này (${MAX_CAPACITY} người/phòng x ${parseInt($('#room_quantity').val())} phòng).`);
                            return;
                        }
                    } else if (target === 'children_count') {
                        const currentAdults = parseInt($('#total_guests').val()) || 0;
                        if ((value + currentAdults + 1) <= MAX_CAPACITY * parseInt($('#room_quantity').val())) {
                            value = Math.min(value + 1, maxValue);
                        } else {
                            alert(`Tổng số người (${value + currentAdults + 1}) vượt quá sức chứa tối đa của phòng này (${MAX_CAPACITY} người/phòng x ${parseInt($('#room_quantity').val())} phòng).`);
                            return;
                        }
                    } else if (target === 'room_quantity') {
                        if (value < maxValue) {
                            value = Math.min(value + 1, maxValue);
                        } else {
                            alert('Không đủ số phòng trống. Hiện tại chỉ còn ' + MAX_ROOMS + ' phòng.');
                            return;
                        }
                    } else { // For services
                        value = value + 1;
                    }
                } else if ($btn.hasClass('minus') || $btn.hasClass('decrease-quantity')) {
                    value = Math.max(value - 1, minValue);
                    // Special handling for guests/children to ensure at least 1 guest if children is 0
                    if (target === 'total_guests' && value === 0 && parseInt($('#children_count').val()) === 0) {
                        alert('Phải có ít nhất 1 người lớn hoặc trẻ em trong phòng.');
                        return;
                    }
                }

                $input.val(value);

                // Re-validate guest/children limits if changed
                if (target === 'children_count' && value > CHILDREN_FREE_LIMIT) {
                    // This alert might be annoying if they intentionally add more children.
                    // Consider showing a small note instead of an alert.
                    // alert(`Số trẻ em vượt quá giới hạn miễn phí (${CHILDREN_FREE_LIMIT}). Phí bổ sung có thể được áp dụng.`);
                }

                updatePrice(); // Recalculate and update prices after any quantity change
            });

            // Handle form submission
            $('#searchForm').on('submit', function(e) {
                @guest
                    e.preventDefault();
                    alert('Vui lòng đăng nhập để đặt phòng!');
                    window.location.href = '{{ route('login') }}';
                @endguest
            });

            // Initial price update on page load
            updatePrice();
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        /* General Styles */
        .section-room-details {
            padding: 60px 0;
            background: #f9f9f9;
        }

        .lh-room-details-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            object-fit: cover; /* Ensures image covers area without distortion */
        }

        .lh-room-details-contain h4 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .lh-room-details-contain p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .lh-room-inner-heading {
            font-size: 20px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .list-unstyled li {
            font-size: 15px;
            color: #444;
            padding: 5px 0;
            display: flex; /* For icon alignment */
            align-items: center;
        }

        .list-unstyled li i {
            margin-right: 8px; /* Space between icon and text */
            color: #007bff;
        }

        /* Sidebar Reservation */
        .lh-side-room {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .lh-side-reservation-from label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .calendar .ri-calendar-line {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 18px;
            pointer-events: none; /* Allows clicks to pass through to input */
        }

        .reservation-form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px;
            color: #555;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .counter-box {
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 15px;
            background-color: #fcfcfc;
            margin-bottom: 20px;
        }

        .counter-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .counter-item:last-child {
            margin-bottom: 0;
        }

        .counter-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .counter-btn {
            padding: 5px 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 16px;
            line-height: 1; /* For better vertical alignment of +/- */
        }

        .counter-btn:hover {
            background: #0056b3;
        }

        .counter-btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .counter-input {
            width: 40px; /* Smaller width for number inputs */
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
            font-size: 15px;
            -moz-appearance: textfield; /* Hide arrows in Firefox */
        }

        /* Hide number input arrows for Chrome, Safari, Edge, Opera */
        .counter-input::-webkit-outer-spin-button,
        .counter-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /* Additional Services */
        .ex-service {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px dashed #eee;
        }

        .service-item {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .service-item:last-child {
            border-bottom: none;
        }

        .service-name {
            font-size: 14px;
            color: #444;
        }

        .service-price-display {
            font-weight: bold;
            color: #28a745; /* Green for prices */
        }

        /* Price Details */
        .lh-side-reservation-from .d-flex {
            margin-bottom: 8px;
            font-size: 15px;
            color: #555;
        }

        .lh-side-reservation-from .d-flex p:last-child {
            font-weight: bold;
        }

        #total-price-display {
            font-size: 22px;
            font-weight: bold;
        }

        .lh-buttons {
            padding: 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 20px;
        }

        .lh-buttons:hover {
            background: #0056b3;
        }

        /* Alert */
        .alert {
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 15px;
            position: relative;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .note {
            font-size: 13px;
            color: #777;
            display: block;
            margin-top: 5px;
        }

        .note a {
            color: #007bff;
            text-decoration: none;
        }

        .note a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 991px) { /* Changed from 768px to 991px for Bootstrap's lg breakpoint */
            .col-lg-8, .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 30px; /* Add space between main content and sidebar on smaller screens */
            }

            .lh-side-room {
                margin-top: 0; /* Remove top margin that might be present for alignment */
            }
        }

        @media (max-width: 576px) { /* For even smaller screens */
            .lh-room-details-contain h4 {
                font-size: 20px;
            }

            .lh-room-inner-heading {
                font-size: 18px;
            }

            .counter-input, .quantity-input {
                width: 35px;
                padding: 3px;
                font-size: 14px;
            }

            .counter-btn {
                padding: 4px 8px;
                font-size: 14px;
            }

            .lh-buttons {
                font-size: 15px;
                padding: 10px;
            }
        }
    </style>
@endsection