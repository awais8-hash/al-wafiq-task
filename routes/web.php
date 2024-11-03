<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PerformanceController;

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/googleLogin',[GoogleController::class,'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/signOut',[GoogleController::class,'signOut']);
Route::middleware('auth')->group(function () {
    Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');
    Route::post('/performance/test', [PerformanceController::class, 'testPerformance']);
});

