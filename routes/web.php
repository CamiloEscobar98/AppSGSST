<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $topics = \App\Models\Topic::all();
    return view('welcome', ['topics' => $topics]);
});

Route::post('/user-create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::put('/user-update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::patch('user-update-password', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.update-password');
Route::patch('/user-update-document', [\App\Http\Controllers\UserController::class, 'updateDocument'])->name('user.update-document');
Route::patch('/user-update-photo', [\App\Http\Controllers\UserController::class, 'updatePhoto'])->name('user.update-photo');
Route::delete('/user-delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
Route::get('/perfil/{usuario}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::post('/user-add-role', [\App\Http\Controllers\UserController::class, 'addRole'])->name('user.addRole');
Route::delete('/user-delete-role', [\App\Http\Controllers\UserController::class, 'deleteRole'])->name('user.deleteRole');
Route::get('/mis-tematicas', [\App\Http\Controllers\UserController::class, 'myTopics'])->name('user.my-topics');
Route::get('/tematicas', [\App\Http\Controllers\UserController::class, 'topics'])->name('user.topics');
Route::post('/add-topic', [\App\Http\Controllers\UserController::class,'addTopic'])->name('user.addtopic');
Route::post('/massive-users', [\App\Http\Controllers\UserController::class, 'userImport'])->name('user.massive');

Route::post('/topic-create', [\App\Http\Controllers\TopicController::class, 'create'])->name('topic.create');
Route::delete('/topic-delete', [\App\Http\Controllers\TopicController::class, 'destroy'])->name('topic.delete');
Route::get('/tematica/{topic}', [\App\Http\Controllers\TopicController::class, 'show'])->name('topic.show');
Route::put('/topic-update', [\App\Http\Controllers\TopicController::class, 'update'])->name('topic.update');
Route::patch('/topic-update-capacitante', [\App\Http\Controllers\TopicController::class, 'update_capacitante'])->name('topic.update-capacitante');
Route::patch('/topic-update-photo', [\App\Http\Controllers\TopicController::class, 'updatePhoto'])->name('topic.update-photo');

Route::post('/capsule-create', [\App\Http\Controllers\CapsuleController::class, 'create'])->name('capsule.create');
Route::get('/capsula/{capsule}', [\App\Http\Controllers\CapsuleController::class, 'show'])->name('capsule.show');
Route::put('/capsule-update', [\App\Http\Controllers\CapsuleController::class, 'update'])->name('capsule.update');
Route::patch('/capsule-update-topic', [\App\Http\Controllers\CapsuleController::class, 'changeTopic'])->name('capsule.changeTopic');
Route::delete('/capsule-delete', [\App\Http\Controllers\CapsuleController::class, 'destroy'])->name('capsule.delete');

Route::post('/game-create', [\App\Http\Controllers\GamesController::class, 'create'])->name('game.create');
Route::get('/juego/{game}', [\App\Http\Controllers\GamesController::class, 'show'])->name('game.show');
Route::put('/game-update', [\App\Http\Controllers\GamesController::class, 'update'])->name('game.update');
Route::delete('/game-delete', [\App\Http\Controllers\GamesController::class, 'destroy'])->name('game.delete');

Route::post('/word-create', [\App\Http\Controllers\WordController::class, 'create'])->name('word.create');
Route::delete('/word-delete', [\App\Http\Controllers\WordController::class, 'destroy'])->name('word.delete');

Route::get('/lista-capacitantes', [\App\Http\Controllers\HomeController::class, 'lista_capacitantes'])->name('capacitantes');
Route::get('/lista-capacitadores', [\App\Http\Controllers\HomeController::class, 'lista_capacitadores'])->name('capacitadores');
Route::get('/lista-temáticas', [\App\Http\Controllers\HomeController::class, 'lista_tematicas'])->name('tematicas');
Route::get('/lista-capsulas', [\App\Http\Controllers\HomeController::class, 'lista_capsulas'])->name('capsulas');
Auth::routes();

Route::get('/home', [\App\http\Controllers\HomeController::class, 'index'])->name('home');
