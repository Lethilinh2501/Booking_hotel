<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $title = "Danh sách đánh giá";
        $reviews = Review::with(['user', 'booking'])->latest()->get();
        return view('admin.reviews.index', compact('reviews', 'title'));
    }

    public function show(Review $review)
    {
        $review->load(['user', 'booking']);
        return view('admin.reviews.show', compact('review'));
    }

    public function response(Request $request, Review $review)
    {
        $request->validate(['response' => 'required|string']);

        try {
            $review->update(['response' => $request->response]);
            return redirect()
                ->route('admin.reviews.index')
                ->with('success', 'Phản hồi đã được cập nhật.');
        } catch (\Throwable $th) {
            return back()
                ->with('error', 'Đã có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}
