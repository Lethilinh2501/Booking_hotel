<?php

namespace App\Http\Controllers;

use id;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->latest()->paginate(10);
         dd($reviews);
        return view('admin.reviews.index', compact('reviews'));
    }
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

        return redirect('/')->with('success', 'Đánh giá thành công.');
    }
    public function show($id)
    {
        $review = Review::with(['user','booking'])->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }
     public function updateResponse(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string'
        ]);

        $review = Review::findOrFail($id);
        $review->response = $request->response;
        $review->save();

        return redirect()->back()->with('success', 'Cập nhật phản hồi thành công.');
    }
    // public function destroy($id)
    // {
    //     $contact = Review::findOrFail($id);
    //     $contact->delete();

    //     return redirect()->back()->with('success', 'Xóa liên hệ thành công.');
    // }
    
}
