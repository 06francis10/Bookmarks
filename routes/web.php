<?php

use App\Http\Controllers\LinkController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');
    Route::get('/dashboard',[LinkController::class,"index"])->name('dashboard');
    Route::post('/dashboard',[LinkController::class, "store"])->name("link.store");
    Route::put('/dashboard/{id}',[LinkController::class, "update"])->name("link.update");
    Route::delete("/dashboard/{id}",[LinkController::class,"destroy"])->name("link.destroy");
    Route::get("/prueba/{sortby}",function($sortby){
        return "ordenando por ".$sortby;
    })->name("Prueba");
});