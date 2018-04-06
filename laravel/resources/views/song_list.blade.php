<?php
    require_once("../entities/song.class.php");
?>
<html>
   
   <head>
      <title>View Songs Records</title>
   </head>
   
   <body>

        <div class="container text-center">
            <h3>Manage Songs</h3><br>
            
           <!-- Back to home -->
            <li>
                <a href = "/">Home</a>
            </li><br>
            
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
                    <td><a href = 'delete/{{ $song->SONG_ID }}'>Delete</a></td>          
                    <td><a href = 'edit/{{ $song->SONG_ID }}'>Edit</a></td>
                </tr>
                @endforeach
            </table>
        </div>
   
   </body>
</html>