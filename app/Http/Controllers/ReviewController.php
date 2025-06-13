<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviewForm($bookingID)
    {
        $booking = \App\Models\Booking::findOrFail($bookingID);

        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('client.reviews.form', compact('booking'));
    }

    public function submitReview(Request $request, $bookingID)
    {
        $booking = \App\Models\Booking::findOrFail($bookingID);

        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Logic to handle form submission for creating a new review
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
