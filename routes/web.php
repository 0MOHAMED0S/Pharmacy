<?php

use App\Http\Controllers\Pharmacy\MedicineController;
use App\Http\Controllers\Pharmacy\PharmacyController;
use App\Http\Controllers\Pharmacy\PharmacyGoogleController;
use App\Http\Controllers\Pharmacy\ProfileController as PharmacyProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:pharmacy')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/pharmacy/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/pharmacy/logout', [PharmacyGoogleController::class, 'logout'])->name('pharmacy.logout');
    Route::get('/pharmacy/profile', [PharmacyProfileController::class, 'index'])->name('profile.index');
    Route::resource('medicines',MedicineController::class);
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// GoogleLoginController redirect and callback urls
Route::get('/admin/login', [PharmacyGoogleController::class, 'index'])->name('admin.login');
Route::get('/login/google', [PharmacyGoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [PharmacyGoogleController::class, 'handleGoogleCallback']);
Route::get('/pharmacy/{code}', [PharmacyController::class, 'index'])->name('pharmacy.index');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
});
// require __DIR__.'/auth.php';
