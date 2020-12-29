<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\ServiceContainer;
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

//can be used to hold API key for outside service etc
app()->singleton('App\ServiceContainer', function ($app) {
    return new ServiceContainer();
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/games', 'App\Http\Controllers\GameController@index')->name('games.index')->middleware('auth');

//Passes data from route to gameData view
Route::any('gameData/{data}', function($data){
    return view('gameData', ['data'=>$data])->middleware('auth');
});

//Creates a route to make a new game and is then able to post to index page
Route::post('games','App\Http\Controllers\GameController@store')->name('games.store')->middleware('auth');
Route::get('games/create', 'App\Http\Controllers\GameController@create')->name('games.create')->middleware('auth');

Route::get('games/{game}', 'App\Http\Controllers\GameController@show')->name('games.show')->middleware('auth');
Route::delete('games/{id}','App\Http\Controllers\GameController@destroy')->name('games.destroy')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');