<?php

use App\Http\Controllers\LabResultController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Token authentication
Route::post('/tokens', [UserController::class, 'createToken']);

// Lab results
Route::get('/labresults/{code}', [LabResultController::class, 'retrieveByCodeApi']);

// Authenticated routes
Route::middleware('apitoken')->group(function () {
    // Token authentication
    Route::get('/logout', [UserController::class, 'deleteToken']);

    // Lab results
    Route::get('/labresults', [LabResultController::class, 'retrieve']);
    Route::post('/labresults', [LabResultController::class, 'storeApi']);
});

// TODO add postman collection to repo
