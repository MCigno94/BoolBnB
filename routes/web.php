<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')
->prefix('user')
->namespace('User')
->name('user.')
->group(function ()
{
    Route::resource('/apartments','UserApartmentController');
});

Route::get('/home', 'HomeController@index')->name('home');