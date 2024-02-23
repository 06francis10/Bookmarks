<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->currentAccessToken();
});
Route::middleware('auth:sanctum')->resource('/link', ApiLinkController::class);

// Route::post("/register",[ApiAuthController::class,"register"]);
// Route::post("/login",[ApiAuthController::class,"login"]);