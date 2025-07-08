<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\System;

class SystemController extends Controller
{
    public function index()
    {
        $system = System::where('is_use', 1)->first();
        return view('client.system.index', compact('system'));
    }
}
