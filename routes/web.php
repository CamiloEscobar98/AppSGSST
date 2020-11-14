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

Route::put('/update-user', 'UserController@update')->name('user.update');
Route::patch('update-user-password', 'UserController@updatePassword')->name('user.update-password');
Route::patch('/update-user-document', 'UserController@updateDocument')->name('user.update-document');

Route::post('/create-user', 'UserController@create')->name('user.create');

Route::get('/lista-capacitadores', 'HomeController@lista_capacitantes')->name('capacitantes');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
