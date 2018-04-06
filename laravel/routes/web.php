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

// Second Route method – Root URL with ID will match this method
Route::get('ID/{id}',function($id){
     echo 'ID: '.$id;
 });

// Third Route method – Root URL with or without name will match this method
 Route::get('/user/{name?}',function($name = 'Virat Gandhi'){
    echo "Name: ".$name;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'SongListController@index');


Route::get('/music', function(){
    return view('music');
 });


Route::get('/info/{name?}','Info@UserInfo')->name('info');
Route::get('/info','info@UserList')->name('list')

// View songs
Route::get('song_list','SongListController@manageSongs');

// Insert song
Route::get('insert','SongInsertController@insertform');
Route::post('create','SongInsertController@insert');

//Update song
Route::get('edit-song','SongListController@index');
Route::get('edit/{id}','SongUpdateController@show');
Route::post('edit/{id}','SongUpdateController@edit');

//Delete song
Route::get('delete/{id}','SongListController@destroy');
