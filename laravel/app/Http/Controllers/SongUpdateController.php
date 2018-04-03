<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\lain;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SongUpdateController extends Controller
{
    public function index(){
        $songs = DB::select('select * from song');
        return view('song_list',['songs'=>$songs]);
     }
     public function show($id) {
        $songs = DB::select('select * from song where SONG_ID = ?',[$id]);
        return view('song_update',['songs'=>$songs]);
     }
     public function edit(Request $request,$id) {
        $title = $request->input('SONG_TITLE');
        DB::update('update song set SONG_TITLE = ? where SONG_ID = ?',[$title,$id]);
        echo "Record updated successfully.<br/>";
        echo '<a href = "/song_list">Click Here</a> to go back.';
     }
}
