<?php
require_once("../entities/song.class.php");
?>
@extends('layouts.app')

@section('content')
<html>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header" style="background-color:#FFFFE0;">
            <b>Song List</b>
          </div>
          <div class="card-body">
            <div class="container" style="border-radius:15px;">
              <h3>Manage Songs</h3><br>

              <!-- Back to home -->
              <table class="col-md-12" border = 1>
                <tr>
                  <td style="font-size:25px">Title</td>
                  <td style="font-size:25px">Artist</td>
                  <td style="font-size:25px">Desc</td>
                </tr>
                @foreach ($songs as $song)
                <tr>
                  <td>{{ $song->SONG_TITLE }}</td>
                  <td>{{ $song->ARTIST}}</td>
                  <td>{{ $song->DESCR }}</td>
                  <td><span type="button" style="margin-left:25%;"><img style="width:30px; height:30px" src="http://i67.tinypic.com/k2oilw.png"></span></td>
                  <td><a href = '../delete/{{ $song->SONG_ID }}' style="margin-left:25%;"><img style="width:30px; height:30px" src="http://i63.tinypic.com/2qusyt4.png"></a></td>
                  <td><a href = '../edit/{{ $song->SONG_ID }}' style="margin-left:25%;"><img style="width:30px; height:30px" src="http://i64.tinypic.com/2vmzt6u.png"></a></td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
@endsection
