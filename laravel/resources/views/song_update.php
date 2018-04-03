<?php
    require_once("../entities/song.class.php");
?>

<html>
   
   <head>
      <title>Song Management | Edit</title>
   </head>
   
   <body>
      <form action = "/edit/<?php echo $songs[0]->SONG_ID; ?>" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
      
         <table>

            <!-- Title -->
            <tr>
               <td>Song title</td>
               <td><input type='SONG_TITLE' name='SONG_TITLE' value = '<?php echo$songs[0]->SONG_TITLE; ?>'/></td>
            </tr>

            <!-- Artist -->
            <tr>
               <td>Artist</td>
               <td><input type='text' name='artist' value = '<?php echo$songs[0]->ARTIST; ?>'/></td>
            </tr>

            <!-- Desc -->
            <tr>
               <td>Desc</td>
               <td><input type='text' name='txtDescr' value = '<?php echo$songs[0]->DESCR; ?>'/></td>
            </tr>


            <tr>
               <td colspan = '2'>
                  <input type = 'submit' value = "Update song" />
               </td>
            </tr>
         </table>
      
      </form>
   
   </body>
</html>