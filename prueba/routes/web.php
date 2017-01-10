<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Note;

Route::get('/', function () {
    return view('welcome');
});

Route::get('notes', function(){
	$notas = \App\Note::all();
	return view('notes',compact('notas'));
});