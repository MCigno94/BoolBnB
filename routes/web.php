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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::middleware('auth')
->prefix('user')
->namespace('User')
->name('user.')
->group(function ()
{
    Route::resource('/apartments','UserApartmentController');
});

Route::get('/', 'HomeController@index')->name('home');


/* DEVE SEMPRE ESSERE L'ULTIMA */
Route::get("{any?}", function ()
{
    return view('auth.login');
})->where('any','.*');