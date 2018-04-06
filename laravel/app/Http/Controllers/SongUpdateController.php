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
        $songTitle = $request->input('song_title');
        $artist = $request->input('artist');
        $songIMGLINK = '';
        $songLink = '';
        // $tags = 0;
        // $likes = 0;
        // $dislikes = 0;
        $descr = $request->input('txtDescr');

        // Check image file
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $name = time().$file->getClientOriginalExtension();
            $file->move('storage/songIMG', $name);
            $songIMGLINK = time().$file->getClientOriginalExtension();

        } 

        // Check song 
        if($request->hasFile('song')) {

            $mp3File = $request->file('song');
            $name = time().$mp3File->getClientOriginalExtension();
            $mp3File->move('storage/mp3', $name);
            $songLink = $name;

            // DB::insert('INSERT INTO Song (SONG_TITLE , ARTIST, SONG_IMGL_INK, SONG_LINK, TAGS, LIKES, DISLIKES, DESCR, UPLOADER, UPLOAD_DATE) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            // [$songTitle, $artist, $songIMGLINK, $songLink, $tags, $likes, $dislikes, $descr, $uploader, $uploadDate]);

            DB::update('update song set SONG_TITLE = ? where SONG_ID = ?',[$songTitle,$id]);
            echo "Record updated successfully.<br/>";
            echo '<a href = "/song_list">Click Here</a> to go back.';
        } 
        else {
            echo "Dont have song.<br/>";
            echo '<a href = "/insert">Click Here</a> to go back.';
        }
     }
}
