<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompetitionController;
use Illuminate\Support\Facades\Route;

route::get('/', function () {
    return view('dashboard');
});

// Login & Register
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Dashboard Admin (hanya untuk admin yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('events', EventController::class);
    Route::resource('competitions', CompetitionController::class);
});

Route::resource('events', EventController::class);