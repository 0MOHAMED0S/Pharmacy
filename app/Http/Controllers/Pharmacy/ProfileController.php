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
        $qrcode = QrCode::size(200)->generate(Auth::guard('pharmacy')->user()->code);
        return view('main.profile', compact('qrcode'));
    }
}
