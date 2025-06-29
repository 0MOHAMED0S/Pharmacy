<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class PharmacyGoogleController extends Controller
{
    // public function index()
    // {
    //     return view('main.AdminLogin');
    // }
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // First: Try Pharmacy table
        $pharmacy = Pharmacy::where('google_id', $googleUser->id)->first();
        if ($pharmacy) {
            Auth::guard('pharmacy')->login($pharmacy);
            return redirect()->route('profile.index'); // Redirect to pharmacy dashboard
        }

        // Then: Try Users table
        $user = User::where('google_id', $googleUser->id)->first();
        if ($user) {
            Auth::login($user); // default 'web' guard
            return redirect()->route('home'); // Redirect to user dashboard
        }

        // Create new User if not found
        $newUser = User::create([
    'name' => $googleUser->name,
    'email' => $googleUser->email,
    'google_id' => $googleUser->id,
    'disease' => null,
    'password' => Hash::make(Str::random(16)), // random unguessable dummy password
]);

        Auth::login($newUser);
        return redirect()->route('home');
    }
    public function logout(Request $request): RedirectResponse
{
    if (Auth::guard('pharmacy')->check()) {
        Auth::guard('pharmacy')->logout();
    } elseif (Auth::guard('web')->check()) {
        Auth::guard('web')->logout();
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Or route('login') or route('home')
}
}



// else {
//     do {
//         $code = Str::random(6);
//     } while (Pharmacy::where('code', $code)->exists());

//     $newUser = Pharmacy::create([
//         'name' => $user->name,
//         'email' => $user->email,
//         'google_id' => $user->id,
//         'code' => $code,
//         'password' => bcrypt(Str::random(16)),
//     ]);

//     Auth::guard('pharmacy')->login($newUser);
// }
