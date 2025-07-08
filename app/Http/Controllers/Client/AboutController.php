<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::where('is_use', 1)->first();
        return view('client.about.about', compact('about')); 
    }
}
