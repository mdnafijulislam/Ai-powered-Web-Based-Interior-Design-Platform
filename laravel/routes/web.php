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
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PayoutController as AdminPayoutController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;


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

    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');

    Route::get('/client/profile', [ClientController::class, 'profile'])->name('client.profile');
    Route::post('/client/profile/update', [ClientController::class, 'updateProfile'])->name('client.profile.update');

    Route::get('/client/bookings', [BookingController::class, 'index'])->name('client.bookings');
});

/*
|--------------------------------------------------------------------------
| Worker Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/worker/dashboard', [WorkerController::class, 'dashboard'])->name('worker.dashboard');
    Route::get('/worker/profile', [WorkerController::class, 'profile'])->name('worker.profile');
    Route::post('/worker/profile/update', [WorkerController::class, 'updateProfile'])->name('worker.profile.update');

    // Portfolio
    Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])->name('worker.portfolio');
    Route::post('/worker/portfolio/store', [WorkerController::class, 'storePortfolio'])->name('worker.portfolio.store');
    Route::get('/worker/portfolio/details/{id}', [WorkerController::class, 'portfolioDetails'])->name('worker.portfolio.details');
    Route::get('/worker/portfolio/edit/{id}', [WorkerController::class, 'editPortfolio'])->name('worker.portfolio.edit');
    Route::post('/worker/portfolio/update/{id}', [WorkerController::class, 'updatePortfolio'])->name('worker.portfolio.update');
    Route::delete('/worker/portfolio/delete/{id}', [WorkerController::class, 'deletePortfolio'])->name('worker.portfolio.delete');

    // Bookings
    Route::get('/worker/bookings', [BookingController::class, 'workerBookings'])->name('worker.bookings');
    Route::post('/worker/bookings/{id}/accept', [BookingController::class, 'accept'])->name('worker.booking.accept');
    Route::post('/worker/bookings/{id}/reject', [BookingController::class, 'reject'])->name('worker.booking.reject');

    Route::get('/worker/lifecycle', [WorkerController::class, 'lifeCycle'])->name('worker.lifecycle');
    Route::get('/worker/ratings', [WorkerController::class, 'ratings'])->name('worker.ratings');
});

/*
|--------------------------------------------------------------------------
| Public Portfolio
|--------------------------------------------------------------------------
*/
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');

/*
|--------------------------------------------------------------------------
| Booking System (Client)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

/*
|--------------------------------------------------------------------------
| CHAT SYSTEM (FINAL WORKING — STEP 1 COMPLETED)
|--------------------------------------------------------------------------
| ✔ chat.window → Chat Page UI
| ✔ chat.messages → Fetch new messages
| ✔ chat.send → Send message (MATCHES JS & CONTROLLER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Chat UI page
    Route::get('/chat/{user_id}', [ChatController::class, 'chatWindow'])
        ->name('chat.window');

    // Fetch messages (AJAX)
    Route::get('/chat/messages/{user_id}', [ChatController::class, 'fetchMessages'])
        ->name('chat.messages');

    // Send message (AJAX) — MUST MATCH JavaScript
    Route::post('/chat/{user_id}/send', [ChatController::class, 'sendMessage'])
        ->name('chat.send');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');
// ============================
// ADMIN ROUTES (AFTER LOGIN + ROLE)
// ============================
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminUserController::class,'index'])->name('users.index');
    Route::post('/users/{user}/suspend', [AdminUserController::class,'suspend'])->name('users.suspend');
    Route::delete('/users/{user}', [AdminUserController::class,'destroy'])->name('users.destroy');

    // Orders
    Route::resource('orders', AdminOrderController::class);

    // Reviews
    Route::get('/reviews', [AdminReviewController::class,'index'])->name('reviews.index');
    Route::delete('/reviews/{id}', [AdminReviewController::class,'destroy'])->name('reviews.destroy');

    // Payouts
    Route::get('/payouts', [AdminPayoutController::class,'index'])->name('payouts.index');
    Route::post('/payouts/{id}/release', [AdminPayoutController::class,'release'])->name('payouts.release');

    // Tickets
    Route::resource('tickets', AdminTicketController::class);
});

use App\Http\Controllers\AiController;

Route::get('/ai', [AiController::class, 'form'])->name('ai.form');
Route::post('/ai/generate', [AiController::class, 'generate'])->name('ai.generate');

