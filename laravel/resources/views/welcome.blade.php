<!DOCTYPE html>
<?php
    require_once("../entities/song.class.php");
?>
<html>
   
   <head>
      <title>Laravel</title>
      <link href = "https://fonts.googleapis.com/css?family=Lato:100" rel = "stylesheet" 
         type = "text/css">
      
      <style>
         html, body {
            height: 100%;
         }
         body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
         }
         .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
         }
         .content {
            text-align: center;
            display: inline-block;
         }
         .title {
            font-size: 96px;
         }
      </style>
   </head>
   
   <body>
      <div class = "container">
         
        <div class = "content">
            <div class = "title">Sound Of Life</div>
        </div>

        <li>
            <a href = "song_list">Manage Songs</a>   
        </li>

        <li>
            <a href="insert"> Add New Song</a>
        </li><br>

        <div class="row">
            <?php
                foreach($songs as $song){ 
                ?>
                <div class="col-sm-9">
                    <a> <img src="<?php echo "storage/songIMG/" .$song->SONG_IMGL_INK;?>" class="img-responsive" style="width:10%"/></a>
                    <p class="text-danger"><?php echo $song->SONG_TITLE; ?></p>
                    <p class="text-info"><?php echo $song->ARTIST; ?></p>

                    <!-- Song link for Trí -->
                    <p class="text-info">Song link: <?php echo $song->SONG_LINK; ?></P>

                    <p class="text-danger">
                        <button type="button" class="btn btn-primary"> Play </button>
                    </p>
                </div>
                <?php } ?>
            </div>
      </div>
   </body>

</html>