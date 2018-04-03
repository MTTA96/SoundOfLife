<?php

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

Route::get('/music', function(){
    return view('music');
 });

// View songs
Route::get('song_list','SongListController@index');

// Insert song
Route::get('insert','SongInsertController@insertform');
Route::post('create','SongInsertController@insert');

//Update song
Route::get('edit-song','SongListController@index');
Route::get('edit/{id}','SongUpdateController@show');
Route::post('edit/{id}','SongUpdateController@edit');

//Delete song
Route::get('delete/{id}','SongListController@destroy');