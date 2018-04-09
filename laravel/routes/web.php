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

//Account info (DONE)
Route::get('/info/{id}','Info@UserInfo')->name('info');
Route::post('/info','Info@UpdateAvatar');

//Account edit (DONE -- ERRORS NOT SHOWING)
Route::get('/infoedit/{id}','Info@UserEdit')->name('infoedit');
Route::post('/infoedit/{id}','Info@Update');

//Change password (BUSTED)
Route::get('/changepass/{id}','Info@ChangePass')->name('changepass');
Route::post('/changepass/{id}','Info@PassChange');

//User list (NOT DONE)
Route::get('/info','info@UserList')->name('list');

// View songs
Route::get('song_list/{id}','SongListController@manageSongs')->name('songlist');

// Insert song
Route::get('insert','SongInsertController@insertform')->name('insert');
Route::post('create/{id}','SongInsertController@insert');

//Update song
Route::get('edit-song','SongListController@index');
Route::get('edit/{id}','SongUpdateController@show');
Route::post('edit/{id}','SongUpdateController@edit');

//Delete song
Route::get('delete/{id}','SongListController@destroy');
