<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Amenity;
use App\Models\Service;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Models\RulesAndRegulation;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\System;

class HomeController extends Controller
{
    private function calculateAvailableRooms(RoomType $roomType, $checkIn, $checkOut)
    {
        $checkInDate = Carbon::parse($checkIn)->startOfDay();
        $checkOutDate = Carbon::parse($checkOut)->endOfDay();

        $totalRooms = $roomType->rooms()->where('status', 'available')->count();
        Log::info("Total rooms for {$roomType->name}: {$totalRooms}");

        $bookedRooms = Booking::whereHas('rooms', function ($query) use ($roomType) {
            $query->where('room_type_id', $roomType->id);
        })
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->whereBetween('check_in', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out', [$checkInDate, $checkOutDate])
                        ->orWhere(function ($inner) use ($checkInDate, $checkOutDate) {
                            $inner->where('check_in', '<=', $checkInDate)
                                ->where('check_out', '>=', $checkOutDate);
                        });
                })
                    ->where(function ($q) use ($checkInDate) {
                        $q->whereNull('actual_check_out')
                            ->orWhere('actual_check_out', '>=', $checkInDate);
                    })
                    ->whereNotIn('status', ['cancelled', 'cancelled_without_refund', 'refunded', 'check_out']);
            })
            ->sum('room_quantity');
        // dd($bookedRooms);

        Log::info("Booked rooms for {$roomType->name}: {$bookedRooms}, Check-in: {$checkInDate}, Check-out: {$checkOutDate}");

        return max(0, $totalRooms - $bookedRooms);
    }

    
    function filterRooms(Request $request)
    {
        $result = [
            'roomTypes' => [],
            'nights' => 1,
            'totalGuests' => (int)$request->input('total_guests', 2),
            'childrenCount' => (int)$request->input('children_count', 0),
            'roomCount' => (int)$request->input('room_count', 1),
            'checkIn' => null,
            'checkOut' => null,
            'error' => null,
        ];

        try {
            Carbon::setLocale('vi');
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $checkIn = $request->input('check_in', Carbon::today()->setHour(14)->setMinute(0)->setSecond(0)->toDateString());
            $checkOut = $request->input('check_out', Carbon::today()->addDays(1)->setHour(12)->setMinute(0)->setSecond(0)->toDateString());
            $checkInDate = Carbon::parse($checkIn)->startOfDay();
            $checkOutDate = Carbon::parse($checkOut)->startOfDay();

            if ($checkInDate->gte($checkOutDate)) {
                $checkOutDate = $checkInDate->copy()->addDay()->startOfDay();
            }

            $nights = max(1, $checkInDate->diffInDays($checkOutDate));

            $days = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
            $months = ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'];
            $startDay = $days[$checkInDate->dayOfWeek];
            $startDateNum = $checkInDate->day;
            $startMonth = $months[$checkInDate->month - 1];
            $endDay = $days[$checkOutDate->dayOfWeek];
            $endDateNum = $checkOutDate->day;
            $endMonth = $months[$checkOutDate->month - 1];
            $formattedDateRange = "$startDay, $startDateNum $startMonth - $endDay, $endDateNum $endMonth";
        } catch (\Exception $e) {
            $result['error'] = 'Ngày giờ không hợp lệ: ' . $e->getMessage();
            Log::error('FilterRooms error at 01:44 AM +07, 25/06/2025: ' . $e->getMessage());
            return $result;
        }

        $totalPeople = $result['totalGuests'] + $result['childrenCount'];

        $roomTypes = RoomType::select(['id', 'name', 'description', 'price', 'max_capacity', 'size', 'bed_type', 'children_free_limit'])
            ->where('max_capacity', '>=', $totalPeople)
            ->where('is_active', true)
            ->get();

        $roomTypes = $roomTypes->map(function ($roomType) use ($nights, $result) {
            $roomType->total_original_price = $roomType->price * $nights * $result['roomCount'];
            $roomType->available_rooms = $roomType->rooms()->where('status', 'available')->count() ?: 1;
            return $roomType;
        });

        $result = [
            'roomTypes' => $roomTypes,
            'nights' => $nights,
            'totalGuests' => $result['totalGuests'],
            'childrenCount' => $result['childrenCount'],
            'roomCount' => $result['roomCount'],
            'checkIn' => $checkInDate,
            'checkOut' => $checkOutDate,
            'error' => null,
            'formattedDateRange' => $formattedDateRange,
        ];

        return $result;
    }

    public function indexRoom(Request $request)
    {
        $services = Service::where('is_active', true)->get();
        $filterData = $this->filterRooms($request);

        if ($filterData['error']) {
            return back()->with('error', $filterData['error']);
        }

        return view('client.home', array_merge($filterData, ['services' => $services]));
    }

    
