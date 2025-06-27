<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Amenity;
use App\Models\System;
use Illuminate\Http\Request;
use App\Models\RulesAndRegulation;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    // Hàm tính số lượng phòng trống trong khoảng ngày
    private function calculateAvailableRooms(RoomType $roomType, $checkIn, $checkOut)
    {
        $checkInDate = Carbon::parse($checkIn)->startOfDay();
        $checkOutDate = Carbon::parse($checkOut)->endOfDay();
        $totalRooms = $roomType->rooms()->where('status', 'available')->count();

        $booked = Booking::whereHas('rooms', fn($q) => $q->where('room_type_id', $roomType->id))
            ->where(function ($q) use ($checkInDate, $checkOutDate) {
                $q->whereBetween('check_in', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out', [$checkInDate, $checkOutDate])
                    ->orWhere(fn($q2) => $q2->where('check_in', '<=', $checkInDate)->where('check_out', '>=', $checkOutDate));
            })
            ->where(function ($q) use ($checkInDate) {
                $q->whereNull('actual_check_out')->orWhere('actual_check_out', '>=', $checkInDate);
            })
            ->whereNotIn('status', ['cancelled', 'cancelled_without_refund', 'refunded', 'check_out'])
            ->sum('room_quantity');

        return max(0, $totalRooms - $booked);
    }

    // Trang chủ: Lọc phòng theo điều kiện và trả về danh sách dịch vụ kèm phòng
    public function indexRoom(Request $request)
    {
        $services = Service::where('is_active', true)->get();
        $posts = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(6)
            ->get();
        $data = $this->filterRooms($request); // Lọc danh sách phòng

        if ($data['error']) return back()->with('error', $data['error']);

        return view('client.home', array_merge($data, ['services' => $services, 'posts' => $posts ]));
    }

    private function formatDateRange($checkInDate, $checkOutDate)
    {
        $days = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
        $months = ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'];

        return sprintf(
            '%s, %d %s - %s, %d %s',
            $days[$checkInDate->dayOfWeek],
            $checkInDate->day,
            $months[$checkInDate->month - 1],
            $days[$checkOutDate->dayOfWeek],
            $checkOutDate->day,
            $months[$checkOutDate->month - 1]
        );
    }

    public function filterRooms(Request $request)
    {
        $result = [
            'roomTypes' => [],
            'nights' => 1,
            'totalGuests' => (int) $request->input('total_guests', 2),
            'childrenCount' => (int) $request->input('children_count', 0),
            'roomCount' => (int) $request->input('room_count', 1),
            'checkIn' => null,
            'checkOut' => null,
            'error' => null,
        ];

        try {
            Carbon::setLocale('vi');
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $checkIn = $request->input('check_in', Carbon::today()->setHour(14)->toDateString());
            $checkOut = $request->input('check_out', Carbon::tomorrow()->setHour(12)->toDateString());

            $checkInDate = Carbon::parse($checkIn)->startOfDay();
            $checkOutDate = Carbon::parse($checkOut)->startOfDay();

            if ($checkInDate->gte($checkOutDate)) {
                $checkOutDate = $checkInDate->copy()->addDay()->startOfDay();
            }

            $nights = max(1, $checkInDate->diffInDays($checkOutDate));
            $formattedDateRange = $this->formatDateRange($checkInDate, $checkOutDate);
        } catch (\Exception $e) {
            Log::error('filterRooms error: ' . $e->getMessage());
            $result['error'] = 'Ngày giờ không hợp lệ.';
            return $result;
        }

        $roomTypes = RoomType::with(['saleRoomTypes'])
            ->select(['id', 'name', 'description', 'price', 'max_capacity', 'size', 'bed_type', 'children_free_limit'])
            ->where('max_capacity', '>=', $result['totalGuests'] + $result['childrenCount'])
            ->where('is_active', true)
            ->get()
            ->map(function ($room) use ($nights, $result) {
                $original = $room->price * $nights * $result['roomCount'];
                $now = now();
                $best = null;
                $bestPrice = $original;

                foreach ($room->saleRoomTypes->where('status', 'active') as $sale) {
                    if ($now->between($sale->start_date, $sale->end_date)) {
                        $discount = $sale->type === 'percent'
                            ? $original * ($sale->value / 100)
                            : $sale->value * $result['roomCount'];
                        $discounted = max(0, $original - $discount);
                        if ($discounted < $bestPrice) {
                            $bestPrice = $discounted;
                            $best = $sale;
                        }
                    }
                }

                $room->total_original_price = $original;
                $room->total_discounted_price = $bestPrice;
                $room->discounted_price_per_night = round($bestPrice / ($nights * $result['roomCount']), 2);
                $room->promotion_info = $best ? [
                    'name' => $best->name,
                    'value' => $best->value,
                    'type' => $best->type,
                ] : null;
                $room->available_rooms = $room->rooms()->where('status', 'available')->count() ?: 1;
                return $room;
            });

        return array_merge($result, [
            'roomTypes' => $roomTypes,
            'nights' => $nights,
            'checkIn' => $checkInDate,
            'checkOut' => $checkOutDate,
            'formattedDateRange' => $formattedDateRange,
        ]);
    }

    public function roomdetail(Request $request, $id)
    {
        Carbon::setLocale('vi');
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $checkIn = $request->input('check_in', now()->setHour(14)->format('Y-m-d H:i:s'));
        $checkOut = $request->input('check_out', now()->addDay()->setHour(12)->format('Y-m-d H:i:s'));

        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);

        // Nếu ngày check-in >= check-out thì đẩy check-out lên 1 ngày
        if ($checkInDate->gte($checkOutDate)) {
            $checkOutDate = $checkInDate->copy()->addDay()->setHour(12);
        }

        $nights = max(1, $checkInDate->diffInDays($checkOutDate)); // Tính số đêm ở

        $roomType = RoomType::with(['roomTypeImages', 'amenities', 'rooms', 'services', 'rulesAndRegulations', 'saleRoomTypes'])
            ->where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        // Tính số phòng trống trong khoảng thời gian
        $roomType->available_rooms = $this->calculateAvailableRooms($roomType, $checkInDate, $checkOutDate);

        $roomCount = (int) $request->input('room_count', 1);
        $totalGuests = (int) $request->input('total_guests', 2);
        $childrenCount = (int) $request->input('children_count', 0);

        // Tính tổng giá gốc
        $roomType->total_original_price = $roomType->price * $nights * $roomCount;

        // Tính giá sau khi giảm (nếu có khuyến mãi)
        $now = Carbon::now();
        $sale = $roomType->saleRoomTypes()
            ->where('status', 'active')
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->get();

        $bestSale = null;
        $bestPrice = $roomType->total_original_price;

        foreach ($sale as $s) {
            $discount = $s->type === 'percent'
                ? $bestPrice * ($s->value / 100)
                : $s->value * $roomCount;

            $discounted = max(0, $bestPrice - $discount);

            if ($discounted < $bestPrice) {
                $bestPrice = $discounted;
                $bestSale = $s;
            }
        }

        // Gán lại giá sau giảm và giá theo đêm
        $roomType->total_discounted_price = $bestPrice;
        $roomType->discounted_price_per_night = round($bestPrice / ($nights * $roomCount), 2);
        $roomType->promotion_info = $bestSale ? [
            'name' => $bestSale->name,
            'value' => $bestSale->value,
            'type' => $bestSale->type
        ] : null;

        $formattedDateRange = $this->formatDateRange($checkInDate, $checkOutDate);
        $systems = System::latest()->first();
        $room_rule = RulesAndRegulation::latest()->get();
        $amenities = Amenity::with('roomTypes')->latest()->get();

        return view('client.rooms.roomdetail', compact(
            'roomType',
            'checkIn',
            'checkOut',
            'totalGuests',
            'childrenCount',
            'roomCount',
            'formattedDateRange',
            'nights',
            'systems',
            'room_rule',
            'amenities'
        ));
    }
}
