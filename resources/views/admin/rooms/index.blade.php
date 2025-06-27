@extends('layout.admin')

@section('content')
    <main class="wrapper sb-default">
        <!-- Loader -->
        <div class="lh-loader">
            <span class="loader"></span>
        </div>
        <div class="lh-sidebar-overlay"></div>
        <!-- Notify sidebar -->
        <div class="lh-notify-bar-overlay"></div>
        <!-- Main content -->
        <div class="lh-main-content">
            <div class="container-fluid">
                <!-- Page title & breadcrumb -->
                <div class="lh-page-title d-flex justify-content-between align-items-center">
                    <div class="lh-breadcrumb">
                        <h5>{{ $title }}</h5>
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                            <li>Danh sách phòng</li>
                        </ul>
                    </div>
                </div>
                <div class="section-title mt-4 text-end mb-3">
                    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm">Tạo mới</a>
                </div>
                <!-- Filter form -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.rooms.index') }}" method="GET" id="filterForm"
                            class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label" for="room_type_id">Loại phòng</label>
                                <select name="room_type_id" id="room_type_id" class="form-control form-control-sm">
                                    <option value="">Tất cả</option>
                                    @foreach ($allRoomTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ request('room_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="">Tất cả</option>
                                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>
                                        Còn trống
                                    </option>
                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>
                                        Đã đặt
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="room_number">Số phòng</label>
                                <input type="text" name="room_number" id="room_number"
                                    class="form-control form-control-sm" value="{{ request('room_number') }}"
                                    placeholder="Nhập số phòng">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="date_range">Khoảng thời gian</label>
                                <input type="text" name="date_range" id="date_range"
                                    class="form-control form-control-sm date-range-picker" value="{{ $dateRange }}"
                                    placeholder="Chọn khoảng thời gian">
                            </div>
                            @php
                                $chunks = $allAmenities->chunk(ceil($allAmenities->count() / 3));
                            @endphp
                            <div class="col-md-12">
                                <label class="form-label">Tiện nghi</label>
                                <div class="row">
                                    @foreach ($chunks as $chunk)
                                        <div class="col-md-4">
                                            @foreach ($chunk as $amenity)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]"
                                                        value="{{ $amenity->id }}" id="amenity_{{ $amenity->id }}"
                                                        {{ in_array($amenity->id, $amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_{{ $amenity->id }}">
                                                        {{ $amenity->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="min_price">Giá tối thiểu</label>
                                <input type="number" name="min_price" id="min_price" class="form-control form-control-sm"
                                    value="{{ request('min_price') }}" placeholder="Nhập giá tối thiểu">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="max_price">Giá tối đa</label>
                                <input type="number" name="max_price" id="max_price" class="form-control form-control-sm"
                                    value="{{ request('max_price') }}" placeholder="Nhập giá tối đa">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="counter_summary">Số lượng người ở</label>
                                <div class="counter-dropdown">
                                    <input type="text" id="counter_summary" class="form-control form-control-sm"
                                        value="{{ $totalGuests }} người lớn - {{ $childrenCount }} trẻ em - {{ $roomCount }} phòng"
                                        readonly>
                                    <div class="counter-dropdown-content">
                                        <div class="counter-item">
                                            <label for="total_guests">Người lớn</label>
                                            <div class="counter-controls">
                                                <button type="button" class="counter-btn minus"
                                                    data-target="total_guests">-</button>
                                                <input type="text" name="total_guests" id="total_guests"
                                                    class="counter-input" value="{{ $totalGuests }}" readonly>
                                                <button type="button" class="counter-btn plus"
                                                    data-target="total_guests">+</button>
                                            </div>
                                        </div>
                                        <div class="counter-item">
                                            <label for="children_count">Trẻ em</label>
                                            <div class="counter-controls">
                                                <button type="button" class="counter-btn minus"
                                                    data-target="children_count">-</button>
                                                <input type="text" name="children_count" id="children_count"
                                                    class="counter-input" value="{{ $childrenCount }}" readonly>
                                                <button type="button" class="counter-btn plus"
                                                    data-target="children_count">+</button>
                                            </div>
                                        </div>
                                        <div class="counter-item">
                                            <label for="room_count">Phòng</label>
                                            <div class="counter-controls">
                                                <button type="button" class="counter-btn minus"
                                                    data-target="room_count">-</button>
                                                <input type="text" name="room_count" id="room_count"
                                                    class="counter-input" value="{{ $roomCount }}" readonly>
                                                <button type="button" class="counter-btn plus"
                                                    data-target="room_count">+</button>
                                            </div>
                                        </div>
                                        <small class="note">
                                            Trẻ em dưới 12 tuổi miễn phí, trên 12 xem như người lớn
                                        </small>
                                        <button type="button" class="done-btn">Xong</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-3">Lọc</button>
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary mt-3 ms-2">Xóa
                                    lọc</a>
                            </div>
                        </form>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                    </div>
                @endif

                @foreach ($roomTypes as $roomType)
                    <div class="section-title">
                        <h4>{{ $roomType->name }} ({{ $roomType->rooms->count() }} phòng -
                            {{ $roomType->available_rooms_count }} trống
                            {{ $roomType->booked_rooms_count ? ', ' . $roomType->booked_rooms_count . ' đã đặt' : '' }})
                        </h4>
                    </div>
                    <div class="row room-list" data-room-type-id="{{ $roomType->id }}">
                        @forelse ($roomType->rooms as $index => $room)
                            <div class="col-xl-3 col-md-6 room-item {{ $index >= 4 ? 'hidden-room' : '' }}">
                                <div class="lh-card {{ $room->filtered_status === 'booked' ? 'booked room-card' : 'room-card' }}"
                                    id="bookingtbl_{{ $room->id }}">
                                    <div class="lh-card-header">
                                        <h4 class="lh-card-title">Phòng {{ $room->room_number }}</h4>
                                        <div class="header-tools">
                                            @if ($room->booking_count > 0)
                                                <a href="{{ route('admin.rooms.booked') }}?room_id={{ $room->id }}&date_range={{ request('date_range') }}"
                                                    class="booking-count" aria-label="Xem chi tiết đặt phòng">
                                                    {{ $room->booking_count }} <i class="ri-list-check"></i>
                                                </a>
                                            @endif
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                                    class="btn btn-sm btn-primary" aria-label="Chỉnh sửa phòng">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                @if (isset($checkIn) && isset($checkOut))
                                                    <a href="{{ route('admin.rooms.show', ['id' => $room->id, 'checkIn' => $checkIn, 'checkOut' => $checkOut]) }}"
                                                        class="btn btn-sm btn-success" aria-label="Xem chi tiết phòng">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.rooms.show', $room->id) }}"
                                                        class="btn btn-sm btn-success" aria-label="Xem chi tiết phòng">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                @endif
                                                <form action="{{ route('admin.rooms.destroy', $room->id) }}"
                                                    method="POST" class="delete-form d-inline-block"
                                                    data-confirm="Bạn có muốn xóa mềm phòng này không?">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        aria-label="Xóa phòng">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lh-card-content card-default">
                                        <div class="lh-room-details">
                                            <ul class="list">
                                                <li><strong>Check in:</strong>
                                                    {{ optional($room->latest_booking)->check_in ? \Carbon\Carbon::parse($room->latest_booking->check_in)->format('d/m/Y H:i') : 'Chưa có' }}
                                                </li>
                                                <li><strong>Check out:</strong>
                                                    {{ optional($room->latest_booking)->check_out ? \Carbon\Carbon::parse($room->latest_booking->check_out)->format('d/m/Y H:i') : 'Chưa có' }}
                                                </li>
                                                <li><strong>Khách hàng:</strong>
                                                    {{ optional(optional($room->latest_booking)->user)->name ?? 'Chưa có' }}
                                                </li>
                                                <li><strong>Người ở:</strong>
                                                    {{ optional($room->latest_booking)->total_guests ?? '0' }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted text-center">Không có phòng nào thuộc loại này.</p>
                            </div>
                        @endforelse
                        @if ($roomType->rooms->count() > 4)
                            <div class="col-12 text-end mt-3 room-actions">
                                <button class="btn btn-primary btn-sm show-more"
                                    data-room-type-id="{{ $roomType->id }}">Xem thêm</button>
                                <button class="btn btn-secondary btn-sm hide-less"
                                    data-room-type-id="{{ $roomType->id }}" style="display: none;">Ẩn bớt</button>
                            </div>
                        @endif
                    </div>
                @endforeach

                @if ($roomTypes->isEmpty())
                    <div class="col-12">
                        <p class="text-muted text-center">Không có loại phòng hoặc phòng nào để hiển thị.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Move styles to external file -->
    <link rel="stylesheet" href="{{ asset('css/admin-rooms.css') }}">

    <!-- External libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize date range picker
            $('.date-range-picker').daterangepicker({
                autoUpdateInput: true,
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Áp dụng',
                    cancelLabel: 'Hủy',
                    customRangeLabel: 'Tùy chọn',
                    daysOfWeek: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                    monthNames: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                        'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    firstDay: 1
                },
                ranges: {
                    'Hôm nay': [moment(), moment()],
                    '7 ngày tới': [moment(), moment().add(6, 'days')],
                    '14 ngày tới': [moment(), moment().add(13, 'days')],
                    '30 ngày tới': [moment(), moment().add(29, 'days')],
                    '90 ngày tới': [moment(), moment().add(89, 'days')]
                },
                minDate: moment(),
                maxSpan: {
                    days: 90
                }
            }, function(start, end) {
                $('.date-range-picker').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            });

            // Set default date range
            const dateRange = '{{ $dateRange }}';
            if (dateRange && dateRange.match(/^\d{2}\/\d{2}\/\d{4}\s*-\s*\d{2}\/\d{2}\/\d{4}$/)) {
                $('.date-range-picker').val(dateRange);
            } else {
                $('.date-range-picker').val(moment().format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
            }

            // Counter dropdown handling
            $('#counter_summary').on('click', function() {
                $('.counter-dropdown-content').toggleClass('show');
            });

            $('.counter-btn').on('click', function() {
                const target = $(this).data('target');
                const input = $(`input[name="${target}"]`);
                let value = parseInt(input.val()) || 0;
                if ($(this).hasClass('plus') && value < 100) {
                    input.val(value + 1);
                } else if ($(this).hasClass('minus') && value > 0) {
                    input.val(value - 1);
                }
                updateCounterSummary();
            });

            $('.done-btn').on('click', function() {
                $('.counter-dropdown-content').removeClass('show');
            });

            function updateCounterSummary() {
                const totalGuests = parseInt($('input[name="total_guests"]').val()) || 0;
                const childrenCount = parseInt($('input[name="children_count"]').val()) || 0;
                const roomCount = parseInt($('input[name="room_count"]').val()) || 0;
                $('#counter_summary').val(
                    `${totalGuests} người lớn - ${childrenCount} trẻ em - ${roomCount} phòng`
                );
            }

            // Show more/hide less handling
            $('.show-more').on('click', function() {
                const roomTypeId = $(this).data('room-type-id');
                const $roomList = $(`.room-list[data-room-type-id="${roomTypeId}"]`);
                $roomList.find('.hidden-room').fadeIn(300, function() {
                    $(this).removeClass('hidden-room');
                });
                $(this).hide();
                $roomList.find('.hide-less').show();
            });

            $('.hide-less').on('click', function() {
                const roomTypeId = $(this).data('room-type-id');
                const $roomList = $(`.room-list[data-room-type-id="${roomTypeId}"]`);
                $roomList.find('.room-item').each(function(index) {
                    if (index >= 4) {
                        $(this).fadeOut(300, function() {
                            $(this).addClass('hidden-room');
                        });
                    }
                });
                $(this).hide();
                $roomList.find('.show-more').show();
            });

            // Delete confirmation
            $('.delete-form').on('submit', function(e) {
                if (!confirm($(this).data('confirm'))) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection

<style>
    .hidden-room {
        display: none;
    }

    .booking-count {
        cursor: pointer;
        color: #007bff;
        margin-right: 10px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
    }

    .booking-count:hover {
        text-decoration: underline;
    }

    .header-tools {
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .btn-sm {
        padding: 2px 5px;
        font-size: 12px;
    }

    .counter-dropdown {
        position: relative;
    }

    .counter-dropdown-content {
        display: none;
        position: absolute;
        background: #fff;
        border: 1px solid #ddd;
        padding: 15px;
        z-index: 1000;
        width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .counter-dropdown-content.show {
        display: block;
    }

    .counter-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .counter-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .counter-input {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        padding: 5px;
    }

    .counter-btn {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        background: #f8f9fa;
        cursor: pointer;
    }

    .done-btn {
        margin-top: 10px;
        padding: 5px 10px;
        background: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .note {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #666;
    }
</style>
