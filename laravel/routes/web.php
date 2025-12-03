<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Home Page
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])
        ->name('client.dashboard');

    Route::get('/client/profile', [ClientController::class, 'profile'])
        ->name('client.profile');

    Route::post('/client/profile/update', [ClientController::class, 'updateProfile'])
        ->name('client.profile.update');
});


/*
|--------------------------------------------------------------------------
| Worker Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/worker/dashboard', [WorkerController::class, 'dashboard'])
        ->name('worker.dashboard');

    // Profile
    Route::get('/worker/profile', [WorkerController::class, 'profile'])
        ->name('worker.profile');

    Route::post('/worker/profile/update', [WorkerController::class, 'updateProfile'])
        ->name('worker.profile.update');

    // Portfolio List Page
    Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])
        ->name('worker.portfolio');

    // ⭐ Step–4: Portfolio Upload Route (NEW)
    Route::post('/worker/portfolio/store', [WorkerController::class, 'storePortfolio'])
        ->name('worker.portfolio.store');

    // Portfolio Details Page
    Route::get('/worker/portfolio/details/{id}', [WorkerController::class, 'portfolioDetails'])
        ->name('worker.portfolio.details');

    // Life Cycle
    Route::get('/worker/lifecycle', [WorkerController::class, 'lifeCycle'])
        ->name('worker.lifecycle');

    // Ratings Page
    Route::get('/worker/ratings', [WorkerController::class, 'ratings'])
        ->name('worker.ratings');
});


/*
|--------------------------------------------------------------------------
| Worker Orders (Advanced Order System)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/worker/orders', [OrderController::class, 'index'])
        ->name('worker.orders');

    Route::get('/worker/orders/{order}', [OrderController::class, 'show'])
        ->name('worker.orders.show');

    Route::post('/worker/orders/{order}/message', [OrderController::class, 'message'])
        ->name('worker.orders.message');

    Route::post('/worker/orders/{order}/progress', [OrderController::class, 'updateProgress'])
        ->name('worker.orders.progress');

    Route::post('/worker/orders/{order}/deliverables', [OrderController::class, 'uploadDeliverable'])
        ->name('worker.orders.deliverables.upload');
});


/*
|--------------------------------------------------------------------------
| Other Routes
|--------------------------------------------------------------------------
*/
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking')->middleware('auth');

Route::get('/chat', [ChatController::class, 'index'])
    ->name('chat')->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');
