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
    return view('welcome');
});

Route::put('/user-update', 'UserController@update')->name('user.update');
Route::patch('user-update-password', 'UserController@updatePassword')->name('user.update-password');
Route::patch('/user-update-document', 'UserController@updateDocument')->name('user.update-document');
Route::patch('/user-update-photo', 'UserController@updatePhoto')->name('user.update-photo');
Route::delete('/user-delete', 'UserController@destroy')->name('user.delete');

Route::post('/create-user', 'UserController@create')->name('user.create');

Route::get('/lista-capacitadores', 'HomeController@lista_capacitantes')->name('capacitantes');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
