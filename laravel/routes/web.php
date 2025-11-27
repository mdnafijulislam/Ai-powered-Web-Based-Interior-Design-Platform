<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home (primary)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Client
Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');

// Worker
Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])->name('worker.portfolio');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

// Booking
Route::get('/booking', [BookingController::class, 'index'])->name('booking');

// Chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat');

// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Register Page
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Register Form Submit
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
