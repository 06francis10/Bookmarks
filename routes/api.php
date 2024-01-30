<?php

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/register",function(Request $request){
    // return $request->toArray();
    try {
        //code...
        $CreateNewUser=new CreateNewUser();
        return $CreateNewUser->create($request->toArray());
    } catch (\Throwable $th) {
        //throw $th;
        return "Error: ".$th;
    }
});
