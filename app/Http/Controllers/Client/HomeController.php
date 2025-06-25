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

class HomeController extends Controller
{
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

    public function roomdetail($id, Request $request)
    {
        try {
            $filterData = $this->filterRooms($request);
            if ($filterData['error']) {
                return back()->with('error', $filterData['error']);
            }

            $roomType = RoomType::with('rooms', 'services')->findOrFail($id);
            $amenities = Amenity::where('is_active', true)->get();
            $rules = RulesAndRegulation::where('is_active', true)->get();
            $services = Service::where('is_active', true)->get();

            $maxCapacity = $roomType->max_capacity ?? 4;
            $maxChildrenLimit = $roomType->children_free_limit ?? 2;
            $totalAvailableRooms = $roomType->rooms()->where('status', 'available')->count() ?? 10;

            $originalPrice = $roomType->total_original_price ?? ($roomType->price * $filterData['nights'] * $filterData['roomCount']);
            $serviceTotal = 0;
            if ($request->has('services')) {
                foreach ($request->input('services') as $serviceId => $quantity) {
                    $service = Service::find($serviceId);
                    if ($service && $service->is_active) {
                        $serviceTotal += $service->price * $quantity * $filterData['nights'];
                    }
                }
            }

            $subTotal = $originalPrice + $serviceTotal;
            $taxRate = 0.08;
            $taxFee = $subTotal * $taxRate;
            $grandTotal = $subTotal + $taxFee;

            Log::info('Roomdetail request at 01:44 AM +07, 25/06/2025: ', $request->all());
            Log::info('Processed dates at 01:44 AM +07, 25/06/2025 - checkIn: ' . $filterData['checkIn']->toDateTimeString() . ', checkOut: ' . $filterData['checkOut']->toDateTimeString());

            return view('client.rooms.roomdetail', array_merge($filterData, [
                'roomType' => $roomType,
                'amenities' => $amenities,
                'rules' => $rules,
                'services' => $services,
                'maxCapacity' => $maxCapacity,
                'maxChildrenLimit' => $maxChildrenLimit,
                'totalAvailableRooms' => $totalAvailableRooms,
                'originalPrice' => $originalPrice,
                'serviceTotal' => $serviceTotal,
                'subTotal' => $subTotal,
                'taxFee' => $taxFee,
                'grandTotal' => $grandTotal,
                'taxRate' => $taxRate,
            ]));
        } catch (\Exception $e) {
            Log::error('Error in roomdetail at 01:44 AM +07, 25/06/2025: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}