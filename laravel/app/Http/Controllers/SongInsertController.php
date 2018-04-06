<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\lain;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SongInsertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index(lain $lain)
    {
        //
    }
    public function insertform(){
        return view('create_song');
     }
      
     public function insert(Request $request){
        $songTitle = $request->input('song_title');
        $artist = $request->input('artist');
        $songIMGLINK = '';
        $songLink = '';
        $tags = 0;
        $likes = 0;
        $dislikes = 0;
        $descr = $request->input('txtDescr');
        //$uploader = auth::$user->id
        $uploader = 1;
        $uploadDate = date("Y/m/d");

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

            DB::insert('INSERT INTO Song (SONG_TITLE , ARTIST, SONG_IMGL_INK, SONG_LINK, TAGS, LIKES, DISLIKES, DESCR, UPLOADER, UPLOAD_DATE) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$songTitle, $artist, $songIMGLINK, $songLink, $tags, $likes, $dislikes, $descr, $uploader, $uploadDate]);

            echo "Record inserted successfully.<br/>";
            echo '<a href = "/song_list">Click Here</a> to go back.';
        } 
        else {
            echo "Dont have song.<br/>";
            echo '<a href = "/insert">Click Here</a> to go back.';
        }
     }

}
