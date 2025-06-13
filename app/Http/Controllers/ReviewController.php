<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviewForm($bookingID)
    {
        $booking = \App\Models\Booking::findOrFail($bookingID);

        // Kiểm tra xem người dùng hiện tại có phải người đặt booking không
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Không có quyền thực hiện thao tác này');
        }

        return view('client.reviews.form', compact('booking'));
    }

    public function submitReview(Request $request, $bookingID)
    {
        $booking = \App\Models\Booking::findOrFail($bookingID);

        // Kiểm tra xem người dùng hiện tại có phải người đặt booking không
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Không có quyền thực hiện thao tác này');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'booking_id' => $bookingID,
            'rating' => request('rating'),
            'comment' => request('comment'),
        ];

        Review::create($data);

        return redirect()->route('reviews.index')->with('success', 'Đánh giá thành công.');
    }
}
