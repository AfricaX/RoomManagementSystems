<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:api')->get('/checkToken',[AuthController::class,'checktoken']);
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);

Route::prefix('/rooms')->middleware(['auth:api'])->group(function(){
    Route::get('/',[RoomController::class,'index']);
    Route::get('/{id}',[RoomController::class,'show']);
    Route::post('/',[RoomController::class,'create']);
    Route::patch('/{id}',[RoomController::class,'update']);
    Route::delete('/{id}',[RoomController::class,'destroy']);
});

Route::prefix('/bookings')->middleware(['auth:api'])->group(function(){        
    Route::get('/',[BookingController::class,'index']);
    Route::get('/{id}',[BookingController::class,'show']);
    Route::post('/',[BookingController::class,'store']);
    Route::patch('/{id}',[BookingController::class,'update']);
    Route::delete('/{id}',[BookingController::class,'destroy']);
});