<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PointHistoryController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeeklyPointController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Guest Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

// Registration Routes
Route::get('register', [UserController::class, 'index'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('register.store');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('point', [PointController::class, 'index'])->name('point');
    Route::post('point', [PointController::class, 'store'])->name('point.store');
    Route::get('summary', [SummaryController::class, 'index'])->name('summary');
    Route::get('weekly_point', [WeeklyPointController::class, 'weeklySummary'])->name('weeklySummary');
    Route::post('reset-weekly-points', [WeeklyPointController::class, 'resetWeeklyPoints'])->name('resetWeeklyPoints');
    Route::get('/automate-reset', [AutomationController::class, 'resetWeeklyPoints'])->name('automate.reset');
    Route::get('/points_history', [PointHistoryController::class, 'index'])->name('points.history.index');
    Route::get('/points_history/fetch', [PointHistoryController::class, 'getPointsByDate'])->name('points.history.fetch');
    Route::get('test', [TestController::class, 'index'])->name('test');
    Route::post('/attendance/toggle', [AttendanceController::class, 'toggleClockInOut'])->name('attendance.toggle');
    Route::get('clockin', [AttendanceController::class, 'index'])->name('clockin');
    Route::post('clockin', [AttendanceController::class, 'submitReport'])->name('attendance.report');
    Route::get('clockin/status', [AttendanceController::class, 'getAttendanceStatus'])->name('attendance.status');

    // Chat Routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat'); // For viewing reports
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store'); // For posting new reports
    Route::get('/chat/poll', [ChatController::class, 'poll'])->name('chat.poll');
    Route::post('/chat/typing', [ChatController::class, 'typing'])->name('chat.typing');


    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); // For posting comments

    Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store'); // For posting replies


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
