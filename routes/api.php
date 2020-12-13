<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('game/hangman/', [\App\Http\Controllers\GamesController::class, 'getHangman'])->name('game.hangman');
Route::post('game/hangman/win/', [\App\Http\Controllers\GamesController::class, 'winHangman'])->name('game.winhangman');
Route::post('game/wordfind/win/', [\App\Http\Controllers\GamesController::class, 'winWordFind'])->name('game.windwordfind');
Route::post('game/wordfind/', [\App\Http\Controllers\GamesController::class, 'getWordFind'])->name('game.wordfind');
