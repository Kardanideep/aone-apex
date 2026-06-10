<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserKycController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/kyc/{userId}', [UserKycController::class, 'show']);
Route::post('/kyc', [UserKycController::class, 'store']);

Route::get('/packages', [\App\Http\Controllers\Api\PackageController::class, 'index']);
Route::get('/packages/{id}', [\App\Http\Controllers\Api\PackageController::class, 'show']);
