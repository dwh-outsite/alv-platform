<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\QuestionsController as AdminQuestionsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\QuestionsController;
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

Route::view('/login', 'login')->name('login');

Route::post('/login', LoginController::class)->name('login-post');

Route::middleware('auth')->group(function () {
    Route::view('/', 'live');
    Route::view('/live', 'live')->name('live'); // TODO: Test auth requirement
    Route::post('/questions', [QuestionsController::class, 'store']);
    Route::post('/polls/vote/{pollOption}', [PollController::class, 'store']);
});


Route::get('/admin/login', function () {
    auth()->logout();
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login-post');

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index']);
});
