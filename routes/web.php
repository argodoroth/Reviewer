<?php

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

Route::get('/home/{name}', function($name){
    return "$name's homepage!!";
});

Route::get('/other',function(){
    return "this is a page of other stuff";
});

Route::redirect('/else','/other');

Route::get('/random', function(){
    return "RANDOM AKSDHJLAKDLAKSJDAKL";
});