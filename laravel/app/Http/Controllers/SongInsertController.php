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
        $songlink = 'link';
        $tags = 0;
        $likes = 0;
        $dislikes = 0;
        $descr = $request->input('txtDescr');
        $uploader = 1;
        $uploadDate = date("Y/m/d");

            // $file = $request->file('songIMG');
            // $file->move('uploads', $file->getClientOriginalName());
            // $songIMGLINK = "uploads/".$file->getClientOriginalName();
	

        // $this->validate($request, [
        //     'mp3' => 'required|mp3|mimes:mp3|max:2048',
        // ]);

        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            // $name = time().'.'.$image->getClientOriginalExtension();
            // $destinationPath = public_path('/uploads');
            // $image->move($destinationPath, $name);
            // $songIMGLINK = "uploads/".$file->getClientOriginalName();

            // $songIMGLINK = $request->file('image')->store('public');

            $file = $request->file('image');
            $name = time().$file->getClientOriginalExtension();
            $file->move('storage', $name);
            $songIMGLINK = time().$file->getClientOriginalExtension();

            DB::insert('INSERT INTO Song (SONG_TITLE , ARTIST, SONG_IMGL_INK, SONG_LINK, TAGS, LIKES, DISLIKES, DESCR, UPLOADER, UPLOAD_DATE) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$songTitle, $artist, $songIMGLINK, $songlink, $tags, $likes, $dislikes, $descr, $uploader, $uploadDate]);
    


            echo "Record inserted successfully.<br/>";
            echo '<a href = "/song_list">Click Here</a> to go back.';
        } 
        // if($request->hasFile('song')) {

        //     $mp3File = $request->file('song');
        //     $name = time().$mp3File->getClientOriginalExtension();
        //     $mp3File->move('storage', $name);
        //     $songLink = time().$mp3File->getClientOriginalExtension();
        // } 
        else {
            echo "Dont have mp3.<br/>";
            echo '<a href = "/insert">Click Here</a> to go back.';
        }
     }

}
