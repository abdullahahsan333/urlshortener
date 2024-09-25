<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController;

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
        });
    });
});