public function roomdetail(Request $request, $id)
{
    Carbon::setLocale('vi');
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $checkIn = $request->input('check_in', Carbon::today()->setHour(14)->setMinute(0)->setSecond(0)->toDateTimeString());
    $checkOut = $request->input('check_out', Carbon::tomorrow()->setHour(12)->setMinute(0)->setSecond(0)->toDateTimeString());
    $totalGuests = (int) $request->input('total_guests', 2);
    $childrenCount = (int) $request->input('children_count', 0);
    $roomCount = (int) $request->input('room_count', 1);
    $systems = System::orderBy('id', 'desc')->first();
    $room_rule = RulesAndRegulation::orderBy('id', 'desc')->get();
    $amenities = Amenity::with('roomTypes')->orderBy('id', 'desc')->get();

    try {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        $now = Carbon::now();

        // Kiểm tra nếu ngày nhận phòng là ngày hiện tại
        //            if ($checkInDate->isToday()) {
        //                // Nếu thời gian hiện tại từ 21:00 đến 23:59:59, đẩy ngày nhận phòng sang ngày hôm sau
        //                if ($now->hour >= 21 && $now->hour < 24) {
        //                    $checkInDate = $now->copy()->addDay()->setHour(14)->setMinute(0)->setSecond(0);
        //                    $checkIn = $checkInDate->toDateTimeString();
        //                }
        //            }

        // Đảm bảo ngày trả phòng luôn sau ngày nhận phòng
        if ($checkInDate->gte($checkOutDate)) {
            $checkOutDate = $checkInDate->copy()->addDay()->setHour(12)->setMinute(0)->setSecond(0);
            $checkOut = $checkOutDate->toDateTimeString();
            // $request->session()->flash('info', 'Ngày trả phòng đã được điều chỉnh để sau ngày nhận phòng.');
        } else {
            // Giữ nguyên ngày trả phòng nếu nó đã hợp lệ (sau ngày nhận phòng)
            $checkOut = $checkOutDate->toDateTimeString();
        }

        $nights = $checkInDate->diffInDays($checkOutDate);
        if ($nights < 1) {
            $nights = 1;
        }

        $days = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
        $months = ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'];
        $startDay = $days[$checkInDate->dayOfWeek];
        $startDateNum = $checkInDate->day;
        $startMonth = $months[$checkInDate->month - 1];
        $startTime = $checkInDate->format('H:i');
        $endDay = $days[$checkOutDate->dayOfWeek];
        $endDateNum = $checkOutDate->day;
        $endMonth = $months[$checkOutDate->month - 1];
        $endTime = $checkOutDate->format('H:i');
        $formattedDateRange = "{$startDay}, {$startDateNum} {$startMonth} {$startTime} - {$endDay}, {$endDateNum} {$endMonth} {$endTime}";
    } catch (\Exception $e) {
        return back()->with('error', 'Ngày giờ không hợp lệ.');
    }

    $roomType = RoomType::with(['roomTypeImages', 'amenities', 'rooms', 'services', 'rulesAndRegulations'])
        ->where('id', $id)
        ->where('is_active', true)
        ->firstOrFail();

    $availableRooms = $this->calculateAvailableRooms($roomType, $checkInDate, $checkOutDate);
    $roomType->available_rooms = $availableRooms;

    $roomType->total_original_price = $roomType->price * $nights * $roomCount;

    Log::info("Room: {$roomType->name}, Price: {$roomType->price}, Nights: $nights, RoomCount: $roomCount, Original: {$roomType->total_original_price}");

    return view('client.rooms.roomdetail', compact('roomType', 'checkIn', 'checkOut', 'totalGuests', 'childrenCount', 'roomCount', 'formattedDateRange', 'nights', 'systems', 'room_rule', 'amenities'));
}
}