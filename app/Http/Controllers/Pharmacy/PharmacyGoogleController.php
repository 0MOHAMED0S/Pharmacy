<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class PharmacyGoogleController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver('google')->user();
        $existingUser = Pharmacy::where('google_id', $user->id)->first();

        if ($existingUser) {
            Auth::guard('pharmacy')->login($existingUser);
        } else {
            do {
                $code = Str::random(6);
            } while (Pharmacy::where('code', $code)->exists());

            $newUser = Pharmacy::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'code' => $code,
                'password' => bcrypt(Str::random(16)),
            ]);

            Auth::guard('pharmacy')->login($newUser);
        }

        return redirect()->route('medicines.create');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('pharmacy')->logout(); // Logout the user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect to homepage or login page
    }
}
