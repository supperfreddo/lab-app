<?php

use App\Http\Controllers\LabResultController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Login page
Route::get('/', function () {
    if (Auth::user() != null)
        return redirect()->route('home');
    return view('login');
})->name("login");
Route::post('/login', [UserController::class, 'login'])->name("loginPost");

// Lab results
Route::get('/labresults/{code}', [LabResultController::class, 'retrieveByCodeWeb']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    // store lab results
    Route::get('/home', [LabResultController::class, 'storeLabResult'])->name("home");
    Route::post('/labresults', [LabResultController::class, 'storeWeb'])->name("storeLabResult");
});
