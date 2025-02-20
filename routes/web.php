<?php

use App\Http\Controllers\Pharmacy\MedicineController;
use App\Http\Controllers\Pharmacy\PharmacyGoogleController;
use App\Http\Controllers\Pharmacy\ProfileController as PharmacyProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:pharmacy')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/pharmacy/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// GoogleLoginController redirect and callback urls
Route::get('/login/google', [PharmacyGoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [PharmacyGoogleController::class, 'handleGoogleCallback']);
Route::post('/pharmacy/logout', [PharmacyGoogleController::class, 'logout'])->name('pharmacy.logout');

Route::resource('medicines',MedicineController::class)->middleware('auth:pharmacy');
Route::get('/pharmacy/profile', [PharmacyProfileController::class, 'index'])->middleware('auth:pharmacy')->name('profile.index');

// require __DIR__.'/auth.php';
