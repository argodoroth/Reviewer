<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
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
    return view('home');
});

Route::get('/home/{name}', function($name){
    return "$name's homepage!!";
});

Route::get('/other',function(){
    return "OTHER PAGE";
});

Route::redirect('/else','/other');

Route::get('/random', function(){
    return "RANDOM AKSDHJLAKDLAKSJDAKL";
});

Route::get('/games', 'App\Http\Controllers\GameController@index')->name('games.index');

//Passes data from route to gameData view
Route::any('gameData/{data}', function($data){
    return view('gameData', ['data'=>$data]);
});

//Creates a route to make a new game and is then able to post to index page
Route::post('games','App\Http\Controllers\GameController@store')->name('games.store');
Route::get('games/create', 'App\Http\Controllers\GameController@create')->name('games.create');

Route::get('games/{game}', 'App\Http\Controllers\GameController@show')->name('games.show');
Route::delete('games/{id}','App\Http\Controllers\GameController@destroy')->name('games.destroy');
