<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
{
    public function index()
    {
        $baseUrl = request()->getSchemeAndHttpHost(); // Gets the current scheme (http/https) and host
        $userCode = Auth::guard('pharmacy')->user()->code;
        $fullUrl = "{$baseUrl}/pharmacy/{$userCode}";
    
        $qrcode = QrCode::size(200)->generate($fullUrl);
    
        return view('main.profile', compact('qrcode'));
    }
    
}
