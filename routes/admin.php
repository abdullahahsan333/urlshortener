<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UrlShortenerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Routes List
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::prefix('/admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'adminLogin']);
    Route::get('/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'adminRegister']);
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');
});

// Admin Login Page Route
Route::middleware('auth:admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {

            //Admin Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
            Route::get('/profile-update', [DashboardController::class, 'update'])->name('profile-update');

            Route::any('/shorteners',[UrlShortenerController::class, 'index'])->name('shorteners');
            Route::prefix('shortener')->group(function () {
                Route::get('/create',[UrlShortenerController::class, 'create'])->name('shortener.create');
                Route::post('/store',[UrlShortenerController::class, 'store'])->name('shortener.store');
                Route::get('/delete/{id}',[UrlShortenerController::class, 'destroy'])->name('shortener.delete');
            });

            Route::any('/users',[UserController::class, 'index'])->name('users');
            Route::prefix('user')->group(function () {
                Route::get('/create',[UserController::class, 'create'])->name('user.create');
                Route::post('/store',[UserController::class, 'store'])->name('user.store');
                Route::get('/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
                Route::post('/update',[UserController::class, 'update'])->name('user.update');
                Route::get('/delete/{id}',[UserController::class, 'destroy'])->name('user.delete');
            });
            
            Route::any('/clients',[ClientController::class, 'index'])->name('clients');
            Route::prefix('client')->group(function () {
                Route::get('/create',[ClientController::class, 'create'])->name('client.create');
                Route::post('/store',[ClientController::class, 'store'])->name('client.store');
                Route::get('/edit/{id}',[ClientController::class, 'edit'])->name('client.edit');
                Route::post('/update',[ClientController::class, 'update'])->name('client.update');
                Route::get('/delete/{id}',[ClientController::class, 'destroy'])->name('client.delete');
            });

        });
    });
});