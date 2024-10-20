<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('login/google', [LoginController::class, 'redirectToGoogle']);
    Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);
    Route::get('login/facebook', [LoginController::class, 'redirectToFacebook']);
    Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
