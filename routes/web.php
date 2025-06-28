<?php

use App\Http\Controllers\Pharmacy\MedicineController;
use App\Http\Controllers\Pharmacy\PharmacyController;
use App\Http\Controllers\Pharmacy\PharmacyGoogleController;
use App\Http\Controllers\Pharmacy\ProfileController as PharmacyProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Http\Controllers\MedicineOrderController;
use App\Http\Controllers\Pharmacy\AdviceController;
use App\Http\Controllers\Pharmacy\ChatController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:pharmacy')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/pharmacy/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pharmacy/profile', [PharmacyProfileController::class, 'index'])->name('profile.index');
    Route::resource('medicines', MedicineController::class);
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth.any'])->group(function () {
    Route::post('/pharmacy/logout', [PharmacyGoogleController::class, 'logout'])->name('pharmacy.logout');
    //Chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
//Pharmacy
Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
Route::post('/order-medicine', [MedicineOrderController::class, 'orderMedicine']);
});

// Route::get('/pharmacy/{code}', [PharmacyController::class, 'index'])->name('pharmacy1.index');

Route::middleware('guest')->group(function () {
    Route::get('/login/google', [PharmacyGoogleController::class, 'redirectToGoogle'])->name('login');
    Route::get('/login/google/callback', [PharmacyGoogleController::class, 'handleGoogleCallback']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('auth.login');
});


Route::middleware('auth')->group(function () {
//profile
Route::get('/profile', [PharmacyProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update-disease', [PharmacyProfileController::class, 'updateDisease'])->name('profile.update.disease');
});

Route::middleware(['auth'])->get('/daily-advice', [AdviceController::class, 'showDailyAdvice'])->name('advice.daily');

Route::post('/medicine/search', [MedicineController::class, 'search']);
Route::get('/scan', [MedicineController::class, 'scan'])->name('scan');
