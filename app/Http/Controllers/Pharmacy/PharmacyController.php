<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function index($code)
{
    $pharmacy = Pharmacy::where('code', $code)->first();

    if (!$pharmacy) {
        abort(404, 'Pharmacy not found');
    }

    $medicines = $pharmacy->medicines; // Fetch related medicines

    return view('main.pharmacy', compact('medicines'));
}


}
