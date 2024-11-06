<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/password/reset', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/update', action: [AuthController::class, 'updatePassword'])->name('password.update');

Route::resource('books', BookController::class);
Route::resource('sales', SaleController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/add-book', [DashboardController::class, 'addBook'])->name('addBook');
    Route::post('/add-sale', [DashboardController::class, 'addSale'])->name('addSale');
    Route::post('/add-category', [DashboardController::class, 'addCategory'])->name('addCategory');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
});
