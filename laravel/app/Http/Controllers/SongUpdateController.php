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

    // Edit song info
    public function edit(Request $request,$id) {
        $songTitle = $request->input('SONG_TITLE');
        $artist = $request->input('artist');
        $descr = $request->input('txtDescr');

        // Check image file
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $name = time().$file->getClientOriginalExtension();
            $file->move('storage/songIMG', $name);
            $songIMGLINK = time().$file->getClientOriginalExtension();

        } 
        DB::update('update song set SONG_TITLE = ?, ARTIST = ?, DESCR = ? where SONG_ID = ?',[$songTitle, $artist, $descr, $id]);
        echo "Record updated successfully.<br/>";
        echo '<a href = "/">Click Here</a> to go back.';
     }
}
