<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\System;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $services = Service::where('is_active', 1)->get();

        Carbon::setLocale('vi');
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $checkIn = $request->input('check_in', Carbon::today()->setHour(14)->setMinute(0)->setSecond(0)->toDateTimeString());
        $checkOut = $request->input('check_out', Carbon::tomorrow()->setHour(12)->setMinute(0)->setSecond(0)->toDateTimeString());
        $totalGuests = (int) $request->input('total_guests', 2);
        $childrenCount = (int) $request->input('children_count', 0);
        $roomCount = (int) $request->input('room_count', 1);

        try {
            $checkInDate = Carbon::parse($checkIn);
            $checkOutDate = Carbon::parse($checkOut);

            if ($checkInDate->gte($checkOutDate)) {
                $checkOutDate = $checkInDate->copy()->addDay()->setHour(12)->setMinute(0)->setSecond(0);
            }

            $nights = max(1, $checkInDate->diffInDays($checkOutDate));

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

            $formattedDateRange = "$startDay, $startDateNum $startMonth $startTime - $endDay, $endDateNum $endMonth $endTime";
        } catch (\Exception $e) {
            return back()->with('error', 'Ngày giờ không hợp lệ.');
        }

        $totalPeople = $totalGuests + $childrenCount;

        $roomTypes = RoomType::select([
            'id',
            'name',
            'description',
            'price',
            'max_capacity',
            'size',
            'bed_type',
            'children_free_limit'
        ])

            ->where('max_capacity', '>=', $totalPeople)
            ->where('is_active', 1)
            ->get();

        $roomTypes = $roomTypes->map(function ($roomType) use ($nights, $roomCount) {
            $roomType->total_original_price = $roomType->price * $nights * $roomCount;
            $roomType->available_rooms = 1; // Placeholder
            return $roomType;
        });

        return view('client.home', compact('roomTypes', 'nights', 'totalGuests', 'childrenCount', 'roomCount', 'services'));
    }
}
