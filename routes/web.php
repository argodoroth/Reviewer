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
    return redirect(route('games.index'));
});

Route::get('/home', function () {
    return redirect(route('games.index'));
});
Route::get('/image-upload', 'App\Http\Controllers\ImageController@index')->name('images.upload')->middleware('auth');
Route::post('/image-upload', 'App\Http\Controllers\ImageController@store')->name('images.store')->middleware('auth');

//list all games
Route::get('/games', 'App\Http\Controllers\GameController@index')->name('games.index')->middleware('auth');

//Creates a route to make a new game and is then able to post to index page
Route::post('games','App\Http\Controllers\GameController@store')->name('games.store')->middleware('auth');
Route::get('games/create', 'App\Http\Controllers\GameController@create')->name('games.create')->middleware('auth');

//Route to edit games
Route::get('games/edit/{game}', 'App\Http\Controllers\GameController@edit')->name('games.edit')->middleware('auth');
Route::post('games/{game}', 'App\Http\Controllers\GameController@update')->name('games.update')->middleware('auth');

//Show games and delete them
Route::get('games/{game}', 'App\Http\Controllers\GameController@show')->name('games.show')->middleware('auth');
Route::delete('games/{id}','App\Http\Controllers\GameController@destroy')->name('games.destroy')->middleware('auth');

Route::post('user-gamertag', 'App\Http\Controllers\UserController@gamertag')->name('users.gamertag')->middleware('auth');
Route::post('user-creator', 'App\Http\Controllers\UserController@setCreator')->name('users.creator')->middleware('auth');
Route::get('users/{user}', 'App\Http\Controllers\UserController@show')->name('users.show')->middleware('auth');

Route::post('users/{user}', 'App\Http\Controllers\ImageController@storeUser')->name('images.store.user')->middleware('auth');
Route::post('games/{game}', 'App\Http\Controllers\ImageController@storeGame')->name('images.store.game')->middleware('auth');


Auth::routes();
