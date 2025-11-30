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
    ->middleware('auth')
    ->name('worker.dashboard');
// Worker Dashboard
Route::get('/worker/dashboard', [WorkerController::class, 'dashboard'])
    ->name('worker.dashboard')->middleware('auth');

// Worker Portfolio Page
Route::get('/worker/portfolio', [WorkerController::class, 'portfolio'])
    ->name('worker.portfolio')
    ->middleware('auth');

