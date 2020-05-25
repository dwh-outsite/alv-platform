<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\PollController as AdminPollController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\StreamOutputController;
use App\Http\Middleware\CheckIfEventStarted;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Participant routes
 */
Route::view('/login', 'login')->name('login');

Route::post('/login', LoginController::class)->name('login-post');

Route::middleware('auth')->group(function () {
    Route::redirect('/', 'live');
    Route::get('/live', LiveController::class)
        ->name('live')
        ->middleware(CheckIfEventStarted::class);
    Route::view('/starting-soon', 'starting_soon')
        ->name('starting_soon')
        ->middleware(CheckIfEventStarted::class);;
    Route::post('/questions', [QuestionsController::class, 'store']);
});

Route::post('/polls/vote/{pollOption}', [PollController::class, 'store'])
    ->middleware('auth:participants,admin');

/**
 * Admin routes
 */
Route::get('/admin/login', function () {
    auth()->logout();
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login-post');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index']);
    Route::post('/polls', [AdminPollController::class, 'store']);
    Route::put('/polls/{poll}', [AdminPollController::class, 'update']);
});

/**
 * Output routes
 */
Route::view('/output', 'output');

Route::middleware('auth:admin')->group(function () {
    Route::post('/output/poll/{poll}', [StreamOutputController::class, 'showPoll']);
    Route::post('/output/question/{question}', [StreamOutputController::class, 'showQuestion']);
    Route::post('/output/lowerthird', [StreamOutputController::class, 'showLowerThird']);
    Route::post('/output/hide', [StreamOutputController::class, 'hideAll']);
});
