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
Route::post('/add-topic', [\App\Http\Controllers\UserController::class, 'addTopic'])->name('user.addtopic');
Route::post('/massive-users', [\App\Http\Controllers\UserController::class, 'userImport'])->name('user.massive');

Route::post('/topic-create', 'TopicController@create')->name('topic.create');
Route::delete('/topic-delete', 'TopicController@destroy')->name('topic.delete');
Route::get('/tematica/{topic}', 'TopicController@show')->name('topic.show');
Route::put('/topic-update', 'TopicController@update')->name('topic.update');
Route::patch('/topic-update-capacitante', 'TopicController@update_capacitante')->name('topic.update-capacitante');
Route::patch('/topic-update-photo', 'TopicController@updatePhoto')->name('topic.update-photo');

Route::post('/capsule-create', 'CapsuleController@create')->name('capsule.create');
Route::get('/capsula/{capsule}', 'CapsuleController@show')->name('capsule.show');
Route::put('/capsule-update', 'CapsuleController@update')->name('capsule.update');
Route::patch('/capsule-update-topic', 'CapsuleController@changeTopic')->name('capsule.changeTopic');
Route::delete('/capsule-delete', 'CapsuleController@destroy')->name('capsule.delete');

Route::post('/game-create', 'GamesController@create')->name('game.create');
Route::get('/juego/{game}', 'GamesController@show')->name('game.show');
Route::put('/game-update', 'GamesController@update')->name('game.update');
Route::delete('/game-delete', 'GamesController@destroy')->name('game.delete');

Route::post('/word-create', 'WordController@create')->name('word.create');
Route::delete('/word-delete', 'WordController@destroy')->name('word.delete');

Route::get('/lista-capacitantes', 'HomeController@lista_capacitantes')->name('capacitantes');
Route::get('/lista-capacitadores', 'HomeController@lista_capacitadores')->name('capacitadores');
Route::get('/lista-temáticas', 'HomeController@lista_tematicas')->name('tematicas');
Route::get('/lista-capsulas', 'HomeController@lista_capsulas')->name('capsulas');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
