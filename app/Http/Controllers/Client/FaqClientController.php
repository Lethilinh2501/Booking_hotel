<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqClientController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('client.faqs.index', compact('faqs'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => null, 
            'is_active' => false, 
        ]);

        return redirect()->route('client.faqs.index')->with('success', 'Câu hỏi của bạn đã được gửi. Chúng tôi sẽ phản hồi sớm!');
    }
}

