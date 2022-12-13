<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RightController;
use App\Http\Controllers\ChessController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/chess', [ChessController::class, 'index'])->name('chess');
    Route::get('/chess/update', [ChessController::class, 'update'])->name('chess.update');
    Route::post('/chess/store', [ChessController::class, 'store'])->name('chess.store');
    Route::delete('/chess/{chess}', [ChessController::class, 'delete'])->name('chess.destroy');

    Route::post('/groups/ajax', [GroupController::class, 'ajax'])->name('ajax');

    Route::resource('matches', MatchController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('users', UserController::class);
    Route::resource('rights', RightController::class)->except(['show']);
});
