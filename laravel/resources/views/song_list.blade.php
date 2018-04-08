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
					<div class="card-header">
						<b>Song List</b>
					</div>
					<div class="card-body">
		 <div class="row ">
         <div>
           <div class="card">
             <div class="card-header">
               <b>Sound Of Life</b>
			  </div>
           <div class="card-body">
		  <div class="container">
		  <h3>Manage Songs</h3><br>
            
          <!-- Back to home -->		 
				<table border = 1>
				    <tr>
				        <td>Title</td>
				        <td>Artist</td>
				        <td>Desc</td>
				    </tr>
				    @foreach ($songs as $song)
				    <tr>
				        <td>{{ $song->SONG_TITLE }}</td>
				        <td>{{ $song->ARTIST}}
				        <td>{{ $song->DESCR }}</td>
				        <td><button type="button" class="btn btn-primary">Play </button></td>
				        <td><a href = '../delete/{{ $song->SONG_ID }}'>Delete</a></td>          
				        <td><a href = '../edit/{{ $song->SONG_ID }}'>Edit</a></td>
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

      
