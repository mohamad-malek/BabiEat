<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register',[AuthController::class,'Register']);
Route::post('/login',[AuthController::class,'Login']);
Route::post('logout',[AuthController::class,'Logout'])->middleware("auth:sanctum");
 




Route::post('/profile',[ProfileController::class,'StoreCustomerProfile'])->middleware('auth:sanctum');