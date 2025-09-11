<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\DriverProfileController;
use App\Http\Controllers\OwnerProfileController;
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
        


Route::middleware('auth:sanctum')->group(function()
{   

Route::prefix('/profile')->group(function(){

        Route::post('/customer',[CustomerProfileController::class,'StoreCustomerProfile']);
        Route::put('/customer/{id}',[CustomerProfileController::class,'UpdateCustomerProfile']);
        Route::post('/owner',[OwnerProfileController::class,'StoreOwnerProfile']);
        Route::put('/owner/{id}',[DriverProfileController::class,'UpdateOwnerProfile']);
        Route::post('/driver',[DriverProfileController::class,'StoreDriverProfile']);
        Route::put('/driver/{id}',[OwnerProfileController::class,'UpdateDriverProfile']);
        
        
}); 
});

