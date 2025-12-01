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

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Register Page
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Login Page
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::get('/client/dashboard', [ClientController::class, 'dashboard'])
    ->name('client.dashboard')
    ->middleware('auth');
// Client Profile Page
Route::get('/client/profile', [ClientController::class, 'profile'])
    ->name('client.profile')
    ->middleware('auth');

// Client Profile Update
Route::post('/client/profile/update', [ClientController::class, 'updateProfile'])
    ->name('client.profile.update')
    ->middleware('auth');



/*
|--------------------------------------------------------------------------
| Worker Routes
|--------------------------------------------------------------------------
*/

Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])
    ->name('worker.portfolio')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| Portfolio Routes
|--------------------------------------------------------------------------
*/

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');


/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/

Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| Chat Routes
|--------------------------------------------------------------------------
*/

Route::get('/chat', [ChatController::class, 'index'])
    ->name('chat')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');

// Profile Page
Route::get('/profile', [ClientController::class, 'profile'])->name('client.profile')->middleware('auth');

// Profile Update
Route::post('/profile/update', [ClientController::class, 'updateProfile'])->name('client.profile.update')->middleware('auth');
// Worker Dashboard
Route::get('/worker/dashboard', [WorkerController::class, 'dashboard'])
    ->name('worker.dashboard')->middleware('auth');

// Worker Profile
Route::get('/worker/profile', [WorkerController::class, 'profile'])
    ->name('worker.profile')->middleware('auth');

Route::post('/worker/profile/update', [WorkerController::class, 'updateProfile'])
    ->name('worker.profile.update');

// Worker Portfolio
Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])
    ->name('worker.portfolio')->middleware('auth');

Route::get('/worker/lifecycle', [WorkerController::class, 'lifeCycle'])
    ->name('worker.lifecycle')
    ->middleware('auth');
// Worker Portfolio page
Route::get('/worker/portfolio', [App\Http\Controllers\WorkerController::class, 'portfolio'])
    ->name('worker.portfolio')
    ->middleware('auth');
    Route::get('/worker/orders', [WorkerController::class, 'orders'])
     ->name('worker.orders')
     ->middleware('auth');

     use App\Http\Controllers\OrderController;

Route::middleware(['auth'])->group(function () {

    Route::get('/worker/orders', [OrderController::class, 'index'])->name('worker.orders');
    Route::get('/worker/orders/{order}', [OrderController::class, 'show'])->name('worker.orders.show');

    Route::post('/worker/orders/{order}/message', [OrderController::class, 'message'])->name('worker.orders.message');

    Route::post('/worker/orders/{order}/progress', [OrderController::class, 'updateProgress'])->name('worker.orders.progress');
    Route::post('/worker/orders/{order}/deliverables', [OrderController::class, 'uploadDeliverable'])->name('worker.orders.deliverables.upload');
});


