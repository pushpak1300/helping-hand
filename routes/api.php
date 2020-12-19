<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ReceiverAPIController;
use App\Http\Controllers\ReceiverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/recievers/{id}', [ReceiverAPIController::class, 'show']);
    Route::post('/recievers/{id}', [ReceiverAPIController::class, 'add']);
});


Route::post('/register', [RegisterController::class,'register']);
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Route::resource('receivers', App\Http\Controllers\Api\ReceiverAPIController::class);

Route::resource('merchants', App\Http\Controllers\Api\MerchantAPIController::class);

Route::resource('transactions', App\Http\Controllers\Api\TransactionAPIController::class);