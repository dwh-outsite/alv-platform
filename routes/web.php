<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\PollController as AdminPollController;
use App\Http\Controllers\Admin\GraphicsController as AdminGraphicsController;
use App\Http\Controllers\Admin\QuestionsController as AdminQuestionsController;
use App\Http\Controllers\Admin\ParticipantController as AdminParticipantController;
use App\Http\Controllers\Admin\FirewallController as AdminFirewallController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::view('/register', 'register')->name('register');
Route::post('/register', RegisterController::class)->name('register-post');

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
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.interactive');
    Route::get('/admin/interactive', [AdminDashboardController::class, 'index'])->name('admin.interactive');
    Route::get('/admin/graphics', [AdminGraphicsController::class, 'index'])->name('admin.graphics');
    Route::get('/admin/participant/{participant}', AdminParticipantController::class)->name('admin.participant');
    Route::post('/admin/polls', [AdminPollController::class, 'store']);
    Route::put('/admin/polls/{poll}', [AdminPollController::class, 'update']);
    Route::post('/admin/questions', [AdminQuestionsController::class, 'store']);
    Route::post('/admin/firewall', AdminFirewallController::class)->name('admin.firewall');

    Route::get('/admin/tokens/create', function () {
        $token = request()->user()->createToken(request()->input('name'));

        return ['token' => $token->plainTextToken];
    });
});

/**
 * Output routes
 */
Route::view('/output', 'output');

Route::middleware('auth:admin,sanctum')->group(function () {
    Route::post('/output/poll/{poll}', [StreamOutputController::class, 'showPoll']);
    Route::post('/output/poll-question/{poll}', [StreamOutputController::class, 'showPollQuestion']);
    Route::post('/output/question/{question}', [StreamOutputController::class, 'showQuestion']);
    Route::post('/output/message', [StreamOutputController::class, 'showMessage']);
    Route::post('/output/lowerthird', [StreamOutputController::class, 'showLowerThird']);
    Route::post('/output/upperthird', [StreamOutputController::class, 'showUpperThird']);
    Route::post('/output/agenda', [StreamOutputController::class, 'showAgenda']);
    Route::post('/output/vote-countdown-show', [StreamOutputController::class, 'showVoteCountdown']);
    Route::post('/output/vote-countdown-hide', [StreamOutputController::class, 'hideVoteCountdown']);
    Route::post('/output/countdown', [StreamOutputController::class, 'showCountdown']);
    Route::post('/output/hide', [StreamOutputController::class, 'hideAll']);
});
