<?php
    require_once("../entities/song.class.php");
?>
<html>
   
   <head>
      <title>View Songs Records</title>
   </head>
   
   <body>
        <div class="container text-center">
            <h3>Sản phẩm cửa hàng</h3><br>
            <div class="row">
            <?php
                foreach($songs as $song){ 
                ?>
                <div class="col-sm-4">
                    <a>
                        <img src="<?php echo "storage/" .$song->SONG_IMGL_INK;?>" class="img-responsive" style="width:30%"/></a>
                    <p class="text-danger"><?php echo $song->SONG_TITLE; ?></p>
                    <p class="text-info"><?php echo $song->ARTIST; ?></p>
                    <p class="text-danger">
                        <button type="button" class="btn btn-primary"> Mua hàng </button>
                    </p>
                </div>
                <?php } ?>
            </div>
        </div>



      
   
   </body>
</html>