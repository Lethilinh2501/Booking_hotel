<?php namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionClientController extends Controller
{
    public function index()
    {
        $promotions = Promotion::where('status', 'active')
            ->where('quantity', '>', 0)
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', Carbon::now());
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('client.promotions.index', compact('promotions'));
    }
}

