<?php
    require_once("../entities/song.class.php");
?>
<html>
   
   <head>
      <title>View Songs Records</title>
   </head>
   
   <body>
      <table border = 1>
         <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Artist</td>
         </tr>
         @foreach ($songs as $song)
         <tr>
            <td>{{ $song->SONG_ID }}</td>
            <td>{{ $song->SONG_TITLE }}</td>
            <td>{{ $song->ARTIST}}
            <td><a href = 'delete/{{ $song->SONG_ID }}'>Delete</a></td>          
            <td><a href = 'edit/{{ $song->SONG_ID }}'>Edit</a></td>
         </tr>
         @endforeach
      </table>
   
   </body>
</html>