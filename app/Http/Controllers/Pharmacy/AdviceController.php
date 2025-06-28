<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdviceController extends Controller
{

public function showDailyAdvice()
{
    $user = auth()->user();

    // If user has no disease, fallback
    $disease = $user->disease ?? 'none';

    $shouldUpdate = !$user->daily_advice || !$user->advice_updated_at || Carbon::parse($user->advice_updated_at)->addDay()->isPast();

    if ($shouldUpdate) {
        $advice = DB::table('disease_advice')
            ->where('disease', $disease)
            ->inRandomOrder()
            ->value('advice');

        $user->daily_advice = $advice;
        $user->advice_updated_at = now();
        $user->save();
    }

    return view('pages.advice', ['advice' => $user->daily_advice]);
}

}
