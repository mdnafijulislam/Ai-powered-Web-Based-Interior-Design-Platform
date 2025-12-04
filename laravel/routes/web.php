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
| Client Routes (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])
        ->name('client.dashboard');

    Route::get('/client/profile', [ClientController::class, 'profile'])
        ->name('client.profile');

    Route::post('/client/profile/update', [ClientController::class, 'updateProfile'])
        ->name('client.profile.update');

    // Client: View own bookings
    Route::get('/client/bookings', [BookingController::class, 'index'])
        ->name('client.bookings');
});


/*
|--------------------------------------------------------------------------
| Worker Routes (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/worker/dashboard', [WorkerController::class, 'dashboard'])
        ->name('worker.dashboard');

    Route::get('/worker/profile', [WorkerController::class, 'profile'])
        ->name('worker.profile');

    Route::post('/worker/profile/update', [WorkerController::class, 'updateProfile'])
        ->name('worker.profile.update');


    /*
    |--------------------------------------------------------------------------
    | Worker Portfolio CRUD
    |--------------------------------------------------------------------------
    */
    Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])
        ->name('worker.portfolio');

    Route::post('/worker/portfolio/store', [WorkerController::class, 'storePortfolio'])
        ->name('worker.portfolio.store');

    Route::get('/worker/portfolio/details/{id}', [WorkerController::class, 'portfolioDetails'])
        ->name('worker.portfolio.details');

    Route::get('/worker/portfolio/edit/{id}', [WorkerController::class, 'editPortfolio'])
        ->name('worker.portfolio.edit');

    Route::post('/worker/portfolio/update/{id}', [WorkerController::class, 'updatePortfolio'])
        ->name('worker.portfolio.update');

    Route::delete('/worker/portfolio/delete/{id}', [WorkerController::class, 'deletePortfolio'])
        ->name('worker.portfolio.delete');


    /*
    |--------------------------------------------------------------------------
    | Worker Orders / Booking Management (IMPORTANT: add worker.orders)
    |--------------------------------------------------------------------------
    |
    | Here we add the route your dashboard expects: 'worker.orders'
    | and a show route, and also worker booking accept/reject if you use them.
    |
    */
    // Order list (for worker) — REQUIRED because blade used route('worker.orders')
    Route::get('/worker/orders', [OrderController::class, 'index'])
        ->name('worker.orders');

    // Order detail (optional)
    Route::get('/worker/orders/{order}', [OrderController::class, 'show'])
        ->name('worker.orders.show');

    // If you have messages/progress endpoints in OrderController, keep them:
    Route::post('/worker/orders/{order}/message', [OrderController::class, 'message'])
        ->name('worker.orders.message');

    Route::post('/worker/orders/{order}/progress', [OrderController::class, 'updateProgress'])
        ->name('worker.orders.progress');

    Route::post('/worker/orders/{order}/deliverables', [OrderController::class, 'uploadDeliverable'])
        ->name('worker.orders.deliverables.upload');


    /*
    |--------------------------------------------------------------------------
    | WORKER: Booking Management (optional)
    |--------------------------------------------------------------------------
    */
    Route::get('/worker/bookings', [BookingController::class, 'workerBookings'])
        ->name('worker.bookings');

    Route::post('/worker/bookings/{id}/accept', [BookingController::class, 'accept'])
        ->name('worker.booking.accept');

    Route::post('/worker/bookings/{id}/reject', [BookingController::class, 'reject'])
        ->name('worker.booking.reject');


    Route::get('/worker/lifecycle', [WorkerController::class, 'lifeCycle'])
        ->name('worker.lifecycle');

    Route::get('/worker/ratings', [WorkerController::class, 'ratings'])
        ->name('worker.ratings');
});


/*
|--------------------------------------------------------------------------
| Public Portfolio (CLIENT BROWSE)
|--------------------------------------------------------------------------
*/
// All Portfolios (public)
Route::get('/portfolio', [PortfolioController::class, 'index'])
    ->name('portfolio');

// Single Portfolio
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])
    ->name('portfolio.show');


/*
|--------------------------------------------------------------------------
| Booking System (CLIENT MUST LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Show booking form (optionally accept query params like ?worker=1&portfolio=2)
    Route::get('/booking/create', [BookingController::class, 'create'])
        ->name('booking.create');

    // Store booking
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');
});


/*
|--------------------------------------------------------------------------
| Chat + Admin Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/chat', [ChatController::class, 'index'])
    ->name('chat')->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');
