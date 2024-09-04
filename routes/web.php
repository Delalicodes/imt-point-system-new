<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PointHistoryController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeeklyPointController;
use App\Http\Controllers\WeeklyPointHistoryController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    // Authentication routes
    Route::get('auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

    // Registration routes
    Route::get('auth', [UserController::class, 'index'])->name('index');
    Route::post('auth/auth', [UserController::class, 'store'])->name('user.store');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Points
    Route::get('point', [PointController::class, 'index'])->name('point');
    Route::post('point', [PointController::class, 'store'])->name('point.store');

    // Summary
    Route::get('summary', [SummaryController::class, 'index'])->name('summary');
    Route::get('weekly_point', [WeeklyPointController::class, 'weeklySummary'])->name('weeklySummary');

    // Reset Weekly Points (ensure this is protected)
    Route::post('reset-weekly-points', [WeeklyPointController::class, 'resetWeeklyPoints'])->name('resetWeeklyPoints');
    Route::get('/automate-reset', [AutomationController::class, 'resetWeeklyPoints'])->name('automate.reset');

    Route::get('/points_history', [PointHistoryController::class, 'index'])->name('points.history.index');
    Route::get('/points_history/fetch', [PointHistoryController::class, 'getPointsByDate'])->name('points.history.fetch');

    // Define the route for daily history with a unique name



    // Messages
    // Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
