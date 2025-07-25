<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\RoomType;
use App\Models\Promotion;
use App\Models\ServicePlus;
use App\Mail\BookingSuccess;
use Illuminate\Http\Request;
use App\Models\RoomTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\BookingRoomTypeService;
use App\Models\PaymentSetting;
use App\Models\RefundPolicy;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index()
    {
        $title = 'Danh sách đặt phòng của bạn';

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem danh sách đặt phòng.');
        }

        $bookings = Booking::with(['rooms', 'rooms.roomType', 'rooms.roomType.roomTypeImages'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('client.bookings.index', compact('bookings', 'title'));
    }

    public function create(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt phòng.');
        }

        Carbon::setLocale('vi');
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $roomTypeId = $request->input('room_type_id');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $totalGuests = (int) $request->input('total_guests', 2);
        $childrenCount = (int) $request->input('children_count', 0);
        $roomQuantity = (int) $request->input('room_quantity', 1);
        $services = $request->input('services', []); // Mảng chứa service_id => quantity

        $basePrice = (float) $request->input('base_price');
        $discountedPrice = (float) $request->input('discounted_price');
        $discountAmount = (float) $request->input('discount_amount');
        $serviceTotal = (float) $request->input('service_total');

        $subTotal = $discountedPrice + $serviceTotal;
        $taxFee = $subTotal * 0.08;
        $totalPrice = $subTotal + $taxFee;

        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'total_guests' => 'required|integer|min:1',
            'children_count' => 'required|integer|min:0',
            'room_quantity' => 'required|integer|min:1',
            'base_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0',
            'discount_amount' => 'required|numeric|min:0',
            'service_total' => 'required|numeric|min:0',
        ]);

        $checkIn = Carbon::parse($checkIn)->startOfDay();
        $checkOut = Carbon::parse($checkOut)->startOfDay();
        $now = Carbon::now();

        if ($checkIn->lt($now->startOfDay()) || ($checkIn->isToday() && $now->hour >= 22)) {
            $checkIn = $now->copy()->addDay()->startOfDay();
            $checkOut = $checkIn->copy()->addDay();
            $request->session()->flash('warning', 'Đặt phòng vào thời điểm này sẽ được check-in từ ngày mai (' . $checkIn->format('d/m/Y') . ').');
        }

        if ($checkIn->gte($checkOut)) {
            $checkOut = $checkIn->copy()->addDay();
            $request->session()->flash('warning', 'Ngày trả phòng đã được điều chỉnh để sau ngày nhận phòng.');
        }

        $days = $checkOut->diffInDays($checkIn);

        $selectedRoomType = RoomType::with([
            'amenities' => function ($query) {
                $query->where('is_active', true);
            },
            'services' => function ($query) {
                $query->where('is_active', true);
            },
            'roomTypeImages',
            'rooms'
        ])->findOrFail($roomTypeId);

        $allRooms = $selectedRoomType->rooms;
        $bookedRoomIds = Booking::whereHas('rooms', function ($query) use ($selectedRoomType) {
            $query->where('room_type_id', $selectedRoomType->id);
        })
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                    });
            })
            ->where(function ($q) use ($checkIn) {
                $q->whereNull('actual_check_out')
                    ->orWhere('actual_check_out', '>=', $checkIn);
            })
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->with('rooms')
            ->get()
            ->flatMap(function ($booking) {
                return $booking->rooms->pluck('id');
            })
            ->unique()
            ->toArray();

        $availableRooms = $allRooms->whereNotIn('id', $bookedRoomIds);
        $availableRoomCount = $availableRooms->count();

        if ($roomQuantity > $availableRoomCount) {
            return redirect()->route('home')->with('error', "Số lượng phòng yêu cầu ($roomQuantity) vượt quá số phòng còn trống ($availableRoomCount).");
        }

        $selectedRooms = $availableRooms->take($roomQuantity);
        $user = Auth::user();

        $selectedServicesWithQuantity = [];
        $selectedServiceIds = array_keys(array_filter($services, fn($quantity) => $quantity > 0));
        $selectedServices = $selectedRoomType->services->whereIn('id', $selectedServiceIds);

        foreach ($selectedServices as $service) {
            $quantity = $services[$service->id] ?? 0;
            if ($quantity > 0) {
                $selectedServicesWithQuantity[] = [
                    'id' => $service->id,
                    'name' => $service->name,
                    'price' => $service->price,
                    'quantity' => $quantity,
                ];
            }
        }

        $request->session()->put('selected_services', $selectedServicesWithQuantity);

        return view('client.bookings.create', [
            'roomType' => $selectedRoomType,
            'checkIn' => $checkIn->toDateString(),
            'checkOut' => $checkOut->toDateString(),
            'totalGuests' => $totalGuests,
            'childrenCount' => $childrenCount,
            'roomQuantity' => $roomQuantity,
            'selectedServices' => $selectedServicesWithQuantity,
            'selectedRooms' => $selectedRooms,
            'availableRoomCount' => $availableRoomCount,
            'days' => $days,
            'basePrice' => $basePrice,
            'discountedPrice' => $discountedPrice,
            'discountAmount' => $discountAmount,
            'serviceTotal' => $serviceTotal,
            'taxFee' => $taxFee,
            'totalPrice' => $totalPrice,
            'user' => $user,
        ]);
    }

    public function confirm(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'check_in' => 'required|date|after_or_equal:today',
                'check_out' => 'required|date|after:check_in',
                'total_guests' => 'required|integer|min:1',
                'children_count' => 'required|integer|min:0',
                'room_type_id' => 'required|exists:room_types,id',
                'room_quantity' => 'required|integer|min:1',
                'special_request' => 'nullable|string',
                'guest.name' => 'required|string|max:255',
                'guest.email' => 'required|email',
                'guest.phone' => 'required|string|regex:/^[0-9]{10,15}$/',
                'guest.country' => 'required|string|max:255',
                'guest.relationship' => 'nullable|string|max:50',
                'services' => 'nullable|array',
                'services.*.id' => 'exists:room_type_services,id',
                'services.*.quantity' => 'integer|min:1',
                'services.*.price' => 'numeric|min:0',
                'discount_amount' => 'nullable|numeric|min:0',
                'base_price' => 'required|numeric|min:0',
                'service_total' => 'required|numeric|min:0',
            ]);

            $roomType = RoomType::with('services')->findOrFail($request->room_type_id);
            $checkIn = Carbon::parse($validated['check_in']);
            $checkOut = Carbon::parse($validated['check_out']);
            $days = $checkOut->diffInDays($checkIn);

            $basePrice = (float) $request->base_price;
            $discountAmount = (float) $request->discount_amount ?? 0;
            $totalGuests = (int) $request->total_guests;
            $childrenCount = (int) $request->children_count;
            $roomQuantity = (int) $request->room_quantity;
            $serviceTotal = (float) $request->service_total;

            $selectedServices = [];
            $serviceQuantities = [];
            if (!empty($validated['services'])) {
                $serviceIds = array_column($validated['services'], 'id');
                $selectedServices = $roomType->services->whereIn('id', $serviceIds)->all();

                foreach ($validated['services'] as $serviceData) {
                    $serviceId = (int) $serviceData['id'];
                    $quantity = (int) ($serviceData['quantity'] ?? 1);
                    $serviceQuantities[$serviceId] = $quantity;
                    $serviceTotal += ($serviceData['price'] ?? 0) * $quantity;
                }
            }

            $subTotal = ($basePrice - $discountAmount) + $serviceTotal;
            $taxFee = $subTotal * 0.08;
            $totalPrice = $subTotal + $taxFee;

            $guestData = $request->input('guest');
            $paymentSetting = PaymentSetting::first();
            $depositPercentage = $paymentSetting ? $paymentSetting->deposit_percentage : 0;

            return view('client.bookings.confirm', [
                'roomType' => $roomType,
                'checkIn' => $checkIn->toDateString(),
                'checkOut' => $checkOut->toDateString(),
                'days' => $days,
                'basePrice' => $basePrice,
                'serviceTotal' => $serviceTotal,
                'subTotal' => $subTotal,
                'taxFee' => $taxFee,
                'totalPrice' => $totalPrice,
                'selectedServices' => $selectedServices,
                'discountAmount' => $discountAmount,
                'totalGuests' => $totalGuests,
                'childrenCount' => $childrenCount,
                'roomQuantity' => $roomQuantity,
                'serviceQuantities' => $serviceQuantities,
                'guestData' => $guestData,
                'deposit_percentage' => $depositPercentage,
            ]);
        }

        return redirect()->route('bookings.create')->with('error', 'Vui lòng hoàn tất thông tin đặt phòng trước khi xác nhận.');
    }

    public function calculateDepositAmount($totalAmount)
    {
        $depositPercentage = PaymentSetting::first()->deposit_percentage;
        return $totalAmount * ($depositPercentage / 100);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'check_in' => 'required|date|after_or_equal:today',
                'check_out' => 'required|date|after:check_in',
                'total_guests' => 'required|integer|min:1',
                'children_count' => 'required|integer|min:0',
                'room_type_id' => 'required|exists:room_types,id',
                'room_quantity' => 'required|integer|min:1',
                'special_request' => 'nullable|string',
                'guests.*.name' => 'required|string|max:255',
                'guests.*.email' => 'required|email',
                'guests.*.phone' => 'required|string|regex:/^[0-9]{10,15}$/',
                'guests.*.country' => 'required|string|max:255',
                'guests.*.relationship' => 'nullable|string|max:50',
                'services' => 'nullable|array',
                'services.*.id' => 'exists:room_type_services,id',
                'services.*.quantity' => 'integer|min:1',
                'services.*.price' => 'numeric|min:0',
                'discount_amount' => 'nullable|numeric|min:0',
                'payment_method' => 'required|in:cash,online',
                'online_payment_method' => 'required_if:payment_method,online|in:vnpay',
                'base_price' => 'required|numeric|min:0',
                'service_total' => 'required|numeric|min:0',
                'tax_fee' => 'required|numeric|min:0',
                'sub_total' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
            ]);

            $data = $request->all();
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt phòng.');
            }

            $paymentMethod = $request->input('payment_method');
            $onlinePaymentMethod = $request->input('online_payment_method');
            if ($paymentMethod === 'online' && !$onlinePaymentMethod) {
                return redirect()->back()->with('error', 'Vui lòng chọn một cổng thanh toán (VNPay).');
            }

            Log::info('Request data in store:', $data);

            $checkIn = Carbon::parse($validated['check_in'])->setTime(14, 0, 0);
            $checkOut = Carbon::parse($validated['check_out'])->setTime(12, 0, 0);
            $days = $checkOut->diffInDays($checkIn);

            $roomType = RoomType::findOrFail($validated['room_type_id']);
            $basePrice = (float) $request->input('base_price');
            $discountAmount = (float) $request->input('discount_amount', 0);
            $serviceTotal = (float) $request->input('service_total');
            $taxFee = (float) $request->input('tax_fee');
            $subTotal = (float) $request->input('sub_total');
            $totalPrice = (float) $request->input('total_price');

            $booking = Booking::create([
                'booking_code' => 'BOOK' . time(),
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $totalPrice,
                'base_price' => $basePrice,
                'service_total' => $serviceTotal,
                'tax_fee' => $taxFee,
                'sub_total' => $subTotal,
                'discount_amount' => $discountAmount,
                'total_guests' => $validated['total_guests'],
                'children_count' => $validated['children_count'],
                'user_id' => $user->id,
                'room_type_id' => $validated['room_type_id'],
                'room_quantity' => $validated['room_quantity'],
                'special_request' => $request->input('special_request'),
                'service_plus_status' => !empty($validated['services']) ? 'not_yet_paid' : 'none',
                'payment_method' => $paymentMethod == 'cash' ? 'cash' : $onlinePaymentMethod,
                'status' => 'unpaid',
                'paid_amount' => 0,
            ]);

            if (!empty($validated['services'])) {
                foreach ($validated['services'] as $serviceData) {
                    BookingRoomTypeService::create([
                        'booking_id' => $booking->id,
                        'room_type_service_id' => $serviceData['id'],
                        'quantity' => $serviceData['quantity'],
                        'price' => $serviceData['price'],
                    ]);
                }
            }

            if (!empty($data['promotion_id'])) {
                $promotion = Promotion::findOrFail($data['promotion_id']);
                $hasUsedPromotion = DB::table('booking_promotions')
                    ->join('bookings', 'booking_promotions.booking_id', '=', 'bookings.id')
                    ->where('booking_promotions.promotion_id', $promotion->id)
                    ->where('bookings.user_id', Auth::id())
                    ->exists();

                if ($hasUsedPromotion) {
                    DB::rollBack();
                    return redirect()->route('home')->with('error', 'Đã từng sử dụng mã này rồi!');
                }
                if ($promotion->quantity > 0) {
                    $promotion->decrement('quantity');
                    $booking->promotions()->attach($promotion->id);
                } else {
                    DB::rollBack();
                    return redirect()->route('home')->with('error', 'Đã hết mã giảm giá này.');
                }
            }

            $allRooms = $roomType->rooms;
            $bookedRoomIds = Booking::whereHas('rooms', function ($query) use ($roomType) {
                $query->where('room_type_id', $roomType->id);
            })
                ->where('id', '!=', $booking->id)
                ->where(function ($query) use ($checkIn, $checkOut) {
                    $query->whereBetween('check_in', [$checkIn, $checkOut])
                        ->orWhereBetween('check_out', [$checkIn, $checkOut])
                        ->orWhere(function ($q) use ($checkIn, $checkOut) {
                            $q->where('check_in', '<=', $checkIn)
                                ->where('check_out', '>=', $checkOut);
                        });
                })
                ->where(function ($q) use ($checkIn) {
                    $q->whereNull('actual_check_out')
                        ->orWhere('actual_check_out', '>=', $checkIn);
                })
                ->whereNotIn('status', ['cancelled', 'refunded'])
                ->with('rooms')
                ->get()
                ->flatMap(function ($booking) {
                    return $booking->rooms->pluck('id');
                })
                ->unique()
                ->toArray();

            $availableRooms = $allRooms->whereNotIn('id', $bookedRoomIds);
            if ($validated['room_quantity'] > $availableRooms->count()) {
                DB::rollBack();
                return redirect()->route('home')->with('error', 'Không đủ phòng trống để đặt.');
            }

            $selectedRooms = $availableRooms->take($validated['room_quantity']);
            $booking->rooms()->attach($selectedRooms->pluck('id'));

            $guests = $request->input('guests', []);
            foreach ($guests as $guestData) {
                $guest = Guest::create([
                    'name' => $guestData['name'],
                    'email' => $guestData['email'],
                    'phone' => $guestData['phone'],
                    'country' => $guestData['country'],
                    'relationship' => $guestData['relationship'] ?? 'Người ở chính',
                ]);
                $booking->guests()->attach($guest->id);
            }

            $isPartial = $request->input('payment_amount_type') === 'partial';
            $depositPercentage = PaymentSetting::first()->deposit_percentage ?? 0;
            $depositAmount = $isPartial ? ($totalPrice * ($depositPercentage / 100)) : $totalPrice;

            $paymentData = [
                'user_id' => $user->id,
                'booking_id' => $booking->id,
                'amount' => $depositAmount,
                'status' => 'pending',
                'transaction_id' => null,
                'is_partial' => $isPartial,
            ];

            if ($paymentMethod == 'cash') {
                $paymentData['method'] = 'cash';
                $payment = Payment::create($paymentData);
                Mail::to($user->email)->send(new BookingSuccess($booking));
                DB::commit();
                return redirect()->route('bookings.show', $booking->id)->with('success', 'Đặt phòng của bạn đã hoàn tất! Thông tin chi tiết đã được gửi qua email. Vui lòng thanh toán bằng tiền mặt khi đến nhận phòng.');
            } else {
                $paymentData['method'] = $onlinePaymentMethod;
                $payment = Payment::create($paymentData);

                if ($onlinePaymentMethod == 'vnpay') {
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = route('bookings.return.vnpay', $booking->id);
                    $vnp_TmnCode = env('VNP_TMNCODE', '6Q5Z9DG8');
                    $vnp_HashSecret = env('VNP_HASHSECRET', 'NSEYDYAIT1XETEVUA24DF40DOCMC6NYE');

                    $vnp_TxnRef = $booking->booking_code . '-' . time();
                    $vnp_OrderInfo = 'Thanh toán đặt phòng ' . $booking->booking_code;
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = (int) $depositAmount * 100;
                    $vnp_Locale = 'vn';
                    $vnp_BankCode = '';
                    $vnp_IpAddr = $request->ip();
                    $vnp_CreateDate = date('YmdHis');
                    $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

                    $inputData = [
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => $vnp_CreateDate,
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                        "vnp_ExpireDate" => $vnp_ExpireDate,
                    ];

                    ksort($inputData);
                    $hashdata = "";
                    $first = true;
                    foreach ($inputData as $key => $value) {
                        if ($first) {
                            $hashdata .= $key . "=" . urlencode($value);
                            $first = false;
                        } else {
                            $hashdata .= "&" . $key . "=" . urlencode($value);
                        }
                    }

                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                    $vnp_Url .= "?" . $hashdata . "&vnp_SecureHash=" . $vnpSecureHash;

                    Log::info('VNPay URL generated:', ['url' => $vnp_Url]);

                    $payment->update(['transaction_id' => $vnp_TxnRef]);
                    DB::commit();

                    return redirect()->away($vnp_Url);
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error in store method:', ['exception' => $exception->getMessage(), 'trace' => $exception->getTraceAsString()]);
            return redirect()->route('bookings.create')->with('error', 'Đã xảy ra lỗi: ' . $exception->getMessage());
        }
    }

    public function paymentCallback(Request $request)
    {
        $data = $request->all();
        $secretKey = env('MOMO_SECRET_KEY');

        $rawHash = "accessKey=" . env('MOMO_ACCESS_KEY') . "&amount=" . $data['amount'] . "&extraData=" . $data['extraData'] . "&message=" . $data['message'] . "&orderId=" . $data['orderId'] . "&orderInfo=" . $data['orderInfo'] . "&orderType=" . $data['orderType'] . "&partnerCode=" . $data['partnerCode'] . "&payType=" . $data['payType'] . "&requestId=" . $data['requestId'] . "&responseTime=" . $data['responseTime'] . "&resultCode=" . $data['resultCode'] . "&transId=" . $data['transId'];
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($signature !== $data['signature']) {
            Log::error('MoMo Callback - Invalid signature', ['data' => $data]);
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
        }

        $extraData = json_decode(base64_decode($data['extraData']), true);
        $bookingId = $extraData['booking_id'];

        $booking = Booking::findOrFail($bookingId);
        $payment = Payment::where('booking_id', $bookingId)->first();

        if ($data['resultCode'] == 0) {
            $payment->update([
                'status' => 'completed',
                'transaction_id' => $data['transId'],
            ]);
            $booking->update(['status' => 'paid']);
            $message = 'Thanh toán thành công! Đặt phòng của bạn đã được xác nhận.';
        } else {
            $payment->update(['status' => 'failed']);
            $booking->update(['status' => 'cancelled']);
            $message = 'Thanh toán thất bại. Đặt phòng của bạn đã bị hủy.';
        }

        return redirect()->route('bookings.show', $booking->id)->with('success', $message);
    }

    public function show(string $id)
    {
        $booking = Booking::with([
            'user',
            'rooms.roomType' => function ($query) {
                $query->with([
                    'amenities' => function ($query) {
                        $query->where('is_active', true);
                    },
                    'rulesAndRegulations' => function ($query) {
                        $query->where('is_active', true);
                    },
                    'services',
                    'roomTypeImages'
                ]);
            },
            'rooms' => function ($query) {
                $query->withTrashed();
            },
            'services.service',
            'payments',
            'guests',
        ])->findOrFail($id);

        $paymentSetting = PaymentSetting::first();
        $refundPolicies = RefundPolicy::all();

        $title = 'Chi tiết đơn đặt phòng';
        return view('client.bookings.show', compact('title', 'booking', 'paymentSetting', 'refundPolicies'));
    }

    public function edit(string $id)
    {
        $booking = Booking::with(['rooms', 'rooms.roomType', 'servicePlus'])->findOrFail($id);
        return view('client.bookings.edit', compact('booking'));
    }

    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);
        $currentStatus = $booking->status;
        $newStatus = $request->input('status');

        if ($currentStatus === 'confirmed' && $newStatus === 'cancelled') {
            $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
            $booking->update([
                'status' => $newStatus,
                'actual_check_in' => $currentTime,
                'actual_check_out' => $currentTime,
            ]);
            return redirect()->route('bookings.index')->with('success', 'Hủy đặt phòng thành công!');
        }

        return redirect()->back()->with('error', 'Không thể thay đổi trạng thái từ ' . $currentStatus . ' sang ' . $newStatus . '.');
    }

    public function destroy(string $id): JsonResponse
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền xóa đơn đặt này!'
            ], 403);
        }

        $now = Carbon::now();
        $checkInDate = Carbon::parse($booking->check_in);
        if ($booking->status !== 'pending' || $checkInDate->diffInHours($now) < 24) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa đơn đặt này vì đã được xác nhận hoặc quá gần ngày nhận phòng!'
            ], 400);
        }

        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa đơn đặt thành công!'
        ], 200);
    }

    public function checkPromotion(Request $request)
    {
        $promotionCode = $request->input('code');
        $basePrice = (float) $request->input('base_price');
        $serviceTotal = (float) $request->input('service_total');

        $subTotal = $basePrice + $serviceTotal;

        $promotion = Promotion::where('code', $promotionCode)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->where('quantity', '>', 0)
            ->where('status', 'active')
            ->first();

        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'
            ]);
        }

        if (Auth::check()) {
            $userId = Auth::id();
            $hasUsedPromotion = DB::table('booking_promotions')
                ->join('bookings', 'booking_promotions.booking_id', '=', 'bookings.id')
                ->where('booking_promotions.promotion_id', $promotion->id)
                ->where('bookings.user_id', $userId)
                ->exists();

            if ($hasUsedPromotion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn đã sử dụng mã giảm giá này trước đây. Mỗi người chỉ được sử dụng mã này một lần.'
                ]);
            }
        }

        $minBookingAmount = (float) $promotion->min_booking_amount;
        $maxDiscountValue = (float) $promotion->max_discount_value;
        $promotionValue = (float) $promotion->value;

        if ($subTotal < $minBookingAmount) {
            return response()->json([
                'success' => false,
                'message' => 'Tổng giá trị đơn hàng chưa đạt mức tối thiểu ' . number_format($minBookingAmount, 0, ',', '.') . ' VND để áp dụng mã này.'
            ]);
        }

        $discountAmount = $promotion->type === 'percent'
            ? $subTotal * ($promotionValue / 100)
            : $promotionValue;

        if ($maxDiscountValue > 0) {
            $discountAmount = min($discountAmount, $maxDiscountValue);
        }

        $discountAmount = min($discountAmount, $subTotal);
        $discountAmount = round($discountAmount, 2);

        $newSubTotal = $subTotal - $discountAmount;
        $taxFee = round($newSubTotal * 0.08, 2);
        $newTotalPrice = round($newSubTotal + $taxFee, 2);

        return response()->json([
            'success' => true,
            'discount_amount' => $discountAmount,
            'new_total_price' => $newTotalPrice,
            'tax_fee' => $taxFee,
            'promotion_id' => $promotion->id,
            'message' => 'Mã giảm giá đã được áp dụng thành công!'
        ]);
    }

    public function returnVnpay($id)
    {
        $booking = Booking::findOrFail($id);
        $vnp_ResponseCode = request('vnp_ResponseCode');
        $vnp_TxnRef = request('vnp_TxnRef');
        $vnp_SecureHash = request('vnp_SecureHash');

        $inputData = request()->all();
        $vnp_HashSecret = env('VNP_HASHSECRET', 'NSEYDYAIT1XETEVUA24DF40DOCMC6NYE');
        ksort($inputData);
        $hashData = "";
        $first = true;
        foreach ($inputData as $key => $value) {
            if ($key !== 'vnp_SecureHash' && $value !== '') {
                if ($first) {
                    $hashData .= $key . '=' . $value;
                    $first = false;
                } else {
                    $hashData .= '&' . $key . '=' . $value;
                }
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($vnp_ResponseCode == '00' && $secureHash === $vnp_SecureHash) {
            $booking->status = 'paid';
            $booking->paid_amount = $booking->total_price;
            $booking->save();

            $payment = $booking->payments()->first();
            $payment->status = 'completed';
            $payment->transaction_id = $vnp_TxnRef;
            $payment->save();

            return redirect()->route('bookings.show', $id)->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->route('bookings.show', $id)->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
        }
    }

    public function processNextPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'payment_method' => 'required|in:momo,vnpay',
            'payment_amount_type' => 'required|in:full,partial'
        ]);

        $paymentAmount = $booking->total_price;
        if ($validated['payment_amount_type'] == 'partial') {
            $depositPercentage = PaymentSetting::first()->deposit_percentage ?? 0;
            $paymentAmount = $paymentAmount * ($depositPercentage / 100);
        }

        $paymentData = [
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'amount' => $paymentAmount,
            'status' => 'pending',
            'transaction_id' => null,
            'is_partial' => $validated['payment_amount_type'] == 'partial',
        ];

        $paymentMethod = $validated['payment_method'];
        if ($paymentMethod == 'vnpay') {
            $payment = Payment::create($paymentData);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('bookings.return.vnpay', $booking->id);
            $vnp_TmnCode = env('VNP_TMNCODE', '6Q5Z9DG8');
            $vnp_HashSecret = env('VNP_HASHSECRET', 'NSEYDYAIT1XETEVUA24DF40DOCMC6NYE');

            $vnp_TxnRef = $booking->booking_code . '-' . time();
            $vnp_OrderInfo = 'Thanh toán đặt phòng ' . $booking->booking_code;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = (int) $paymentAmount * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = '';
            $vnp_IpAddr = $request->ip();
            $vnp_CreateDate = date('YmdHis');
            $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => $vnp_CreateDate,
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $vnp_ExpireDate,
            ];

            if (!empty($vnp_BankCode)) {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $hashdata = "";
            $first = true;
            foreach ($inputData as $key => $value) {
                if ($first) {
                    $hashdata .= $key . "=" . urlencode($value);
                    $first = false;
                } else {
                    $hashdata .= "&" . $key . "=" . urlencode($value);
                }
            }

            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= "?" . $hashdata . "&vnp_SecureHash=" . $vnpSecureHash;

            $payment->update(['transaction_id' => $vnp_TxnRef]);
            DB::commit();

            return redirect($vnp_Url);
        }
    }
}
