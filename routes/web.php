<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
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

Route::view('/', 'login')->name('login');

Route::post('/', LoginController::class)->name('login-post');

Route::middleware('auth')->group(function () {
    Route::view('/live', 'live')->name('live'); // TODO: Test auth requirement
    Route::post('/questions', [QuestionController::class, 'store']);
});
