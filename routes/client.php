<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\UrlShortenerController;
use App\Http\Controllers\Client\UserController;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Client Routes List
Route::get('/client', function () {
    return redirect()->route('client.login');
});

Route::prefix('/client')->group(function () {
    Route::get('/login', [LoginController::class, 'showClientLoginForm'])->name('client.login');
    Route::post('/login', [LoginController::class, 'clientLogin']);
    Route::get('/register', [RegisterController::class, 'showClientRegisterForm'])->name('client.register');
    Route::post('/register', [RegisterController::class, 'clientRegister']);
    Route::post('/logout', [LoginController::class, 'clientLogout'])->name('client.logout');
});

// User Login Page Route
Route::middleware('auth:client')->group(function () {
    Route::name('client.')->group(function () {
        Route::prefix('client')->group(function () {

            //Admin Dashboard 
            Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
            Route::get('/profile', [ClientDashboardController::class, 'profile'])->name('profile');


            Route::any('/shorteners',[UrlShortenerController::class, 'index'])->name('shorteners');
            Route::prefix('shortener')->group(function () {
                Route::get('/create',[UrlShortenerController::class, 'create'])->name('shortener.create');
                Route::post('/store',[UrlShortenerController::class, 'store'])->name('shortener.store');
                Route::get('/edit',[UrlShortenerController::class, 'edit'])->name('shortener.edit');
                Route::post('/update',[UrlShortenerController::class, 'update'])->name('shortener.update');
                Route::get('/delete',[UrlShortenerController::class, 'destroy'])->name('shortener.delete');
            });

        });
    });
});